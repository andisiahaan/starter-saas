<?php

namespace App\Policies;

use App\Models\ProductCategory;
use App\Models\User;

class ProductCategoryPolicy
{
    /**
     * Determine whether the user can view any product categories.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-products');
    }

    /**
     * Determine whether the user can view the product category.
     */
    public function view(User $user, ProductCategory $productCategory): bool
    {
        return $user->can('view-products');
    }

    /**
     * Determine whether the user can create product categories.
     */
    public function create(User $user): bool
    {
        return $user->can('manage-product-categories');
    }

    /**
     * Determine whether the user can update the product category.
     */
    public function update(User $user, ProductCategory $productCategory): bool
    {
        return $user->can('manage-product-categories');
    }

    /**
     * Determine whether the user can delete the product category.
     */
    public function delete(User $user, ProductCategory $productCategory): bool
    {
        return $user->can('manage-product-categories');
    }
}
