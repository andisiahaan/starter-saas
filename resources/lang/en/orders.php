<?php

return [
    // ==========================================
    // USER-FACING ORDERS
    // ==========================================
    'title' => 'My Orders',
    'subtitle' => 'Your purchase history',
    'buy_credits' => 'Buy Credits',
    
    'filter' => [
        'all_status' => 'All Status',
    ],
    
    'status' => [
        'pending' => 'Pending',
        'verified' => 'Verified',
        'failed' => 'Failed',
        'expired' => 'Expired',
        'cancelled' => 'Cancelled',
    ],
    
    'list' => [
        'credit_added' => 'Credit Added',
        'credits' => ':amount credits',
        'total' => 'Total',
        'details' => 'Details',
    ],
    
    'empty' => [
        'title' => 'No orders yet',
        'description' => 'Your orders will appear here after making a purchase.',
    ],
    
    'detail' => [
        'title' => 'Order Details',
        'order_number' => 'Order Number',
        'product' => 'Product',
        'credits' => 'Credits',
        'payment_method' => 'Payment Method',
        'total' => 'Total',
        'created' => 'Created',
        'verified' => 'Verified',
        'credits_added_on' => 'Credits added on :date',
        'view_full' => 'View Full Details',
    ],
    
    // Order Show Page
    'show' => [
        'title' => 'Order :number',
        'back' => 'Back to Orders',
        'created_at' => 'Created :date',
        
        // Payment Section
        'payment' => [
            'complete' => 'Complete Your Payment',
            'expires' => 'Payment expires:',
            'scan_qr' => 'Scan QR Code to Pay',
            'pay_now' => 'Pay Now',
            'redirect_notice' => 'You will be redirected to payment page',
            'code' => 'Payment Code',
            'copy' => 'Copy',
            'copied' => 'Copied!',
            'instructions' => 'Payment Instructions',
            'how_to_pay' => 'How to Pay',
            'check_status' => 'Check Payment Status',
            'checking' => 'Checking...',
        ],
        
        // Verification States
        'verified' => [
            'title' => 'Payment Successful!',
            'credits_added' => ':amount credits have been added to your account.',
            'credits_pending' => 'Your payment has been verified. Credits will be added shortly.',
            'view_credits' => 'View My Credits',
        ],
        
        'failed' => [
            'title' => 'Payment :status',
            'message' => 'Your payment could not be processed.',
            'try_again' => 'Try Again',
        ],
        
        // Order Summary Sidebar
        'summary' => [
            'title' => 'Order Summary',
            'product' => 'Product',
            'credits' => 'Credits',
            'payment_method' => 'Payment Method',
            'subtotal' => 'Subtotal',
            'fee' => 'Fee',
            'total' => 'Total',
            'reference' => 'Reference',
        ],
    ],
];
