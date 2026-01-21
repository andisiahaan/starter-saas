<?php

namespace App\Observers;

use App\Events\Ticket\TicketClosed;
use App\Events\Ticket\TicketCreated;
use App\Models\Ticket;
use Illuminate\Support\Facades\Log;

/**
 * Observer for Ticket model events.
 * 
 * THIN OBSERVER - only dispatches events.
 * All notifications handled by listeners.
 */
class TicketObserver
{
    /**
     * Handle the Ticket "created" event.
     */
    public function created(Ticket $ticket): void
    {
        Log::info('[TicketObserver] Ticket created, dispatching event', [
            'ticket_id' => $ticket->id,
        ]);

        TicketCreated::dispatch($ticket);
    }

    /**
     * Handle the Ticket "updated" event.
     */
    public function updated(Ticket $ticket): void
    {
        // Dispatch closed event if status changed to closed
        if ($ticket->isDirty('status') && $ticket->status === 'closed') {
            Log::info('[TicketObserver] Ticket closed, dispatching event', [
                'ticket_id' => $ticket->id,
            ]);

            TicketClosed::dispatch($ticket);
        }
    }
}
