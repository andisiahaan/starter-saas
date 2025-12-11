<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Withdrawal;

class WithdrawalPolicy
{
    /**
     * Determine whether the user can view any withdrawals.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-withdrawals');
    }

    /**
     * Determine whether the user can view the withdrawal.
     */
    public function view(User $user, Withdrawal $withdrawal): bool
    {
        // Owner can view their own withdrawals
        if ($user->id === $withdrawal->user_id) {
            return true;
        }

        return $user->can('view-withdrawals');
    }

    /**
     * Determine whether the user can create withdrawals.
     */
    public function create(User $user): bool
    {
        return true; // All authenticated users can request withdrawals
    }

    /**
     * Determine whether the user can update the withdrawal.
     */
    public function update(User $user, Withdrawal $withdrawal): bool
    {
        return $user->can('process-withdrawals');
    }

    /**
     * Determine whether the user can approve the withdrawal.
     */
    public function approve(User $user, Withdrawal $withdrawal): bool
    {
        return $user->can('process-withdrawals');
    }

    /**
     * Determine whether the user can reject the withdrawal.
     */
    public function reject(User $user, Withdrawal $withdrawal): bool
    {
        return $user->can('process-withdrawals');
    }

    /**
     * Determine whether the user can cancel the withdrawal.
     */
    public function cancel(User $user, Withdrawal $withdrawal): bool
    {
        // Owner can cancel their pending withdrawals
        if ($user->id === $withdrawal->user_id && $withdrawal->status === 'pending') {
            return true;
        }

        return $user->can('process-withdrawals');
    }

    /**
     * Determine whether the user can delete the withdrawal.
     */
    public function delete(User $user, Withdrawal $withdrawal): bool
    {
        // Only superadmin can delete (handled by Gate::before)
        return false;
    }
}
