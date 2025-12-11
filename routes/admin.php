<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Users\Index as UsersIndex;
use App\Livewire\Admin\Roles\Index as RolesIndex;
use App\Livewire\Admin\Permissions\Index as PermissionsIndex;
use App\Livewire\Admin\Settings\Index as SettingsIndex;
use App\Livewire\Admin\ProductCategories\Index as ProductCategoriesIndex;
use App\Livewire\Admin\Products\Index as ProductsIndex;
use App\Livewire\Admin\PaymentMethods\Index as PaymentMethodsIndex;
use App\Livewire\Admin\Orders\Index as OrdersIndex;
use App\Livewire\Admin\CreditLogs\Index as CreditLogsIndex;
use App\Livewire\Admin\Pages\Index as PagesIndex;
use App\Livewire\Admin\News\Index as NewsIndex;
use App\Livewire\Admin\Tickets\Index as TicketsIndex;
use App\Livewire\Admin\Tickets\Show as TicketsShow;

// Dashboard - accessible to all admin/superadmin
Route::get('/', Dashboard::class)->name('index');

// User Management
Route::middleware('permission:view-users')->group(function () {
    Route::get('/users', UsersIndex::class)->name('users.index');
});

// Roles & Permissions (Superadmin only - protected by permission)
Route::middleware('permission:manage-roles')->group(function () {
    Route::get('/roles', RolesIndex::class)->name('roles.index');
});

Route::middleware('permission:manage-permissions')->group(function () {
    Route::get('/permissions', PermissionsIndex::class)->name('permissions.index');
});

// Settings (Superadmin only)
Route::middleware('permission:manage-settings')->group(function () {
    Route::get('/settings', SettingsIndex::class)->name('settings');
});

// Credit System Routes
Route::middleware('permission:manage-product-categories')->group(function () {
    Route::get('/product-categories', ProductCategoriesIndex::class)->name('product-categories.index');
});

Route::middleware('permission:view-products')->group(function () {
    Route::get('/products', ProductsIndex::class)->name('products.index');
});

Route::middleware('permission:view-payment-methods')->group(function () {
    Route::get('/payment-methods', PaymentMethodsIndex::class)->name('payment-methods.index');
});

Route::middleware('permission:view-orders')->group(function () {
    Route::get('/orders', OrdersIndex::class)->name('orders.index');
});

Route::middleware('permission:view-credit-logs')->group(function () {
    Route::get('/credit-logs', CreditLogsIndex::class)->name('credit-logs.index');
});

// Content Management
Route::middleware('permission:view-pages')->group(function () {
    Route::get('/pages', PagesIndex::class)->name('pages.index');
});

Route::middleware('permission:view-news')->group(function () {
    Route::get('/news', NewsIndex::class)->name('news.index');
});

// Blog Management
Route::middleware('permission:view-blog')->group(function () {
    Route::get('/blog/posts', \App\Livewire\Admin\Blog\Posts\Index::class)->name('blog.posts.index');
    Route::get('/blog/posts/create', \App\Livewire\Admin\Blog\Posts\Form::class)->name('blog.posts.create');
    Route::get('/blog/posts/{post}/edit', \App\Livewire\Admin\Blog\Posts\Form::class)->name('blog.posts.edit');
    Route::get('/blog/categories', \App\Livewire\Admin\Blog\Categories\Index::class)->name('blog.categories.index');
    Route::get('/blog/tags', \App\Livewire\Admin\Blog\Tags\Index::class)->name('blog.tags.index');
});

// Support
Route::middleware('permission:view-tickets')->group(function () {
    Route::get('/tickets', TicketsIndex::class)->name('tickets.index');
    Route::get('/tickets/{ticket}', TicketsShow::class)->name('tickets.show');
});

// Referral System
Route::middleware('permission:view-referrals')->group(function () {
    Route::get('/referrals', \App\Livewire\Admin\Referrals\Index::class)->name('referrals.index');
});

Route::middleware('permission:view-commissions')->group(function () {
    Route::get('/commissions', \App\Livewire\Admin\Referrals\Commissions::class)->name('commissions.index');
});

Route::middleware('permission:view-withdrawals')->group(function () {
    Route::get('/withdrawals', \App\Livewire\Admin\Withdrawals\Index::class)->name('withdrawals.index');
});
