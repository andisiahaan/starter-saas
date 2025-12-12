<div>
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-slate-900 dark:text-white"><?php echo e(__('admin.pages_index.title')); ?></h1>
            <p class="mt-2 text-sm text-slate-500 dark:text-slate-400"><?php echo e(__('admin.pages_index.description')); ?></p>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
            <button wire:click="$dispatch('openModal', { component: 'admin.pages.modals.create-edit-page-modal' })" type="button" class="inline-flex items-center justify-center rounded-md border border-transparent bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 sm:w-auto">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <?php echo e(__('admin.pages_index.add')); ?>

            </button>
        </div>
    </div>

    <div class="mt-4">
        <input wire:model.live.debounce.300ms="search" type="text" placeholder="<?php echo e(__('admin.pages_index.filters.search')); ?>" class="block w-full sm:w-64 rounded-md border-slate-300 dark:border-dark-border bg-white dark:bg-dark-elevated text-slate-900 dark:text-white sm:text-sm focus:border-primary-500 focus:ring-primary-500">
    </div>

    <div class="mt-6 overflow-hidden shadow ring-1 ring-slate-200 dark:ring-dark-border md:rounded-lg">
        <table class="min-w-full divide-y divide-slate-200 dark:divide-dark-border">
            <thead class="bg-slate-50 dark:bg-dark-soft">
                <tr>
                    <th class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-slate-900 dark:text-white sm:pl-6"><?php echo e(__('admin.pages_index.table.title')); ?></th>
                    <th class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900 dark:text-white"><?php echo e(__('admin.pages_index.table.slug')); ?></th>
                    <th class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900 dark:text-white"><?php echo e(__('admin.pages_index.table.status')); ?></th>
                    <th class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900 dark:text-white"><?php echo e(__('admin.pages_index.table.layout')); ?></th>
                    <th class="relative py-3.5 pl-3 pr-4 sm:pr-6"><span class="sr-only"><?php echo e(__('common.table.actions')); ?></span></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 dark:divide-dark-border bg-white dark:bg-dark-base">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <tr class="hover:bg-slate-50 dark:hover:bg-dark-elevated transition-colors">
                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-slate-900 dark:text-white sm:pl-6"><?php echo e($page->title); ?></td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-500 dark:text-slate-400">
                        <a href="<?php echo e(url('/page/' . $page->slug)); ?>" target="_blank" class="text-primary-600 dark:text-primary-400 hover:underline">/page/<?php echo e($page->slug); ?></a>
                    </td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm">
                        <button wire:click="togglePublish(<?php echo e($page->id); ?>)" class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium <?php echo e($page->is_published ? 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400' : 'bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300'); ?>">
                            <?php echo e($page->is_published ? __('admin.pages_index.status.published') : __('admin.pages_index.status.draft')); ?>

                        </button>
                    </td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-600 dark:text-slate-300"><?php echo e(ucfirst($page->layout)); ?></td>
                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                        <button wire:click="$dispatch('openModal', { component: 'admin.pages.modals.create-edit-page-modal', arguments: { pageId: <?php echo e($page->id); ?> } })" class="text-primary-600 dark:text-primary-400 hover:text-primary-500 dark:hover:text-primary-300 mr-3"><?php echo e(__('common.actions.edit')); ?></button>
                        <button wire:click="$dispatch('openModal', { component: 'admin.pages.modals.delete-page-modal', arguments: { pageId: <?php echo e($page->id); ?> } })" class="text-red-600 dark:text-red-400 hover:text-red-500 dark:hover:text-red-300"><?php echo e(__('common.actions.delete')); ?></button>
                    </td>
                </tr>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-sm text-slate-500 dark:text-slate-400"><?php echo e(__('admin.pages_index.empty')); ?></td>
                </tr>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-4"><?php echo e($pages->links()); ?></div>
</div><?php /**PATH D:\Installed\Apps\laragon\www\starter\resources\views/admin/livewire/pages/index.blade.php ENDPATH**/ ?>