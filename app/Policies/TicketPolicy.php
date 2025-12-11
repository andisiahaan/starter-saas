<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;

class TicketPolicy
{
    /**
     * Determine whether the user can view any tickets.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-tickets');
    }

    /**
     * Determine whether the user can view the ticket.
     */
    public function view(User $user, Ticket $ticket): bool
    {
        // Owner can always view their own tickets
        if ($user->id === $ticket->user_id) {
            return true;
        }

        return $user->can('view-tickets');
    }

    /**
     * Determine whether the user can create tickets.
     */
    public function create(User $user): bool
    {
        return true; // All authenticated users can create tickets
    }

    /**
     * Determine whether the user can update the ticket.
     */
    public function update(User $user, Ticket $ticket): bool
    {
        return $user->can('manage-tickets');
    }

    /**
     * Determine whether the user can reply to the ticket.
     */
    public function reply(User $user, Ticket $ticket): bool
    {
        // Owner can reply to their own tickets
        if ($user->id === $ticket->user_id) {
            return true;
        }

        return $user->can('reply-tickets');
    }

    /**
     * Determine whether the user can close the ticket.
     */
    public function close(User $user, Ticket $ticket): bool
    {
        // Owner can close their own tickets
        if ($user->id === $ticket->user_id) {
            return true;
        }

        return $user->can('manage-tickets');
    }

    /**
     * Determine whether the user can delete the ticket.
     */
    public function delete(User $user, Ticket $ticket): bool
    {
        return $user->can('manage-tickets');
    }

    /**
     * Determine whether the user can assign the ticket.
     */
    public function assign(User $user, Ticket $ticket): bool
    {
        return $user->can('manage-tickets');
    }
}
