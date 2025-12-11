<?php

namespace App\Livewire\Admin\Blog\Modals;

use App\Helpers\Toast;
use App\Models\BlogCategory;
use AndiSiahaan\LivewireModal\ModalComponent;

class CategoryForm extends ModalComponent
{
    public ?int $categoryId = null;
    
    public string $name = '';
    public string $slug = '';
    public string $description = '';
    public ?int $parent_id = null;
    public int $order = 0;
    public bool $is_active = true;

    public function mount(?int $categoryId = null)
    {
        $this->categoryId = $categoryId;
        
        if ($categoryId) {
            $category = BlogCategory::findOrFail($categoryId);
            $this->name = $category->name;
            $this->slug = $category->slug;
            $this->description = $category->description ?? '';
            $this->parent_id = $category->parent_id;
            $this->order = $category->order;
            $this->is_active = $category->is_active;
        }
    }

    public function generateSlug()
    {
        $this->slug = \Str::slug($this->name);
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blog_categories,slug,' . $this->categoryId,
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:blog_categories,id',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description ?: null,
            'parent_id' => $this->parent_id,
            'order' => $this->order,
            'is_active' => $this->is_active,
        ];

        if ($this->categoryId) {
            BlogCategory::findOrFail($this->categoryId)->update($data);
            Toast::success('Category updated successfully.');
        } else {
            BlogCategory::create($data);
            Toast::success('Category created successfully.');
        }

        $this->dispatch('closeModal');
        $this->dispatch('refreshCategories');
    }

    public function render()
    {
        $parentCategories = BlogCategory::root()
            ->when($this->categoryId, fn($q) => $q->where('id', '!=', $this->categoryId))
            ->get();

        return view('admin.livewire.blog.modals.category-form', [
            'parentCategories' => $parentCategories,
        ]);
    }
}
