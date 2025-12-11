<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    /**
     * Determine whether the user can view any orders.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-orders');
    }

    /**
     * Determine whether the user can view the order.
     */
    public function view(User $user, Order $order): bool
    {
        // Owner can always view their own orders
        if ($user->id === $order->user_id) {
            return true;
        }

        return $user->can('view-orders');
    }

    /**
     * Determine whether the user can create orders.
     */
    public function create(User $user): bool
    {
        return true; // All authenticated users can create orders
    }

    /**
     * Determine whether the user can update the order.
     */
    public function update(User $user, Order $order): bool
    {
        return $user->can('edit-orders');
    }

    /**
     * Determine whether the user can cancel the order.
     */
    public function cancel(User $user, Order $order): bool
    {
        // Owner can cancel their pending orders
        if ($user->id === $order->user_id && $order->isPending()) {
            return true;
        }

        return $user->can('edit-orders');
    }

    /**
     * Determine whether the user can verify the order.
     */
    public function verify(User $user, Order $order): bool
    {
        return $user->can('verify-orders');
    }

    /**
     * Determine whether the user can refund the order.
     */
    public function refund(User $user, Order $order): bool
    {
        return $user->can('refund-orders');
    }

    /**
     * Determine whether the user can delete the order.
     */
    public function delete(User $user, Order $order): bool
    {
        // Only superadmin can delete (handled by Gate::before)
        return false;
    }
}
