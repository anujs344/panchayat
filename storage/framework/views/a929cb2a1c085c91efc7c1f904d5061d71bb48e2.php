<?php $__env->startSection('title', 'Post'); ?>

<?php $__env->startSection('content'); ?>

<section id="page-header" class="mb-5">
    <div class="header-poster">
            <img src="<?php echo e(asset('assets_home\img\page-poster.jpg')); ?>" alt="">
        <div class="content">
           <div class="info">
            <h1 class="page-title">
                <?php echo e(ucwords($type)); ?>

            </h1>
            
           </div>
        </div>
    </div>
</section>

<section id="blog-card" class="overflow-hidden">
    <div class="container-fluid my-4">
        <div class="row">
        <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php if($list->post_type == 'article'): ?>
        <div class="col-12 col-sm-6 mb-3">
            <div class="news-card">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="image">
                            <a href="<?php echo e(route('post.view', [$list->post_type, $list->slug])); ?>">
                            <img src="<?php echo e($list->post_image_gallery_id ? asset('storage/media/images/post_image_gallery/'.$list->mainImage->image) : $list->opt_image_url); ?>" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-2 mt-lg-0">
                        <div class="card-desc">
                            <a href="<?php echo e(route('post.view', [$list->post_type, $list->slug])); ?>">
                                <h5 class="news-title">
                                    <?php echo e(ucwords($list->title)); ?>

                                </h5>
                            </a>
                            <a href="<?php echo e(route('post.article')); ?>" >
                                <span class="text-muted small l-d"><?php echo e(ucfirst($list->post_type)); ?></span>
                            </a>
                            <a href="<?php echo e(route('post.author', [$list->author])); ?>" >
                                <p class="author"><?php echo e(ucwords($list->author)); ?></p>
                            </a>
                            <div class="l-d">
                                <a href="<?php echo e(route('post.fromLocationPost', [$list->location])); ?>">
                                    <small><?php echo e(ucwords($list->location)); ?></small>
                                </a>
                                <span class="mx-2"> | </span>
                                <small> <?php echo e(date('M d, Y', strtotime($list->created_at))); ?> </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>                            
        <?php endif; ?>
        <?php if($list->post_type == 'video' || $list->post_type == 'वीडियो'): ?>
        <div class="col-12 col-sm-6 mb-3">
            <div class="news-card">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="image">
                            <a href="<?php echo e(route('post.view', [$list->post_type, $list->slug])); ?>">
                                <iframe src="<?php echo e($list->video_embed_url); ?>" id="video_embed_preview" frameborder="0" allow="encrypted-media" allowfullscreen class="video-embed-preview" style="height:100%;width:100%;"></iframe>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-2 mt-lg-0">
                        <div class="card-desc">
                            <a href="<?php echo e(route('post.view', [$list->post_type, $list->slug])); ?>">
                                <h5 class="news-title">
                                    <?php echo e(ucwords($list->title)); ?>

                                </h5>
                            </a>
                            <a href="<?php echo e(route('post.video')); ?>" >
                                <span class="text-muted small l-d"><?php echo e(ucfirst($list->post_type)); ?></span>
                            </a>
                            <a href="<?php echo e(route('post.author', [$list->author])); ?>" >
                                <p class="author"><?php echo e(ucwords($list->author)); ?></p>
                            </a>
                            <div class="l-d">
                                <a href="<?php echo e(route('post.fromLocationPost', [$list->location])); ?>">
                                    <small><?php echo e(ucwords($list->location)); ?></small>
                                </a>
                                <span class="mx-2"> | </span>
                                <small> <?php echo e(date('M d, Y', strtotime($list->created_at))); ?> </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="ms-4"><?php echo e('No posts available...'); ?></div>                   
        <?php endif; ?>
        </div>
    </div>
</section>

<div class="d-flex justify-content-center"><?php echo e($posts->links()); ?></div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thepanchayat/public_html/resources/views/homepage/post-type.blade.php ENDPATH**/ ?>