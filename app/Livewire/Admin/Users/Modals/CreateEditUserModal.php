<?php

namespace App\Livewire\Admin\Users\Modals;

use AndiSiahaan\LivewireModal\ModalComponent;
use App\Helpers\Toast;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class CreateEditUserModal extends ModalComponent
{
    public ?int $userId = null;
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public array $selectedRoles = [];

    public function mount(?int $userId = null): void
    {
        $this->userId = $userId;

        if ($userId) {
            $user = User::with('roles')->findOrFail($userId);
            
            // Admin cannot edit superadmin or other admins
            if (!Auth::user()->isSuperAdmin()) {
                if ($user->isSuperAdmin() || $user->isAdmin()) {
                    Toast::error('You do not have permission to edit this user.');
                    $this->closeModal();
                    return;
                }
            }
            
            $this->name = $user->name;
            $this->email = $user->email;
            $this->selectedRoles = $user->roles->pluck('name')->toArray();
        }
    }

    /**
     * Get roles that current user can assign.
     */
    public function getAssignableRoles(): \Illuminate\Database\Eloquent\Collection
    {
        $query = Role::orderBy('name');
        
        // Non-superadmin cannot assign superadmin or admin roles
        if (!Auth::user()->isSuperAdmin()) {
            $query->whereNotIn('name', ['superadmin', 'admin']);
        }
        
        return $query->get();
    }

    /**
     * Filter selected roles to only assignable ones.
     */
    private function filterSelectedRoles(): array
    {
        $assignableRoles = $this->getAssignableRoles()->pluck('name')->toArray();
        
        // Keep only roles that current user can assign
        $filteredRoles = array_intersect($this->selectedRoles, $assignableRoles);
        
        // If editing, preserve roles that user can't modify
        if ($this->userId) {
            $user = User::with('roles')->find($this->userId);
            if ($user) {
                $currentRoles = $user->roles->pluck('name')->toArray();
                $protectedRoles = array_diff($currentRoles, $assignableRoles);
                $filteredRoles = array_merge($filteredRoles, $protectedRoles);
            }
        }
        
        return array_unique($filteredRoles);
    }

    public function save(): void
    {
        // Authorization check
        if (!Auth::user()->can('create-users') && !$this->userId) {
            Toast::error('You do not have permission to create users.');
            $this->closeModal();
            return;
        }
        
        if (!Auth::user()->can('edit-users') && $this->userId) {
            Toast::error('You do not have permission to edit users.');
            $this->closeModal();
            return;
        }

        $rules = [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->userId),
            ],
            'selectedRoles' => 'array',
        ];

        if (!$this->userId) {
            $rules['password'] = 'required|string|min:8|confirmed';
        } else {
            $rules['password'] = 'nullable|string|min:8|confirmed';
        }

        $this->validate($rules);

        if ($this->userId) {
            $user = User::findOrFail($this->userId);
            
            // Double check: Admin cannot edit superadmin or other admins
            if (!Auth::user()->isSuperAdmin()) {
                if ($user->isSuperAdmin() || $user->isAdmin()) {
                    Toast::error('You do not have permission to edit this user.');
                    $this->closeModal();
                    return;
                }
            }
            
            $user->update([
                'name' => $this->name,
                'email' => $this->email,
            ]);

            if (!empty($this->password)) {
                $user->update(['password' => Hash::make($this->password)]);
            }

            Toast::success('User updated successfully.');
        } else {
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]);

            Toast::success('User created successfully.');
        }

        // Only sync roles that current user is allowed to assign
        $rolesToSync = $this->filterSelectedRoles();
        $user->syncRoles($rolesToSync);

        $this->dispatch('refreshUsers');
        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return 'lg';
    }

    public function render()
    {
        return view('admin.livewire.users.modals.create-edit-user-modal', [
            'roles' => $this->getAssignableRoles(),
        ]);
    }
}
