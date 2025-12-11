<?php
    $cookieSettings = [
        'is_enabled' => setting('cookie_consent.is_enabled', false),
        'position' => setting('cookie_consent.position', 'bottom'),
        'theme' => setting('cookie_consent.theme', 'light'),
        'title' => setting('cookie_consent.title', 'We use cookies'),
        'message' => setting('cookie_consent.message', 'This website uses cookies to ensure you get the best experience on our website.'),
        'privacy_policy_url' => setting('cookie_consent.privacy_policy_url', '/page/privacy-policy'),
        'accept_button_text' => setting('cookie_consent.accept_button_text', 'Accept All'),
        'reject_button_text' => setting('cookie_consent.reject_button_text', 'Reject All'),
        'show_reject_button' => setting('cookie_consent.show_reject_button', true),
        'cookie_name' => setting('cookie_consent.cookie_name', 'cookie_consent'),
        'cookie_expiry_days' => setting('cookie_consent.cookie_expiry_days', 365),
    ];
?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cookieSettings['is_enabled']): ?>
<div 
    x-data="cookieConsent(<?php echo \Illuminate\Support\Js::from($cookieSettings)->toHtml() ?>)" 
    x-show="showBanner" 
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-4"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-4"
    x-cloak
    class="fixed z-50 <?php echo e($cookieSettings['position'] === 'top' ? 'top-0 inset-x-0' : ($cookieSettings['position'] === 'bottom-left' ? 'bottom-4 left-4 max-w-md' : ($cookieSettings['position'] === 'bottom-right' ? 'bottom-4 right-4 max-w-md' : 'bottom-0 inset-x-0'))); ?>"
>
    <div class="
        <?php echo e($cookieSettings['theme'] === 'dark' ? 'bg-gray-900 text-white border-gray-700' : ($cookieSettings['theme'] === 'auto' ? 'bg-white dark:bg-gray-900 text-gray-900 dark:text-white border-gray-200 dark:border-gray-700' : 'bg-white text-gray-900 border-gray-200')); ?>

        <?php echo e(in_array($cookieSettings['position'], ['bottom-left', 'bottom-right']) ? 'rounded-lg shadow-2xl' : 'shadow-lg'); ?>

        border p-4 md:p-6
    ">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex-1">
                <h3 class="text-sm font-semibold mb-1"><?php echo e($cookieSettings['title']); ?></h3>
                <p class="text-sm opacity-80">
                    <?php echo e($cookieSettings['message']); ?>

                    <a href="<?php echo e($cookieSettings['privacy_policy_url']); ?>" class="underline hover:no-underline">Learn more</a>
                </p>
            </div>
            <div class="flex flex-wrap gap-2">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cookieSettings['show_reject_button']): ?>
                <button 
                    @click="reject()" 
                    class="px-4 py-2 text-sm font-medium rounded-lg border <?php echo e($cookieSettings['theme'] === 'dark' ? 'border-gray-600 hover:bg-gray-800' : 'border-gray-300 hover:bg-gray-100 dark:border-gray-600 dark:hover:bg-gray-800'); ?> transition"
                >
                    <?php echo e($cookieSettings['reject_button_text']); ?>

                </button>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <button 
                    @click="accept()" 
                    class="px-4 py-2 text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 rounded-lg transition"
                >
                    <?php echo e($cookieSettings['accept_button_text']); ?>

                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('cookieConsent', (settings) => ({
        showBanner: false,
        settings: settings,

        init() {
            const consent = this.getCookie(this.settings.cookie_name);
            if (!consent) {
                setTimeout(() => {
                    this.showBanner = true;
                }, 1000);
            }
        },

        accept() {
            this.setCookie(this.settings.cookie_name, 'accepted', this.settings.cookie_expiry_days);
            this.showBanner = false;
        },

        reject() {
            this.setCookie(this.settings.cookie_name, 'rejected', this.settings.cookie_expiry_days);
            this.showBanner = false;
        },

        setCookie(name, value, days) {
            const date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            document.cookie = name + '=' + value + ';expires=' + date.toUTCString() + ';path=/;SameSite=Lax';
        },

        getCookie(name) {
            const value = '; ' + document.cookie;
            const parts = value.split('; ' + name + '=');
            if (parts.length === 2) return parts.pop().split(';').shift();
            return null;
        }
    }));
});
</script>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH D:\Installed\Apps\laragon\www\starter\resources\views/components/cookie-consent.blade.php ENDPATH**/ ?>