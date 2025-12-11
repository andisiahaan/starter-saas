<?php

return [
    // ==========================================
    // TICKETS
    // ==========================================
    'tickets' => [
        'title' => 'Support Tickets',
        'description' => 'Manage customer support requests.',
        'my_tickets' => 'My Tickets',
        'create' => 'Create Ticket',
        'new' => 'New Ticket',
        'view' => 'View Ticket',
        'reply' => 'Reply',
        
        'table' => [
            'id' => 'Ticket ID',
            'subject' => 'Subject',
            'user' => 'User',
            'priority' => 'Priority',
            'status' => 'Status',
            'last_reply' => 'Last Reply',
            'created' => 'Created',
        ],
        
        'filters' => [
            'search' => 'Search tickets...',
            'all_status' => 'All Status',
            'all_priority' => 'All Priority',
        ],
        
        'status' => [
            'open' => 'Open',
            'in_progress' => 'In Progress',
            'waiting' => 'Waiting for Customer',
            'resolved' => 'Resolved',
            'closed' => 'Closed',
        ],
        
        'priority' => [
            'low' => 'Low',
            'medium' => 'Medium',
            'high' => 'High',
            'urgent' => 'Urgent',
        ],
        
        'form' => [
            'subject' => 'Subject',
            'subject_placeholder' => 'Brief summary of your issue',
            'category' => 'Category',
            'priority' => 'Priority',
            'message' => 'Message',
            'message_placeholder' => 'Describe your issue in detail...',
            'attachments' => 'Attachments',
            'attach_files' => 'Attach Files',
        ],
        
        'actions' => [
            'close' => 'Close Ticket',
            'reopen' => 'Reopen Ticket',
            'change_status' => 'Change Status',
            'change_priority' => 'Change Priority',
            'assign' => 'Assign',
        ],
        
        'detail' => [
            'ticket_info' => 'Ticket Information',
            'conversation' => 'Conversation',
            'reply_placeholder' => 'Type your reply...',
            'send_reply' => 'Send Reply',
            'internal_note' => 'Internal Note',
            'add_note' => 'Add Note',
        ],
        
        'empty' => 'No tickets found.',
        'no_messages' => 'No messages yet.',
        
        'messages' => [
            'created' => 'Ticket created successfully.',
            'replied' => 'Reply sent successfully.',
            'closed' => 'Ticket closed.',
            'reopened' => 'Ticket reopened.',
            'status_updated' => 'Ticket status updated.',
            'assigned' => 'Ticket assigned.',
        ],
        
        'user' => [
            'need_help' => 'Need Help?',
            'open_ticket' => 'Open a Support Ticket',
            'your_tickets' => 'Your Support Tickets',
            'no_tickets' => "You haven't opened any tickets yet.",
            'create_first' => 'Create your first ticket',
        ],
    ],

    // ==========================================
    // FAQ (if applicable)
    // ==========================================
    'faq' => [
        'title' => 'Frequently Asked Questions',
        'search' => 'Search FAQ...',
        'helpful' => 'Was this helpful?',
        'yes' => 'Yes',
        'no' => 'No',
        'still_need_help' => 'Still need help?',
        'contact_support' => 'Contact Support',
    ],

    // ==========================================
    // CONTACT
    // ==========================================
    'contact' => [
        'title' => 'Contact Us',
        'subtitle' => "We'd love to hear from you.",
        'form' => [
            'name' => 'Your Name',
            'email' => 'Your Email',
            'subject' => 'Subject',
            'message' => 'Message',
            'send' => 'Send Message',
        ],
        'success' => 'Your message has been sent. We will get back to you soon!',
    ],
];
