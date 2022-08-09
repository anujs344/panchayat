<div class="sticky-top">
    <section id="navbar">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid px-3 ps-lg-4">
                <a class="navbar-brand m-auto" href="<?php echo e(route('home')); ?>">
                    <div class="logo d-flex align-items-center">
                        <img src="<?php echo e(isset($visualSetting) ? asset('storage/media/images/logo/' . $visualSetting->logo) : ''); ?>" alt="" class="me-2 logo-img">
                        <div class="logo-text"><?php echo e(config('app.name', '')); ?></div>
                    </div>
                </a>
                <a class="nav-link btn btn-success btn-sm text-white" role="button" href="">Subscribe</a>
            </div>
        </nav>
        <nav class="navbar navbar-expand-lg navbar-dark nav2-bg">
            <div class="container-fluid px-3 ps-lg-4">
                <!--<a class="navbar-brand" href="<?php echo e(route('home')); ?>">-->
                <!--    <div class="logo d-flex align-items-center">-->
                <!--        <img src="<?php echo e(isset($visualSetting) ? asset('storage/media/images/logo/' . $visualSetting->logo) : ''); ?>" alt="" class="me-2" style="width: 80px;height:80px;">-->
                <!--        <div class="logo-text"><?php echo e(config('app.name', '')); ?></div>-->
                <!--    </div>-->
                <!--</a>-->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav m-auto mb-2 mb-lg-0">
                        
                        <?php if(isset($home)): ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="<?php echo e(route('home')); ?>">Home</a>
                        </li>
                        <?php endif; ?>
                        
                        <?php $__currentLoopData = $navigations->where('title', '!=', 'home'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($n->category->child->count() > 0): ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="stories" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php echo e(ucfirst($n->category->name)); ?>

                                    
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="stories">
                                    <?php $__currentLoopData = $n->category->child; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="nav-item ms-2">
                                        <a class="nav-link" href="<?php echo e(route('subcategory.view', [$sub->slug])); ?>">
                                            <i class="fas fa-long-arrow-alt-right fa-sm d-lg-none pe-3"></i>
                                            <?php echo e(ucfirst($sub->name)); ?>

                                        </a>
                                    </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </li>
                            <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('category.view', [$n->link])); ?>"><?php echo e(ucfirst($n->category->name)); ?></a>
                            </li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                        <!--<li class="nav-item">-->
                        <!--    <a class="nav-link btn btn-success btn-sm" role="button" href="">Subscribe</a>-->
                        <!--</li>-->
                    </ul>
                </div>
            </div>
        </nav>    
    </section>
    
    <div class="modal fade" id="search" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog p-0">
          <div class="modal-content p-0">
    
            <div class="modal-body p-0">
              <div class="input-group">
                  <input type="search" placeholder="Search for Blogs, News & more.." class="form-control">
                  <button class="btn btn-dark"><i class="fas fa-search"></i></button>
              </div>
            </div>
    
          </div>
        </div>
    </div>
</div><?php /**PATH /home/thepanchayat/public_html/resources/views/livewire/user/header.blade.php ENDPATH**/ ?>