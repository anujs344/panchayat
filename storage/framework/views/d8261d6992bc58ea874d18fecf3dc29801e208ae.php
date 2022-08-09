
<?php $__env->startSection('title', 'Home'); ?>

<?php $__env->startSection('content'); ?>

<section id="main-carousel">
    <?php if(count($sliders) > 0): ?>
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php $__currentLoopData = $sliders->take(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="carousel-item active">
                <img src="<?php echo e($post->post_image_gallery_id ? $post->mainImage? asset('storage/media/images/post_image_gallery/'.$post->mainImage->image) : ('') : $post->opt_image_url); ?>" alt="" class="d-block w-100">
                <div class="content">
                    <div class="container-fluid">
                       <a href="<?php echo e(route('post.view', [$post->post_type, $post->slug])); ?>">
                            <h1><?php echo e(ucfirst($post->title)); ?></h1>
                            
                            <div class="l-d">
                                <h5 class="mt-4 author text-white"> <?php echo e(ucwords($post->author)); ?> </h5>
                                <span class="text-white"><?php echo e(ucwords($post->location)); ?></span>
                                <span class="mx-2 text-warning"> | </span>
                                <span class="text-white"> <?php echo e(date('M d, Y', strtotime($post->created_at))); ?> </span>
                            </div>
                       </a>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
            <?php $__currentLoopData = $sliders->skip(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="carousel-item">
                <img src="<?php echo e($post->post_image_gallery_id ? $post->mainImage? asset('storage/media/images/post_image_gallery/'.$post->mainImage->image) : ('') : $post->opt_image_url); ?>" alt="" class="d-block w-100">
                <div class="content">
                    <div class="container-fluid">
                       <a href="<?php echo e(route('post.view', [$post->post_type, $post->slug])); ?>">
                        <h1><?php echo e(ucfirst($post->title)); ?></h1>
                        
                        <div class="l-d">
                            <h5 class="mt-4 author text-white"> <?php echo e(ucwords($post->author)); ?> </h5>
                            <span class="text-white"><?php echo e(ucwords($post->location)); ?></span>
                            <span class="mx-2 text-warning"> | </span>
                            <span class="text-white"> <?php echo e(date('M d, Y', strtotime($post->created_at))); ?> </span>
                        </div>
                       </a>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
    </div>
    <?php endif; ?>
</section>


<?php $__empty_1 = true; $__currentLoopData = $navigations->where('title', '!=', 'home'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<?php if($n->category->name == 'वीडियो' || $n->category->name == 'video'): ?>
<section id="video-blog">
    <div class="head d-flex mb-5 mt-3" style="justify-content: space-between; align-items: baseline;">
        <h4 class="" id="heading"><?php echo e(ucwords($n->category->name)); ?></h4>
        <span class="more float-end"><a href="<?php echo e(route('category.view', [$n->category->slug])); ?>" style="text-decoration: underline; color:#000">View More</a></span>
    </div>
    <?php if(auth()->guard()->check()): ?>
    <?php if(count($n->category->posts->where('visibility',1)->where('status',1)) > 0): ?>
    <div class="row">
        <?php $__currentLoopData = $n->category->posts->where('visibility',1)->where('status',1)->take(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-lg-6">
            <div class="big-video d-none d-lg-block">
                <a href="<?php echo e(route('post.view', [$list->post_type, $list->slug])); ?>">
                    <iframe src="<?php echo e($list->video_embed_url); ?>" id="video_embed_preview" frameborder="0" allow="encrypted-media" allowfullscreen class="video-embed-preview"></iframe>
                </a>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div class="col-lg-6 mt-2 mt-lg-0">
            <div class="small-vid row row-cols-1 row-cols-sm-2 row-cols-lg-1">
                <?php $__currentLoopData = $n->category->posts->where('visibility',1)->where('status',1)->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col mb-3 mb-lg-auto">
                    <div class="row mb-2">
                        <div class="col-lg-6 col-12 mb-2">
                            <div class="vid">
                                <!--<a href="<?php echo e(route('post.view', [$list->post_type, $list->slug])); ?>">-->
                                    <iframe src="<?php echo e($list->video_embed_url); ?>" id="video_embed_preview" frameborder="0" allow="encrypted-media" allowfullscreen class="video-embed-preview"></iframe>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="card-desc">
                                <a href="<?php echo e(route('post.view', [$list->post_type, $list->slug])); ?>">
                                    <h5 class="news-title">
                                        <?php echo e(ucwords($list->title)); ?>

                                    </h5>
                                </a>
                                <a href="<?php echo e(route('post.video')); ?>" >
                                    <span class="text-muted small"><?php echo e(ucfirst($list->post_type)); ?></span>
                                </a>
                                <a href="<?php echo e(route('post.author', [$list->author])); ?>" >
                                    <div class="author text-warning"><?php echo e(ucwords($list->author)); ?></div>
                                </a>
                                <div class="l-d">
                                    <a href="<?php echo e(route('post.fromLocationPost', [$list->location])); ?>">
                                        <small><?php echo e(ucwords($list->location)); ?></small>
                                    </a>
                                    <span class="mx-2"> | </span>
                                    <small class="text-muted"> <?php echo e(date('M d, Y', strtotime($list->created_at))); ?> </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <?php else: ?>
        <div class="ms-4 py-0">No posts available...</div>
    <?php endif; ?>
    <?php else: ?>
    <?php if(count($n->category->posts->where('visibility',1)->where('status',1)->where('show_auth_user', '!=', 1)) > 0): ?>
        <div class="row">
            <?php $__currentLoopData = $n->category->posts->where('visibility',1)->where('status',1)->where('show_auth_user', '!=', 1)->take(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-6">
                <div class="big-video d-none d-lg-block">
                    <a href="<?php echo e(route('post.view', [$list->post_type, $list->slug])); ?>">
                        <iframe src="<?php echo e($list->video_embed_url); ?>" id="video_embed_preview" frameborder="0" allow="encrypted-media" allowfullscreen class="video-embed-preview"></iframe>
                    </a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-6 mt-2 mt-lg-0">
                <div class="small-vid row row-cols-1 row-cols-sm-2 row-cols-lg-1">
                    <?php $__currentLoopData = $n->category->posts->where('visibility',1)->where('status',1)->where('show_auth_user', '!=', 1)->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col mb-3 mb-lg-auto">
                        <div class="row mb-2">
                            <div class="col-lg-6 col-12 mb-2">
                                <div class="vid">
                                    <a href="<?php echo e(route('post.view', [$list->post_type, $list->slug])); ?>">
                                        <iframe src="<?php echo e($list->video_embed_url); ?>" id="video_embed_preview" frameborder="0" allow="encrypted-media" allowfullscreen class="video-embed-preview"></iframe>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="card-desc">
                                    <a href="<?php echo e(route('post.view', [$list->post_type, $list->slug])); ?>">
                                        <h5 class="news-title">
                                            <?php echo e(ucwords($list->title)); ?>

                                        </h5>
                                    </a>
                                    <a href="<?php echo e(route('post.video')); ?>" >
                                        <span class="text-muted small"><?php echo e(ucfirst($list->post_type)); ?></span>
                                    </a>
                                    <a href="<?php echo e(route('post.author', [$list->author])); ?>" >
                                        <div class="author text-warning"><?php echo e(ucwords($list->author)); ?></div>
                                    </a>
                                    <div class="l-d">
                                        <a href="<?php echo e(route('post.fromLocationPost', [$list->location])); ?>">
                                            <small><?php echo e(ucwords($list->location)); ?></small>
                                        </a>
                                        <span class="mx-2"> | </span>
                                        <small class="text-muted"> <?php echo e(date('M d, Y', strtotime($list->created_at))); ?> </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="ms-4 py-0">No posts available...</div>
    <?php endif; ?>
    <?php endif; ?>
</section>
<?php else: ?>
<section id="blog-card" class="overflow-hidden">
    <div class="container-fluid my-4">
        <div class="head d-flex mb-4" style="justify-content: space-between; align-items: baseline;">
            <h4 id="heading"><?php echo e(ucwords($n->category->name)); ?></h4>
            <a href="<?php echo e(route('category.view', [$n->category->slug])); ?>" style="text-decoration: underline; color:#000">View More</a>
        </div>
        <div class="row">
        <?php if(auth()->guard()->check()): ?>
            <?php $__empty_2 = true; $__currentLoopData = $n->category->posts->where('visibility',1)->where('status',1)->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                <?php if($list->post_type == 'article'): ?>
                <div class="col-12 col-sm-6 mb-3">
                    <div class="news-card">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="image">
                                    <a href="<?php echo e(route('post.view', [$list->post_type, $list->slug])); ?>">
                                        <img src="<?php echo e($list->post_image_gallery_id ? $list->mainImage?  asset('storage/media/images/post_image_gallery/'.$list->mainImage->image) : ('') : $list->opt_image_url); ?>" alt="">
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
                                        <span class="text-muted small"><?php echo e(ucfirst($list->post_type)); ?></span>
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
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                <div class="ms-4 my-0">
                    <?php echo e('No post available...'); ?>

                </div>
            <?php endif; ?>
        <?php else: ?>
            <?php $__empty_2 = true; $__currentLoopData = $n->category->posts->where('visibility',1)->where('status',1)->where('show_auth_user', '!=', 1)->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                <?php if($list->post_type == 'article'): ?>
                <div class="col-12 col-sm-6 mb-3">
                    <div class="news-card">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="image">
                                    <a href="<?php echo e(route('post.view', [$list->post_type, $list->slug])); ?>">
                                        <img src="<?php echo e($list->post_image_gallery_id ? $list->mainImage?  asset('storage/media/images/post_image_gallery/'.$list->mainImage->image) : ('') : $list->opt_image_url); ?>" alt="">
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
                                        <span class="text-muted small"><?php echo e(ucfirst($list->post_type)); ?></span>
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
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                <div class="ms-4 my-0">
                    <?php echo e('No post available...'); ?>

                </div>
            <?php endif; ?>
        <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="ms-4"><?php echo e('No posts available...'); ?></div>
<?php endif; ?>





<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thepanchayat/public_html/resources/views/homepage/index.blade.php ENDPATH**/ ?>