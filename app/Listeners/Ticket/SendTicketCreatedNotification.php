<?php

namespace App\Listeners\Ticket;

use App\Events\Ticket\TicketCreated;
use App\Notifications\Tickets\TicketCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

/**
 * Send ticket created notification to user.
 * Queued for async processing.
 */
class SendTicketCreatedNotification implements ShouldQueue
{
    public function handle(TicketCreated $event): void
    {
        $ticket = $event->ticket;
        $user = $ticket->user;

        if (!$user) {
            Log::warning('[SendTicketCreatedNotification] Ticket has no user', [
                'ticket_id' => $ticket->id,
            ]);
            return;
        }

        try {
            $user->notify(new TicketCreatedNotification($ticket));

            Log::info('[SendTicketCreatedNotification] Notification sent', [
                'ticket_id' => $ticket->id,
                'user_id' => $user->id,
            ]);
        } catch (\Throwable $e) {
            Log::error('[SendTicketCreatedNotification] Failed', [
                'ticket_id' => $ticket->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
