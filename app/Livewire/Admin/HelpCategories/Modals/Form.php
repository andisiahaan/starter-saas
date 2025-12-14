<?php

namespace App\Livewire\Admin\HelpCategories\Modals;

use App\Helpers\Toast;
use App\Models\HelpCategory;
use AndiSiahaan\LivewireModal\ModalComponent;
use Illuminate\Support\Str;

class Form extends ModalComponent
{
    public ?int $categoryId = null;
    
    public string $name = '';
    public string $slug = '';
    public string $icon = '';
    public string $description = '';
    public int $order_column = 0;
    public bool $is_active = true;

    public function mount(?int $categoryId = null)
    {
        $this->categoryId = $categoryId;
        
        if ($categoryId) {
            $category = HelpCategory::findOrFail($categoryId);
            $this->name = $category->name;
            $this->slug = $category->slug;
            $this->icon = $category->icon ?? '';
            $this->description = $category->description ?? '';
            $this->order_column = $category->order_column;
            $this->is_active = $category->is_active;
        } else {
            // Set default order to max + 1
            $this->order_column = HelpCategory::max('order_column') + 1;
        }
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:help_categories,slug,' . $this->categoryId,
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'order_column' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'icon' => $this->icon ?: null,
            'description' => $this->description ?: null,
            'order_column' => $this->order_column,
            'is_active' => $this->is_active,
        ];

        if ($this->categoryId) {
            HelpCategory::findOrFail($this->categoryId)->update($data);
            Toast::success(__('help.admin.categories.messages.updated'));
        } else {
            HelpCategory::create($data);
            Toast::success(__('help.admin.categories.messages.created'));
        }

        $this->dispatch('closeModal');
        $this->dispatch('refreshCategories');
    }

    public function render()
    {
        return view('admin.livewire.help-categories.modals.form');
    }
}
