<?php

namespace App\Listeners\Ticket;

use App\Events\Ticket\TicketClosed;
use App\Notifications\Tickets\TicketClosedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

/**
 * Send ticket closed notification to user.
 * Queued for async processing.
 */
class SendTicketClosedNotification implements ShouldQueue
{
    public function handle(TicketClosed $event): void
    {
        $ticket = $event->ticket;
        $user = $ticket->user;

        if (!$user) {
            Log::warning('[SendTicketClosedNotification] Ticket has no user', [
                'ticket_id' => $ticket->id,
            ]);
            return;
        }

        try {
            $user->notify(new TicketClosedNotification($ticket));

            Log::info('[SendTicketClosedNotification] Notification sent', [
                'ticket_id' => $ticket->id,
                'user_id' => $user->id,
            ]);
        } catch (\Throwable $e) {
            Log::error('[SendTicketClosedNotification] Failed', [
                'ticket_id' => $ticket->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
