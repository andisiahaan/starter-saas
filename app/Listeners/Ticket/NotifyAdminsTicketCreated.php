<?php

namespace App\Listeners\Ticket;

use App\Enums\NotificationType;
use App\Events\Ticket\TicketCreated;
use App\Notifications\Admin\AdminTicketCreatedNotification;
use App\Support\NotificationHelper;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

/**
 * Notify admins about new ticket creation.
 * Queued for async processing.
 */
class NotifyAdminsTicketCreated implements ShouldQueue
{
    public function handle(TicketCreated $event): void
    {
        $ticket = $event->ticket;

        try {
            NotificationHelper::sendToAdmins(
                new AdminTicketCreatedNotification($ticket),
                NotificationType::ADMIN_TICKET_CREATED->value
            );

            Log::info('[NotifyAdminsTicketCreated] Admin notification sent', [
                'ticket_id' => $ticket->id,
            ]);
        } catch (\Throwable $e) {
            Log::error('[NotifyAdminsTicketCreated] Failed', [
                'ticket_id' => $ticket->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
