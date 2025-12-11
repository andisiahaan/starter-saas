<?php

return [
    // ==========================================
    // GENERAL
    // ==========================================
    'title' => 'Blog',
    'subtitle' => 'Discover our latest articles, tips, and insights',
    'latest_posts' => 'Latest Posts',
    'featured_posts' => 'Featured Posts',
    'related_posts' => 'Related Posts',
    'all_posts' => 'All Posts',
    'back_to_blog' => 'Back to Blog',

    // ==========================================
    // POSTS
    // ==========================================
    'posts' => [
        'title' => 'Blog Posts',
        'description' => 'Manage your blog content',
        'new' => 'New Post',
        'create' => 'Create New Post',
        'edit' => 'Edit Post',
        'write' => 'Write and publish your new blog post',
        'update' => 'Update your blog post',
        
        'table' => [
            'post' => 'Post',
            'author' => 'Author',
            'categories' => 'Categories',
            'status' => 'Status',
            'views' => 'Views',
        ],
        
        'filters' => [
            'search' => 'Search posts...',
            'all_status' => 'All Status',
        ],
        
        'form' => [
            'title' => 'Title',
            'title_placeholder' => 'Enter post title',
            'slug' => 'Slug',
            'excerpt' => 'Excerpt',
            'excerpt_description' => 'A short description shown in post listings',
            'excerpt_placeholder' => 'Brief summary of the post (optional)',
            'content' => 'Content',
            'content_placeholder' => 'Write your content here...',
            'content_help' => 'You can use HTML or Markdown formatting',
            'featured_image' => 'Featured Image',
        ],
        
        'publish' => [
            'title' => 'Publish',
            'status' => 'Status',
            'publish_date' => 'Publish Date',
            'featured' => 'Featured Post',
            'allow_comments' => 'Allow Comments',
            'button' => 'Publish Post',
            'update_button' => 'Update Post',
        ],
        
        'seo' => [
            'title' => 'SEO Settings',
            'meta_title' => 'Meta Title',
            'meta_title_placeholder' => 'SEO title (max 70 characters)',
            'meta_description' => 'Meta Description',
            'meta_description_placeholder' => 'SEO description (max 160 characters)',
            'meta_keywords' => 'Meta Keywords',
            'meta_keywords_placeholder' => 'Comma-separated keywords',
        ],
        
        'status' => [
            'draft' => 'Draft',
            'published' => 'Published',
            'scheduled' => 'Scheduled',
            'archived' => 'Archived',
        ],
        
        'empty' => 'No posts found.',
        'create_first' => 'Create your first post',
        
        'messages' => [
            'created' => 'Post created successfully.',
            'updated' => 'Post updated successfully.',
            'deleted' => 'Post deleted successfully.',
        ],
    ],

    // ==========================================
    // CATEGORIES
    // ==========================================
    'categories' => [
        'title' => 'Blog Categories',
        'description' => 'Manage blog post categories',
        'add' => 'Add Category',
        'edit' => 'Edit Category',
        
        'table' => [
            'name' => 'Name',
            'slug' => 'Slug',
            'posts' => 'Posts',
            'status' => 'Status',
        ],
        
        'form' => [
            'name' => 'Name',
            'slug' => 'Slug',
            'parent' => 'Parent Category',
            'parent_none' => 'None',
            'description' => 'Description',
            'order' => 'Order',
            'active' => 'Active',
        ],
        
        'empty' => 'No categories found.',
        
        'messages' => [
            'created' => 'Category created successfully.',
            'updated' => 'Category updated successfully.',
            'deleted' => 'Category deleted successfully.',
            'has_posts' => 'Cannot delete category with posts. Remove posts first.',
        ],
    ],

    // ==========================================
    // TAGS
    // ==========================================
    'tags' => [
        'title' => 'Blog Tags',
        'description' => 'Manage blog post tags',
        'add' => 'Add Tag',
        'edit' => 'Edit Tag',
        
        'form' => [
            'name' => 'Name',
            'slug' => 'Slug',
            'description' => 'Description',
        ],
        
        'posts_count' => ':count posts',
        'empty' => 'No tags found.',
        
        'messages' => [
            'created' => 'Tag created successfully.',
            'updated' => 'Tag updated successfully.',
            'deleted' => 'Tag deleted successfully.',
        ],
    ],

    // ==========================================
    // PUBLIC BLOG
    // ==========================================
    'public' => [
        'search' => 'Search...',
        'categories' => 'Categories',
        'tags' => 'Tags',
        'share' => 'Share',
        'reading_time' => ':count min read',
        'views' => ':count views',
        'written_by' => 'Written by',
        'published_on' => 'Published on',
        'no_posts' => 'No articles found.',
        'no_posts_category' => 'No posts in this category yet.',
        'no_posts_tag' => 'No posts with this tag yet.',
    ],
];
