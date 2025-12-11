<?php

return [
    // ==========================================
    // PAGES
    // ==========================================
    'pages' => [
        'title' => 'Pages',
        'description' => 'Manage static pages for your website.',
        'add' => 'Add Page',
        'edit' => 'Edit Page',
        
        'table' => [
            'title' => 'Title',
            'slug' => 'Slug',
            'status' => 'Status',
            'updated' => 'Last Updated',
        ],
        
        'filters' => [
            'search' => 'Search pages...',
        ],
        
        'form' => [
            'title' => 'Page Title',
            'slug' => 'Slug',
            'content' => 'Content',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'is_active' => 'Published',
        ],
        
        'empty' => 'No pages found.',
        
        'messages' => [
            'created' => 'Page created successfully.',
            'updated' => 'Page updated successfully.',
            'deleted' => 'Page deleted successfully.',
        ],
        
        'confirm' => [
            'delete' => 'Are you sure you want to delete this page?',
        ],
    ],

    // ==========================================
    // NEWS
    // ==========================================
    'news' => [
        'title' => 'News',
        'description' => 'Manage news and announcements.',
        'add' => 'Add News',
        'edit' => 'Edit News',
        
        'table' => [
            'title' => 'Title',
            'category' => 'Category',
            'status' => 'Status',
            'date' => 'Published Date',
        ],
        
        'filters' => [
            'search' => 'Search news...',
            'all_categories' => 'All Categories',
        ],
        
        'form' => [
            'title' => 'Title',
            'slug' => 'Slug',
            'excerpt' => 'Excerpt',
            'content' => 'Content',
            'category' => 'Category',
            'featured_image' => 'Featured Image',
            'is_featured' => 'Featured',
            'is_active' => 'Published',
            'published_at' => 'Publish Date',
        ],
        
        'status' => [
            'draft' => 'Draft',
            'published' => 'Published',
            'scheduled' => 'Scheduled',
        ],
        
        'empty' => 'No news found.',
        
        'messages' => [
            'created' => 'News created successfully.',
            'updated' => 'News updated successfully.',
            'deleted' => 'News deleted successfully.',
        ],
        
        'confirm' => [
            'delete' => 'Are you sure you want to delete this news?',
        ],
    ],
];
