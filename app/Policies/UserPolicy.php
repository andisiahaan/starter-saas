<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view any users.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-users');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        // Users can always view their own profile
        if ($user->id === $model->id) {
            return true;
        }

        return $user->can('view-users');
    }

    /**
     * Determine whether the user can create users.
     */
    public function create(User $user): bool
    {
        return $user->can('create-users');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        // Users can update their own profile
        if ($user->id === $model->id) {
            return true;
        }

        // Cannot edit superadmin unless you are superadmin (handled by Gate::before)
        if ($model->hasRole('superadmin')) {
            return false;
        }

        // Cannot edit admin unless you have assign-roles permission
        if ($model->hasRole('admin') && !$user->can('assign-roles')) {
            return false;
        }

        return $user->can('edit-users');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        // Cannot delete yourself
        if ($user->id === $model->id) {
            return false;
        }

        // Cannot delete superadmin
        if ($model->hasRole('superadmin')) {
            return false;
        }

        // Cannot delete admin unless you have assign-roles permission
        if ($model->hasRole('admin') && !$user->can('assign-roles')) {
            return false;
        }

        return $user->can('delete-users');
    }

    /**
     * Determine whether the user can ban the model.
     */
    public function ban(User $user, User $model): bool
    {
        // Cannot ban yourself
        if ($user->id === $model->id) {
            return false;
        }

        // Cannot ban superadmin
        if ($model->hasRole('superadmin')) {
            return false;
        }

        // Cannot ban admin unless you have assign-roles permission
        if ($model->hasRole('admin') && !$user->can('assign-roles')) {
            return false;
        }

        return $user->can('ban-users');
    }

    /**
     * Determine whether the user can unban the model.
     */
    public function unban(User $user, User $model): bool
    {
        return $this->ban($user, $model);
    }

    /**
     * Determine whether the user can impersonate the model.
     */
    public function impersonate(User $user, User $model): bool
    {
        // Cannot impersonate yourself
        if ($user->id === $model->id) {
            return false;
        }

        // Cannot impersonate superadmin
        if ($model->hasRole('superadmin')) {
            return false;
        }

        return $user->can('impersonate-users');
    }

    /**
     * Determine whether the user can assign roles.
     */
    public function assignRoles(User $user, User $model): bool
    {
        return $user->can('assign-roles');
    }
}
