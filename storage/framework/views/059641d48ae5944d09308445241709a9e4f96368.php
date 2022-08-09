<?php
use App\Models\SeoTool;
use App\Models\VisualSetting;

    $seo = SeoTool::first();
    $visualSetting = VisualSetting::first();
?>
<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?php echo e($meta['ogdescription'] ?? ''); ?>">
        <meta name="keywords" content="<?php echo e($meta['keywords'] ?? ''); ?>">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <link rel="icon" href="<?php echo e(isset($visualSetting) ? asset('storage/media/images/logo/' . $visualSetting->favicon_icon) : ''); ?>" type="image/png" />
        <title><?php if(isset($meta['ogtitle'])): ?><?php echo e($meta['ogtitle']); ?><?php else: ?> <?php echo $__env->yieldContent('title'); ?><?php endif; ?></title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="<?php echo e(mix('css/app.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets_home/css/style.css')); ?>">
        
        <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/notifications/css/lobibox.min.css')); ?>" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

        
        <meta property="og:site_name" content="<?php echo e(ucwords($seo->site_title ?? '')); ?>"/>
        <meta property="og:type" content="<?php echo e($meta['ogtype'] ?? 'website'); ?>" />
        <meta property="og:title" content="<?php echo e($meta['ogtitle'] ?? ''); ?>" />
        <meta property="og:description" content="<?php echo e($meta['ogdescription'] ?? ''); ?>" />
        <meta property="og:image" content="<?php echo e($meta['ogimage'] ?? ''); ?>" />
        <meta property="og:url" content="<?php echo e($meta['ogurl'] ?? ''); ?>" />

        <meta name="twitter:title" content="<?php echo e($meta['ogtitle'] ?? ''); ?>">
        <meta name="twitter:description" content="<?php echo e($meta['ogdescription'] ?? ''); ?>">
        <meta name="twitter:image" content="<?php echo e($meta['ogimage'] ?? ''); ?>">
        <meta name="twitter:site" content="<?php echo e('@'.ucwords($seo->site_title ?? '')); ?>">
        

        <?php echo $__env->yieldPushContent('styles'); ?>
        <?php echo \Livewire\Livewire::styles(); ?>


    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('user.header')->html();
} elseif ($_instance->childHasBeenRendered('StpuEdr')) {
    $componentId = $_instance->getRenderedChildComponentId('StpuEdr');
    $componentTag = $_instance->getRenderedChildComponentTagName('StpuEdr');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('StpuEdr');
} else {
    $response = \Livewire\Livewire::mount('user.header');
    $html = $response->html();
    $_instance->logRenderedChild('StpuEdr', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            <?php echo e($slot ?? ''); ?>

            <?php echo $__env->yieldContent('content'); ?>
            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('user.footer')->html();
} elseif ($_instance->childHasBeenRendered('FPOy9Ky')) {
    $componentId = $_instance->getRenderedChildComponentId('FPOy9Ky');
    $componentTag = $_instance->getRenderedChildComponentTagName('FPOy9Ky');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('FPOy9Ky');
} else {
    $response = \Livewire\Livewire::mount('user.footer');
    $html = $response->html();
    $_instance->logRenderedChild('FPOy9Ky', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        </div>

        <!-- Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="<?php echo e(asset('assets_home/js/script.js')); ?>"></script>
        <!-- Plugins -->
        <script src="<?php echo e(asset('js/printThis.js')); ?>"></script>
        <!-- Custom Scripts -->
        <script src="<?php echo e(mix('js/app.js')); ?>" defer></script>
        <!--notification js -->
        <script src="<?php echo e(asset('assets/plugins/notifications/js/lobibox.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/plugins/notifications/js/notifications.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/plugins/notifications/js/notification-custom-script.js')); ?>"></script>

        <?php echo $__env->yieldPushContent('js'); ?>

        <?php echo \Livewire\Livewire::scripts(); ?>


        <script>
            // Notification
            <?php if(session()->has('success')): ?>
                round_success_noti("<?php echo e(session()->get('success')); ?>");
            <?php endif; ?>
            <?php if(session()->has('error')): ?>
                round_error_noti("<?php echo e(session()->get('error')); ?>");
            <?php endif; ?>
            <?php if(session()->has('information')): ?>
                round_info_noti("<?php echo e(session()->get('information')); ?>");
            <?php endif; ?>
            <?php if(session()->has('warning')): ?>
                round_warning_noti("<?php echo e(session()->get('warning')); ?>");
            <?php endif; ?>
        </script>
    </body>
</html>
<?php /**PATH /home/thepanchayat/public_html/resources/views/layouts/guest.blade.php ENDPATH**/ ?>