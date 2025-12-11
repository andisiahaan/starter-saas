<?php

namespace App\Livewire\Admin\Users\Modals;

use AndiSiahaan\LivewireModal\ModalComponent;
use App\Helpers\Toast;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BanUserModal extends ModalComponent
{
    public ?int $userId = null;
    public ?User $user = null;
    public string $banReason = '';

    public function mount(int $userId): void
    {
        $this->userId = $userId;
        $this->user = User::findOrFail($userId);
        
        // Admin cannot ban superadmin or other admins
        if (!Auth::user()->isSuperAdmin()) {
            if ($this->user->isSuperAdmin() || $this->user->isAdmin()) {
                Toast::error('You do not have permission to ban this user.');
                $this->closeModal();
                return;
            }
        }
    }

    public function ban(): void
    {
        if (!$this->user) {
            return;
        }

        // Permission check
        if (!Auth::user()->can('ban-users')) {
            Toast::error('You do not have permission to ban users.');
            $this->closeModal();
            return;
        }

        // Cannot ban yourself
        if ($this->user->id === auth()->id()) {
            Toast::error('You cannot ban your own account.');
            $this->closeModal();
            return;
        }

        // Admin cannot ban superadmin or other admins
        if (!Auth::user()->isSuperAdmin()) {
            if ($this->user->isSuperAdmin() || $this->user->isAdmin()) {
                Toast::error('You do not have permission to ban this user.');
                $this->closeModal();
                return;
            }
        }

        $this->user->ban($this->banReason, auth()->id());
        Toast::success('User has been banned.');

        $this->dispatch('refreshUsers');
        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return 'md';
    }

    public function render()
    {
        return view('admin.livewire.users.modals.ban-user-modal');
    }
}
