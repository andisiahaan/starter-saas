<div>
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $isEditing ? 'Edit Post' : 'Create New Post' }}</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400">{{ $isEditing ? 'Update your blog post' : 'Write and publish your new blog post' }}</p>
        </div>
        <a href="{{ route('admin.blog.posts.index') }}" class="text-sm text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white">
            ← Back to Posts
        </a>
    </div>

    <form wire:submit="save">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Title & Slug -->
                <div class="bg-white dark:bg-dark-elevated rounded-lg border border-slate-200 dark:border-dark-border p-6">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Title</label>
                            <input type="text" wire:model="title" wire:blur="generateSlug" placeholder="Enter post title" class="block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 text-lg">
                            @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Slug</label>
                            <div class="flex items-center gap-2">
                                <span class="text-sm text-slate-500 dark:text-slate-400">/blog/</span>
                                <input type="text" wire:model="slug" class="flex-1 rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                            </div>
                            @error('slug') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <!-- Excerpt -->
                <div class="bg-white dark:bg-dark-elevated rounded-lg border border-slate-200 dark:border-dark-border p-6">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Excerpt</label>
                    <textarea wire:model="excerpt" rows="2" placeholder="Brief summary of the post (optional)" class="block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm"></textarea>
                    <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">A short description shown in post listings</p>
                    @error('excerpt') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Content with Simple Rich Editor -->
                <div class="bg-white dark:bg-dark-elevated rounded-lg border border-slate-200 dark:border-dark-border p-6">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Content</label>
                    
                    <!-- EasyMDE / SimpleMDE Rich Editor -->
                    <div wire:ignore>
                        <textarea id="content-editor" class="hidden">{{ $content }}</textarea>
                    </div>
                    <textarea wire:model="content" id="content-textarea" class="block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm min-h-[400px] font-mono text-sm" placeholder="Write your content here..."></textarea>
                    @error('content') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">You can use HTML or Markdown formatting</p>
                </div>

                <!-- SEO Settings -->
                <div class="bg-white dark:bg-dark-elevated rounded-lg border border-slate-200 dark:border-dark-border overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-200 dark:border-dark-border">
                        <h3 class="text-sm font-semibold text-slate-900 dark:text-white">SEO Settings</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Meta Title</label>
                            <input type="text" wire:model="meta_title" placeholder="SEO title (max 70 characters)" maxlength="70" class="block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Meta Description</label>
                            <textarea wire:model="meta_description" rows="2" placeholder="SEO description (max 160 characters)" maxlength="160" class="block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Meta Keywords</label>
                            <input type="text" wire:model="meta_keywords" placeholder="Comma-separated keywords" class="block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Publish Settings -->
                <div class="bg-white dark:bg-dark-elevated rounded-lg border border-slate-200 dark:border-dark-border overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-200 dark:border-dark-border">
                        <h3 class="text-sm font-semibold text-slate-900 dark:text-white">Publish</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Status</label>
                            <select wire:model.live="status" class="block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                                <option value="scheduled">Scheduled</option>
                                <option value="archived">Archived</option>
                            </select>
                        </div>
                        @if($status === 'scheduled' || $status === 'published')
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Publish Date</label>
                            <input type="datetime-local" wire:model="published_at" class="block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        @endif
                        <div class="flex flex-col gap-2">
                            <label class="flex items-center gap-2">
                                <input type="checkbox" wire:model="is_featured" class="rounded border-slate-300 dark:border-dark-border text-primary-600 focus:ring-primary-500">
                                <span class="text-sm text-slate-700 dark:text-slate-300">Featured Post</span>
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="checkbox" wire:model="allow_comments" class="rounded border-slate-300 dark:border-dark-border text-primary-600 focus:ring-primary-500">
                                <span class="text-sm text-slate-700 dark:text-slate-300">Allow Comments</span>
                            </label>
                        </div>
                    </div>
                    <div class="px-6 py-4 bg-slate-50 dark:bg-dark-soft border-t border-slate-200 dark:border-dark-border">
                        <button type="submit" class="w-full px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition">
                            {{ $isEditing ? 'Update Post' : 'Publish Post' }}
                        </button>
                    </div>
                </div>

                <!-- Featured Image -->
                <div class="bg-white dark:bg-dark-elevated rounded-lg border border-slate-200 dark:border-dark-border overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-200 dark:border-dark-border">
                        <h3 class="text-sm font-semibold text-slate-900 dark:text-white">Featured Image</h3>
                    </div>
                    <div class="p-6">
                        @if($existing_image || $featured_image)
                        <div class="relative mb-4">
                            <img src="{{ $featured_image ? $featured_image->temporaryUrl() : Storage::url($existing_image) }}" alt="" class="w-full h-40 object-cover rounded-lg">
                            <button type="button" wire:click="removeImage" class="absolute top-2 right-2 p-1 bg-red-500 text-white rounded-full hover:bg-red-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        @endif
                        <input type="file" wire:model="featured_image" accept="image/*" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 dark:file:bg-primary-900/30 dark:file:text-primary-400">
                        @error('featured_image') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Categories -->
                <div class="bg-white dark:bg-dark-elevated rounded-lg border border-slate-200 dark:border-dark-border overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-200 dark:border-dark-border">
                        <h3 class="text-sm font-semibold text-slate-900 dark:text-white">Categories</h3>
                    </div>
                    <div class="p-6 max-h-48 overflow-y-auto">
                        @forelse($categories as $category)
                        <label class="flex items-center gap-2 py-1">
                            <input type="checkbox" wire:model="selected_categories" value="{{ $category->id }}" class="rounded border-slate-300 dark:border-dark-border text-primary-600 focus:ring-primary-500">
                            <span class="text-sm text-slate-700 dark:text-slate-300">{{ $category->name }}</span>
                        </label>
                        @empty
                        <p class="text-sm text-slate-500 dark:text-slate-400">No categories yet. <a href="{{ route('admin.blog.categories.index') }}" class="text-primary-600">Create one</a></p>
                        @endforelse
                    </div>
                </div>

                <!-- Tags -->
                <div class="bg-white dark:bg-dark-elevated rounded-lg border border-slate-200 dark:border-dark-border overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-200 dark:border-dark-border">
                        <h3 class="text-sm font-semibold text-slate-900 dark:text-white">Tags</h3>
                    </div>
                    <div class="p-6 max-h-48 overflow-y-auto">
                        @forelse($tags as $tag)
                        <label class="flex items-center gap-2 py-1">
                            <input type="checkbox" wire:model="selected_tags" value="{{ $tag->id }}" class="rounded border-slate-300 dark:border-dark-border text-primary-600 focus:ring-primary-500">
                            <span class="text-sm text-slate-700 dark:text-slate-300">{{ $tag->name }}</span>
                        </label>
                        @empty
                        <p class="text-sm text-slate-500 dark:text-slate-400">No tags yet. <a href="{{ route('admin.blog.tags.index') }}" class="text-primary-600">Create one</a></p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
