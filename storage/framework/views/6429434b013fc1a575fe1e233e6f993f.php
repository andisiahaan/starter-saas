<?php if (isset($component)) { $__componentOriginal58d4f08fcba9bdce9e2c67f691ab9981 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal58d4f08fcba9bdce9e2c67f691ab9981 = $attributes; } ?>
<?php $component = App\View\Components\Layouts\Main::resolve(['title' => $category->name . ' - Blog'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.main'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Layouts\Main::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header -->
        <div class="mb-8">
            <a href="<?php echo e(route('blog.index')); ?>" class="text-sm text-slate-500 dark:text-slate-400 hover:text-primary-600 dark:hover:text-primary-400">← Back to Blog</a>
            <h1 class="text-3xl font-bold text-slate-900 dark:text-white mt-4"><?php echo e($category->name); ?></h1>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($category->description): ?>
            <p class="text-slate-600 dark:text-slate-400 mt-2"><?php echo e($category->description); ?></p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <!-- Posts -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
            <a href="<?php echo e(route('blog.show', $post->slug)); ?>" class="group block bg-white dark:bg-dark-elevated rounded-xl border border-slate-200 dark:border-dark-border overflow-hidden hover:shadow-lg transition">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->featured_image): ?>
                <img src="<?php echo e(Storage::url($post->featured_image)); ?>" alt="<?php echo e($post->title); ?>" class="w-full h-40 object-cover">
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <div class="p-5">
                    <span class="text-xs text-slate-500 dark:text-slate-400"><?php echo e($post->reading_time); ?> min read</span>
                    <h3 class="mt-2 font-semibold text-slate-900 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400 transition line-clamp-2"><?php echo e($post->title); ?></h3>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->excerpt): ?>
                    <p class="mt-2 text-sm text-slate-600 dark:text-slate-400 line-clamp-2"><?php echo e($post->excerpt); ?></p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <p class="mt-4 text-xs text-slate-500 dark:text-slate-400"><?php echo e($post->published_at->format('M d, Y')); ?></p>
                </div>
            </a>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            <div class="col-span-3 text-center py-12 text-slate-500 dark:text-slate-400">
                No posts in this category yet.
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <div class="mt-8">
            <?php echo e($posts->links()); ?>

        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal58d4f08fcba9bdce9e2c67f691ab9981)): ?>
<?php $attributes = $__attributesOriginal58d4f08fcba9bdce9e2c67f691ab9981; ?>
<?php unset($__attributesOriginal58d4f08fcba9bdce9e2c67f691ab9981); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal58d4f08fcba9bdce9e2c67f691ab9981)): ?>
<?php $component = $__componentOriginal58d4f08fcba9bdce9e2c67f691ab9981; ?>
<?php unset($__componentOriginal58d4f08fcba9bdce9e2c67f691ab9981); ?>
<?php endif; ?>
<?php /**PATH D:\Installed\Apps\laragon\www\starter\resources\views/blog/category.blade.php ENDPATH**/ ?>