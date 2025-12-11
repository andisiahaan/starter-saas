<?php

namespace App\Livewire\Admin\Blog\Modals;

use App\Helpers\Toast;
use App\Models\BlogTag;
use AndiSiahaan\LivewireModal\ModalComponent;

class TagForm extends ModalComponent
{
    public ?int $tagId = null;
    
    public string $name = '';
    public string $slug = '';
    public string $description = '';

    public function mount(?int $tagId = null)
    {
        $this->tagId = $tagId;
        
        if ($tagId) {
            $tag = BlogTag::findOrFail($tagId);
            $this->name = $tag->name;
            $this->slug = $tag->slug;
            $this->description = $tag->description ?? '';
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
            'slug' => 'required|string|max:255|unique:blog_tags,slug,' . $this->tagId,
            'description' => 'nullable|string',
        ]);

        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description ?: null,
        ];

        if ($this->tagId) {
            BlogTag::findOrFail($this->tagId)->update($data);
            Toast::success('Tag updated successfully.');
        } else {
            BlogTag::create($data);
            Toast::success('Tag created successfully.');
        }

        $this->dispatch('closeModal');
        $this->dispatch('refreshTags');
    }

    public function render()
    {
        return view('admin.livewire.blog.modals.tag-form');
    }
}
