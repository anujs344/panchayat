<footer class="p-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                <a href=""><p><strong>About Us</strong></p></a>
                <a href=""><p>Contact Us</p></a>
                <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(route('profile.show')); ?>"><p>My Profile</p></a>
                <?php else: ?>
                <a href="<?php echo e(route('register')); ?>"><p>Join Us</p></a>
                <?php endif; ?>
                <a href=""><p>Privacy Policy</p></a>
                <a href=""><p>Terms of Service</p></a>
            </div>
            <div class="col-lg-3">
                <a href=""><p>Newsletter </p></a>
                <a href=""><p>Blog</p></a>
                <div class="social-links mb-3">
                    <a href=""><p><strong>Social Links</strong></p></a>
                    <a href="<?php echo e(isset($socialMediaLink) ? $socialMediaLink->facebook_url : ''); ?>"><i class="fab fa-facebook fa-lg me-2 text-white"></i></a>
                    <a href="<?php echo e(isset($socialMediaLink) ? $socialMediaLink->twitter_url : ''); ?>"><i class="fab fa-twitter fa-lg me-2 text-white"></i></a>
                    <a href="<?php echo e(isset($socialMediaLink) ? $socialMediaLink->instagram_url : ''); ?>"><i class="fab fa-instagram fa-lg me-2 text-white"></i></a>
                    <a href="<?php echo e(isset($socialMediaLink) ? $socialMediaLink->youtube_url : ''); ?>"><i class="fab fa-youtube fa-lg me-2 text-white"></i></a>
                </div>
            </div>
            <div class="col-lg-3">
                <p class="text-warning"><strong>Quick Links</strong></p>
                
                <?php if(isset($home)): ?>
                    <a aria-current="page" href="<?php echo e(route('home')); ?>"><p>Home</p></a>
                <?php endif; ?>
                
                <?php $__currentLoopData = $navigations->where('title', '!=', 'home')->where('footer_status',1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('category.view', [$n->link])); ?>"><p><?php echo e(ucfirst($n->category->name)); ?></p></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                
            </div>
            <div class="col-lg-3 border-0">
                <p><strong class="text-warning">Recieve Our News & Updates</strong></p>
                <form action="<?php echo e(route('newsletterSubscribe')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="email" name="email" placeholder="Enter Email" class="form-control form-control-sm">
                    <button type="submit" class="btn btn-sm btn-primary w-100 my-3">Subscribe Now</button>
                </form>
            </div>
        </div>
    </div>
</footer><?php /**PATH /home/thepanchayat/public_html/resources/views/livewire/user/footer.blade.php ENDPATH**/ ?>