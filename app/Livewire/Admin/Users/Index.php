<?php

namespace App\Livewire\Admin\Users;

use App\Helpers\Toast;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Index extends Component
{
    use WithPagination;

    public string $search = '';
    public string $roleFilter = '';
    public string $statusFilter = '';
    public string $trashedFilter = ''; // '', 'only', 'with'
    
    // Bulk actions
    public array $selected = [];
    public bool $selectAll = false;

    protected $queryString = ['search', 'roleFilter', 'statusFilter', 'trashedFilter'];

    public function updatingSearch()
    {
        $this->resetPage();
        $this->selected = [];
        $this->selectAll = false;
    }

    public function updatingRoleFilter()
    {
        $this->resetPage();
        $this->selected = [];
        $this->selectAll = false;
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
        $this->selected = [];
        $this->selectAll = false;
    }

    public function updatingTrashedFilter()
    {
        $this->resetPage();
        $this->selected = [];
        $this->selectAll = false;
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selected = $this->getUsersQuery()->pluck('id')->map(fn($id) => (string) $id)->toArray();
        } else {
            $this->selected = [];
        }
    }

    public function unbanUser(int $userId)
    {
        $user = User::findOrFail($userId);
        
        if (!Auth::user()->can('ban-users')) {
            Toast::error('You do not have permission to unban users.');
            return;
        }
        
        if ($user->hasRole('superadmin')) {
            Toast::error('Cannot modify superadmin.');
            return;
        }
        
        $user->unban();
        Toast::success('User has been unbanned.');
    }

    /**
     * Restore a soft-deleted user (Superadmin only).
     */
    public function restoreUser(int $userId): void
    {
        if (!Auth::user()->isSuperAdmin()) {
            Toast::error('Only superadmin can restore deleted users.');
            return;
        }

        $user = User::withTrashed()->findOrFail($userId);
        $user->restore();
        
        Toast::success("User '{$user->name}' has been restored.");
    }

    /**
     * Force delete a user permanently (Superadmin only).
     */
    public function forceDeleteUser(int $userId): void
    {
        if (!Auth::user()->isSuperAdmin()) {
            Toast::error('Only superadmin can permanently delete users.');
            return;
        }

        $user = User::withTrashed()->findOrFail($userId);
        
        // Cannot force delete superadmin
        if ($user->hasRole('superadmin')) {
            Toast::error('Cannot permanently delete superadmin account.');
            return;
        }
        
        $userName = $user->name;
        $user->forceDelete();
        
        Toast::success("User '{$userName}' has been permanently deleted.");
    }

    /**
     * Bulk restore selected users (Superadmin only).
     */
    public function bulkRestore(): void
    {
        if (!Auth::user()->isSuperAdmin()) {
            Toast::error('Only superadmin can restore deleted users.');
            return;
        }
        
        if (empty($this->selected)) {
            Toast::error('No users selected.');
            return;
        }

        $count = User::withTrashed()
            ->whereIn('id', $this->selected)
            ->whereNotNull('deleted_at')
            ->restore();

        $this->selected = [];
        $this->selectAll = false;
        
        Toast::success("{$count} users have been restored.");
    }

    /**
     * Bulk force delete selected users (Superadmin only).
     */
    public function bulkForceDelete(): void
    {
        if (!Auth::user()->isSuperAdmin()) {
            Toast::error('Only superadmin can permanently delete users.');
            return;
        }
        
        if (empty($this->selected)) {
            Toast::error('No users selected.');
            return;
        }

        // Exclude superadmins from bulk force delete
        $count = User::withTrashed()
            ->whereIn('id', $this->selected)
            ->whereDoesntHave('roles', fn($q) => $q->where('name', 'superadmin'))
            ->forceDelete();

        $this->selected = [];
        $this->selectAll = false;
        
        Toast::success("{$count} users have been permanently deleted.");
    }

    /**
     * Bulk ban selected users.
     */
    public function bulkBan()
    {
        if (!Auth::user()->can('ban-users')) {
            Toast::error('You do not have permission to ban users.');
            return;
        }
        
        if (empty($this->selected)) {
            Toast::error('No users selected.');
            return;
        }

        // Exclude superadmins from bulk ban
        $count = User::whereIn('id', $this->selected)
            ->whereNull('banned_at')
            ->whereDoesntHave('roles', fn($q) => $q->where('name', 'superadmin'))
            ->update(['banned_at' => now()]);

        $this->selected = [];
        $this->selectAll = false;
        
        Toast::success("{$count} users have been banned.");
    }

    /**
     * Bulk unban selected users.
     */
    public function bulkUnban()
    {
        if (!Auth::user()->can('ban-users')) {
            Toast::error('You do not have permission to unban users.');
            return;
        }
        
        if (empty($this->selected)) {
            Toast::error('No users selected.');
            return;
        }

        $count = User::whereIn('id', $this->selected)
            ->whereNotNull('banned_at')
            ->update(['banned_at' => null, 'banned_reason' => null]);

        $this->selected = [];
        $this->selectAll = false;
        
        Toast::success("{$count} users have been unbanned.");
    }

    /**
     * Export users to CSV.
     */
    public function exportCsv(): StreamedResponse
    {
        $users = $this->getUsersQuery()->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="users_export_' . date('Y-m-d_His') . '.csv"',
        ];

        return response()->stream(function () use ($users) {
            $file = fopen('php://output', 'w');
            
            // Header row
            fputcsv($file, ['ID', 'Name', 'Email', 'Username', 'Phone', 'Role', 'Credit', 'Status', 'Registered At', 'Deleted At']);
            
            // Data rows
            foreach ($users as $user) {
                $status = 'Active';
                if ($user->deleted_at) {
                    $status = 'Deleted';
                } elseif ($user->banned_at) {
                    $status = 'Banned';
                }
                
                fputcsv($file, [
                    $user->id,
                    $user->name,
                    $user->email,
                    $user->username ?? '',
                    $user->phone ?? '',
                    $user->roles->pluck('name')->implode(', '),
                    $user->credit ?? 0,
                    $status,
                    $user->created_at->format('Y-m-d H:i:s'),
                    $user->deleted_at?->format('Y-m-d H:i:s') ?? '',
                ]);
            }
            
            fclose($file);
        }, 200, $headers);
    }

    /**
     * Get the base users query.
     */
    protected function getUsersQuery()
    {
        $query = User::with('roles');
        
        // Trashed filter (Superadmin only)
        if (Auth::user()->isSuperAdmin()) {
            if ($this->trashedFilter === 'only') {
                $query->onlyTrashed();
            } elseif ($this->trashedFilter === 'with') {
                $query->withTrashed();
            }
        }
        
        return $query
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%')
                        ->orWhere('username', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->roleFilter, function ($query) {
                $query->whereHas('roles', function ($q) {
                    $q->where('name', $this->roleFilter);
                });
            })
            ->when($this->statusFilter === 'banned', fn($q) => $q->whereNotNull('banned_at'))
            ->when($this->statusFilter === 'active', fn($q) => $q->whereNull('banned_at'))
            ->orderBy('created_at', 'desc');
    }

    /**
     * Check if current user can manage the target user.
     */
    public function canManageUser(User $user): bool
    {
        // Superadmin can manage everyone
        if (Auth::user()->isSuperAdmin()) {
            return true;
        }
        
        // Admin cannot manage superadmin or other admins
        if ($user->hasRole('superadmin') || $user->hasRole('admin')) {
            return false;
        }
        
        return true;
    }

    #[On('refreshUsers')]
    public function refreshUsers(): void
    {
        // This will trigger a re-render
    }

    public function render()
    {
        $users = $this->getUsersQuery()->paginate(10);

        return view('admin.livewire.users.index', [
            'users' => $users,
            'roles' => Role::all(),
            'isSuperAdmin' => Auth::user()->isSuperAdmin(),
        ])->layout('admin.layouts.app', ['title' => 'Manage Users']);
    }
}
