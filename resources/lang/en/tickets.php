<?php

return [
    // ==========================================
    // USER-FACING TICKETS
    // ==========================================
    'title' => 'My Tickets',
    'subtitle' => 'View and manage your support requests',
    'new_ticket' => 'New Ticket',
    
    'filter' => [
        'all_status' => 'All Status',
    ],
    
    'status' => [
        'open' => 'Open',
        'in_progress' => 'In Progress',
        'waiting' => 'Waiting',
        'resolved' => 'Resolved',
        'closed' => 'Closed',
    ],
    
    'priority' => [
        'low' => 'Low',
        'normal' => 'Normal',
        'high' => 'High',
        'urgent' => 'Urgent',
    ],
    
    'category' => [
        'general' => 'General',
        'billing' => 'Billing',
        'technical' => 'Technical',
        'other' => 'Other',
    ],
    
    'empty' => [
        'title' => 'No tickets',
        'description' => 'Create a new ticket to get support.',
    ],
    
    // Create Ticket
    'create' => [
        'back' => 'Back to Tickets',
        'title' => 'Create Support Ticket',
        'subject' => 'Subject',
        'subject_placeholder' => 'Brief description of your issue',
        'category' => 'Category',
        'priority' => 'Priority',
        'description' => 'Description',
        'description_placeholder' => 'Please describe your issue in detail...',
        'submit' => 'Submit Ticket',
        'submitting' => 'Submitting...',
    ],
    
    // Show Ticket
    'show' => [
        'back' => 'Back to Tickets',
        'ticket_number' => 'Ticket #:number',
        'created' => 'Created :date',
        'conversation' => 'Conversation',
        'waiting_response' => 'Waiting for staff response...',
        'ticket_closed' => 'This ticket is closed.',
        'reply_placeholder' => 'Type your reply...',
        'send_reply' => 'Send Reply',
        'support_team' => 'Support Team',
        'you' => 'You',
    ],
    
    // Messages
    'messages' => [
        'created' => 'Ticket created successfully.',
        'replied' => 'Reply sent.',
        'closed' => 'Ticket closed.',
        'reopened' => 'Ticket reopened.',
    ],
];
