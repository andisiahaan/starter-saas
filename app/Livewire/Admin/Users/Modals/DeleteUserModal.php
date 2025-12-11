<?php

namespace App\Livewire\Admin\Users\Modals;

use AndiSiahaan\LivewireModal\ModalComponent;
use App\Helpers\Toast;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DeleteUserModal extends ModalComponent
{
    public ?int $userId = null;
    public ?User $user = null;

    public function mount(int $userId): void
    {
        $this->userId = $userId;
        $this->user = User::findOrFail($userId);
        
        // Admin cannot delete superadmin or other admins
        if (!Auth::user()->isSuperAdmin()) {
            if ($this->user->isSuperAdmin() || $this->user->isAdmin()) {
                Toast::error('You do not have permission to delete this user.');
                $this->closeModal();
                return;
            }
        }
    }

    public function delete(): void
    {
        if (!$this->user) {
            return;
        }

        // Permission check
        if (!Auth::user()->can('delete-users')) {
            Toast::error('You do not have permission to delete users.');
            $this->closeModal();
            return;
        }

        // Cannot delete yourself
        if ($this->user->id === auth()->id()) {
            Toast::error('You cannot delete your own account.');
            $this->closeModal();
            return;
        }

        // Admin cannot delete superadmin or other admins
        if (!Auth::user()->isSuperAdmin()) {
            if ($this->user->isSuperAdmin() || $this->user->isAdmin()) {
                Toast::error('You do not have permission to delete this user.');
                $this->closeModal();
                return;
            }
        }
        
        // Cannot delete superadmin at all
        if ($this->user->isSuperAdmin()) {
            Toast::error('Cannot delete superadmin account.');
            $this->closeModal();
            return;
        }

        $this->user->delete();
        Toast::success('User deleted successfully.');

        $this->dispatch('refreshUsers');
        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return 'md';
    }

    public function render()
    {
        return view('admin.livewire.users.modals.delete-user-modal');
    }
}
