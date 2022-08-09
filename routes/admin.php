<?php

use Illuminate\Support\Facades\Route;

// Route::fallback(function(){
//     return view('404');
// });

// Admin Routes
Route::name('admin.')->middleware('guest:admin')->group(function () {
    Route::get('/', [App\Http\Controllers\Auth\Admin\AdminLoginController::class, 'create'])->name('loginForm');
    Route::post('/login', [App\Http\Controllers\Auth\Admin\AdminLoginController::class, 'store'])->name('login');
    
    // password
    Route::name('password.')->group(function () {
        Route::get('/forgot-password', [App\Http\Controllers\Auth\Admin\PasswordResetLinkController::class, 'create'])->name('request');
        Route::post('/forgot-password', [App\Http\Controllers\Auth\Admin\PasswordResetLinkController::class, 'store'])->name('email');
        Route::get('/password-reset/{token}', [App\Http\Controllers\Auth\Admin\NewPasswordController::class, 'create'])->name('reset');
        Route::post('/password-reset', [App\Http\Controllers\Auth\Admin\NewPasswordController::class, 'store'])->name('update');
    });
});

Route::name('admin.')->middleware('auth:admin')->group(function(){
    // dashboard
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    // admin
    Route::prefix('administrator')->name('administrator.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'admin'])->name('view');
        Route::get('/edit/{admin}', [App\Http\Controllers\Admin\AdminController::class, 'edit'])->name('edit');
        Route::post('/update/{admin}', [App\Http\Controllers\Admin\AdminController::class, 'update'])->name('update');
    });
    // profile
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\AdminProfileController::class, 'index'])->name('view');
        Route::post('/update/{admin}', [App\Http\Controllers\Admin\AdminProfileController::class, 'update'])->name('update');
        Route::post('/change-password/{admin}', [App\Http\Controllers\Admin\AdminProfileController::class, 'changePassword'])->name('password');
    });
    // staffs
    Route::prefix('staff')->name('staff.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('view');
        Route::get('/create', [App\Http\Controllers\Admin\AdminController::class, 'create'])->name('create');
        Route::post('/store', [App\Http\Controllers\Admin\AdminController::class, 'store'])->name('store');
        Route::get('/edit/{admin}', [App\Http\Controllers\Admin\AdminController::class, 'edit'])->name('edit');
        Route::post('/update/{admin}', [App\Http\Controllers\Admin\AdminController::class, 'update'])->name('update');
        Route::get('/delete/{admin}', [App\Http\Controllers\Admin\AdminController::class, 'destroy'])->name('delete');
    });
    // users
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'user'])->name('view');
        Route::get('/user-delete/{user}', [App\Http\Controllers\Admin\AdminController::class, 'deleteUser'])->name('deleteUser');
    });
    // navigation
    Route::prefix('navigation')->name('navigation.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\NavigationController::class, 'index'])->name('view');
        Route::get('/create', [App\Http\Controllers\Admin\NavigationController::class, 'create'])->name('create');
        Route::post('/store', [App\Http\Controllers\Admin\NavigationController::class, 'store'])->name('store');
        Route::get('/{type}/edit/{navigation}', [App\Http\Controllers\Admin\NavigationController::class, 'edit'])->name('edit');
        Route::post('/update/{navigation}', [App\Http\Controllers\Admin\NavigationController::class, 'update'])->name('update');
        Route::get('/delete/{navigation}', [App\Http\Controllers\Admin\NavigationController::class, 'destroy'])->name('delete');
        Route::get('/deleteSubcategory/{subcategory}', [App\Http\Controllers\Admin\NavigationController::class, 'destroySubcategory'])->name('deleteSubcategory');
        Route::get('/status/{status}/{navigation}', [App\Http\Controllers\Admin\NavigationController::class, 'status'])->name('status');
    });
    // category
    Route::prefix('categories')->name('category.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('view');
        Route::get('/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('create');
        Route::post('/store', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('store');
        Route::get('/show/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'show'])->name('show');
        Route::get('/edit/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('edit');
        Route::post('/update/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('update');
        Route::get('/delete/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('delete');
        Route::get('/status/{status}/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'status'])->name('status');
    });
    // sub category
    Route::prefix('subcategories')->name('subcategory.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\SubcategoryController::class, 'index'])->name('view');
        Route::get('/create', [App\Http\Controllers\Admin\SubcategoryController::class, 'create'])->name('create');
        Route::post('/store', [App\Http\Controllers\Admin\SubcategoryController::class, 'store'])->name('store');
        Route::get('/show/{subcategory}', [App\Http\Controllers\Admin\SubcategoryController::class, 'show'])->name('show');
        Route::get('/edit/{subcategory}', [App\Http\Controllers\Admin\SubcategoryController::class, 'edit'])->name('edit');
        Route::post('/update/{subcategory}', [App\Http\Controllers\Admin\SubcategoryController::class, 'update'])->name('update');
        Route::get('/delete/{subcategory}', [App\Http\Controllers\Admin\SubcategoryController::class, 'destroy'])->name('delete');
        Route::get('/status/{status}/{subcategory}', [App\Http\Controllers\Admin\SubcategoryController::class, 'status'])->name('status');
    });
    // post
    Route::prefix('post')->name('post.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\PostController::class, 'index'])->name('view');
        Route::get('/post-format', [App\Http\Controllers\Admin\PostController::class, 'postFormat'])->name('format');
        Route::get('/add-post', [App\Http\Controllers\Admin\PostController::class, 'create'])->name('create');
        Route::post('/get-subcategory', [App\Http\Controllers\Admin\PostController::class, 'getSubcategory'])->name('getSubcategory');
        Route::post('/get_video_from_url', [App\Http\Controllers\Admin\PostController::class, 'get_video_from_url'])->name('get_video_from_url');
        Route::post('/store', [App\Http\Controllers\Admin\PostController::class, 'store'])->name('store');
        Route::get('/show/{post}', [App\Http\Controllers\Admin\PostController::class, 'show'])->name('show');
        Route::get('/edit/{post}', [App\Http\Controllers\Admin\PostController::class, 'edit'])->name('edit');
        Route::post('/update/{post}', [App\Http\Controllers\Admin\PostController::class, 'update'])->name('update');
        Route::get('/delete/{post}', [App\Http\Controllers\Admin\PostController::class, 'destroy'])->name('delete');
        Route::get('/status/{status}/{post}', [App\Http\Controllers\Admin\PostController::class, 'status'])->name('status');
        Route::post('/delete-selected-posts', [App\Http\Controllers\Admin\PostController::class, 'deleteSelectedPosts'])->name('deleteSelectedPosts');
        Route::get('/bulk-post', [App\Http\Controllers\Admin\PostController::class, 'bulkPost'])->name('bulkPost');
        Route::post('/bulk-post-upload', [App\Http\Controllers\Admin\PostController::class, 'bulkPostUpload'])->name('bulkPostUpload');
        Route::get('/download-template', [App\Http\Controllers\Admin\PostController::class, 'downloadTemplate'])->name('downloadTemplate');
        Route::get('/download-example', [App\Http\Controllers\Admin\PostController::class, 'downloadExample'])->name('downloadExample');
    });

    // slider post
    Route::get('/slider-post', [App\Http\Controllers\Admin\PostController::class, 'sliderPost'])->name('sliderPost');
    // featured post
    Route::get('/featured-post', [App\Http\Controllers\Admin\PostController::class, 'featuredPost'])->name('featuredPost');
    // breaking post
    Route::get('/breaking-post', [App\Http\Controllers\Admin\PostController::class, 'breakingPost'])->name('breakingPost');
    // recommended post
    Route::get('/recommended-post', [App\Http\Controllers\Admin\PostController::class, 'recommendedPost'])->name('recommendedPost');
    // pending post
    Route::get('/inactive-post', [App\Http\Controllers\Admin\PostController::class, 'pendingPost'])->name('pendingPost');
    // scheduled post
    Route::get('/scheduled-post', [App\Http\Controllers\Admin\PostController::class, 'scheduledPost'])->name('scheduledPost');
    // draft post
    Route::get('/draft-post', [App\Http\Controllers\Admin\PostController::class, 'draftPost'])->name('draftPost');

    // post image
    Route::prefix('post-additional-image')->name('postImage.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\PostImageController::class, 'index'])->name('view');
        Route::get('/create', [App\Http\Controllers\Admin\PostImageController::class, 'create'])->name('create');
        Route::post('/store', [App\Http\Controllers\Admin\PostImageController::class, 'store'])->name('store');
        Route::get('/show/{postImage}', [App\Http\Controllers\Admin\PostImageController::class, 'show'])->name('show');
        Route::get('/edit/{postImage}', [App\Http\Controllers\Admin\PostImageController::class, 'edit'])->name('edit');
        Route::post('/update/{postImage}', [App\Http\Controllers\Admin\PostImageController::class, 'update'])->name('update');
        Route::post('/delete/{postImage}', [App\Http\Controllers\Admin\PostImageController::class, 'destroy'])->name('delete');
    });
    // post image gallery
    Route::prefix('post-image-gallery')->name('postImageGallery.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\PostImageGalleryController::class, 'index'])->name('view');
        Route::get('/create', [App\Http\Controllers\Admin\PostImageGalleryController::class, 'create'])->name('create');
        Route::post('/store', [App\Http\Controllers\Admin\PostImageGalleryController::class, 'store'])->name('store');
        Route::get('/show/{postImageGallery}', [App\Http\Controllers\Admin\PostImageGalleryController::class, 'show'])->name('show');
        Route::get('/edit/{postImageGallery}', [App\Http\Controllers\Admin\PostImageGalleryController::class, 'edit'])->name('edit');
        Route::post('/update/{postImageGallery}', [App\Http\Controllers\Admin\PostImageGalleryController::class, 'update'])->name('update');
        Route::post('/delete/{postImageGallery}', [App\Http\Controllers\Admin\PostImageGalleryController::class, 'destroy'])->name('delete');
    });
    // post file gallery
    Route::prefix('post-file-gallery')->name('postFileGallery.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\PostFileGalleryController::class, 'index'])->name('view');
        Route::get('/create', [App\Http\Controllers\Admin\PostFileGalleryController::class, 'create'])->name('create');
        Route::post('/store', [App\Http\Controllers\Admin\PostFileGalleryController::class, 'store'])->name('store');
        Route::get('/show/{postFileGallery}', [App\Http\Controllers\Admin\PostFileGalleryController::class, 'show'])->name('show');
        Route::get('/edit/{postFileGallery}', [App\Http\Controllers\Admin\PostFileGalleryController::class, 'edit'])->name('edit');
        Route::post('/update/{postFileGallery}', [App\Http\Controllers\Admin\PostFileGalleryController::class, 'update'])->name('update');
        Route::post('/delete/{postFileGallery}', [App\Http\Controllers\Admin\PostFileGalleryController::class, 'destroy'])->name('delete');
        
    });
    // post audio gallery
    Route::prefix('post-audio-gallery')->name('postAudioGallery.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\PostAudioGalleryController::class, 'index'])->name('view');
        Route::get('/create', [App\Http\Controllers\Admin\PostAudioGalleryController::class, 'create'])->name('create');
        Route::post('/store', [App\Http\Controllers\Admin\PostAudioGalleryController::class, 'store'])->name('store');
        Route::get('/show/{postAudioGallery}', [App\Http\Controllers\Admin\PostAudioGalleryController::class, 'show'])->name('show');
        Route::get('/edit/{postAudioGallery}', [App\Http\Controllers\Admin\PostAudioGalleryController::class, 'edit'])->name('edit');
        Route::post('/update/{postAudioGallery}', [App\Http\Controllers\Admin\PostAudioGalleryController::class, 'update'])->name('update');
        Route::post('/delete/{postAudioGallery}', [App\Http\Controllers\Admin\PostAudioGalleryController::class, 'destroy'])->name('delete');
        
    });
    // widget
    Route::prefix('widget')->name('widget.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\WidgetController::class, 'index'])->name('view');
        Route::get('/create', [App\Http\Controllers\Admin\WidgetController::class, 'create'])->name('create');
        Route::post('/store', [App\Http\Controllers\Admin\WidgetController::class, 'store'])->name('store');
        Route::get('/show/{widget}', [App\Http\Controllers\Admin\WidgetController::class, 'show'])->name('show');
        Route::get('/edit/{widget}', [App\Http\Controllers\Admin\WidgetController::class, 'edit'])->name('edit');
        Route::post('/update/{widget}', [App\Http\Controllers\Admin\WidgetController::class, 'update'])->name('update');
        Route::get('/delete/{widget}', [App\Http\Controllers\Admin\WidgetController::class, 'destroy'])->name('delete');
        Route::get('/status/{status/{widget}', [App\Http\Controllers\Admin\WidgetController::class, 'status'])->name('status');
    });
    // poll
    // Route::prefix('poll')->name('poll.')->group(function () {
    //     Route::get('/', [App\Http\Controllers\Admin\PollController::class, 'index'])->name('view');
    //     Route::get('/create', [App\Http\Controllers\Admin\PollController::class, 'create'])->name('create');
    //     Route::post('/store', [App\Http\Controllers\Admin\PollController::class, 'store'])->name('store');
    //     Route::get('/show/{poll}', [App\Http\Controllers\Admin\PollController::class, 'show'])->name('show');
    //     Route::get('/edit/{poll}', [App\Http\Controllers\Admin\PollController::class, 'edit'])->name('edit');
    //     Route::post('/update/{poll}', [App\Http\Controllers\Admin\PollController::class, 'update'])->name('update');
    //     Route::get('/delete/{poll}', [App\Http\Controllers\Admin\PollController::class, 'destroy'])->name('delete');
    //     Route::get('/status/{status/{poll}', [App\Http\Controllers\Admin\PollController::class, 'status'])->name('status');
    // });
    // gallery
    Route::prefix('gallery')->name('gallery.')->group(function () {
        // album
        Route::prefix('album')->name('album.')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\GalleryAlbumController::class, 'index'])->name('view');
            Route::get('/create', [App\Http\Controllers\Admin\GalleryAlbumController::class, 'create'])->name('create');
            Route::post('/store', [App\Http\Controllers\Admin\GalleryAlbumController::class, 'store'])->name('store');
            Route::get('/show/{galleryAlbum}', [App\Http\Controllers\Admin\GalleryAlbumController::class, 'show'])->name('show');
            Route::get('/edit/{galleryAlbum}', [App\Http\Controllers\Admin\GalleryAlbumController::class, 'edit'])->name('edit');
            Route::post('/update/{galleryAlbum}', [App\Http\Controllers\Admin\GalleryAlbumController::class, 'update'])->name('update');
            Route::get('/delete/{galleryAlbum}', [App\Http\Controllers\Admin\GalleryAlbumController::class, 'destroy'])->name('delete');
            Route::get('/status/{status/{galleryAlbum}', [App\Http\Controllers\Admin\GalleryAlbumController::class, 'status'])->name('status');
        });
        // category
        Route::prefix('category')->name('category.')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\GalleryCategoryController::class, 'index'])->name('view');
            Route::get('/create', [App\Http\Controllers\Admin\GalleryCategoryController::class, 'create'])->name('create');
            Route::post('/store', [App\Http\Controllers\Admin\GalleryCategoryController::class, 'store'])->name('store');
            Route::get('/show/{galleryCategory}', [App\Http\Controllers\Admin\GalleryCategoryController::class, 'show'])->name('show');
            Route::get('/edit/{galleryCategory}', [App\Http\Controllers\Admin\GalleryCategoryController::class, 'edit'])->name('edit');
            Route::post('/update/{galleryCategory}', [App\Http\Controllers\Admin\GalleryCategoryController::class, 'update'])->name('update');
            Route::get('/delete/{galleryCategory}', [App\Http\Controllers\Admin\GalleryCategoryController::class, 'destroy'])->name('delete');
            Route::get('/status/{status/{galleryCategory}', [App\Http\Controllers\Admin\GalleryCategoryController::class, 'status'])->name('status');
        });
        // image
        Route::prefix('image')->name('image.')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\GalleryImageController::class, 'index'])->name('view');
            Route::get('/create', [App\Http\Controllers\Admin\GalleryImageController::class, 'create'])->name('create');
            Route::post('/store', [App\Http\Controllers\Admin\GalleryImageController::class, 'store'])->name('store');
            Route::get('/show/{galleryImage}', [App\Http\Controllers\Admin\GalleryImageController::class, 'show'])->name('show');
            Route::get('/edit/{galleryImage}', [App\Http\Controllers\Admin\GalleryImageController::class, 'edit'])->name('edit');
            Route::post('/update/{galleryImage}', [App\Http\Controllers\Admin\GalleryImageController::class, 'update'])->name('update');
            Route::post('/getCategory', [App\Http\Controllers\Admin\GalleryImageController::class, 'getCategory'])->name('getCategory');
            Route::get('/delete/{galleryImage}', [App\Http\Controllers\Admin\GalleryImageController::class, 'destroy'])->name('delete');
            Route::get('/status/{status/{galleryImage}', [App\Http\Controllers\Admin\GalleryImageController::class, 'status'])->name('status');
        });

    });
    // contact-message
    Route::prefix('contact-message')->name('contactMessage.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\ContactMessageController::class, 'index'])->name('view');
        Route::post('/delete/{contactMessage}', [App\Http\Controllers\Admin\ContactMessageController::class, 'destroy'])->name('delete');
    });
    // comment
    Route::prefix('comment')->name('comment.')->group(function () {
        Route::get('/pending', [App\Http\Controllers\Admin\CommentController::class, 'pending'])->name('pending');
        Route::get('/approved', [App\Http\Controllers\Admin\CommentController::class, 'approved'])->name('approved');
        Route::get('/edit/{comment}', [App\Http\Controllers\Admin\CommentController::class, 'edit'])->name('edit');
        Route::post('/update/{comment}', [App\Http\Controllers\Admin\CommentController::class, 'update'])->name('update');
        Route::get('/delete-pending/{comment}', [App\Http\Controllers\Admin\CommentController::class, 'destroyPending'])->name('deletePending');
        Route::get('/delete-approved/{comment}', [App\Http\Controllers\Admin\CommentController::class, 'destroyApproved'])->name('deleteApproved');
    });
    // newsletter
    Route::prefix('newsletter')->name('newsletter.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\NewsletterController::class, 'index'])->name('view');
        Route::get('/create', [App\Http\Controllers\Admin\NewsletterController::class, 'create'])->name('create');
        Route::post('/store', [App\Http\Controllers\Admin\NewsletterController::class, 'store'])->name('store');
        Route::get('/show/{newsletter}', [App\Http\Controllers\Admin\NewsletterController::class, 'show'])->name('show');
        Route::get('/edit/{newsletter}', [App\Http\Controllers\Admin\NewsletterController::class, 'edit'])->name('edit');
        Route::post('/update/{newsletter}', [App\Http\Controllers\Admin\NewsletterController::class, 'update'])->name('update');
        Route::get('/delete/{newsletter}', [App\Http\Controllers\Admin\NewsletterController::class, 'destroy'])->name('delete');

        // newsletter subscriber
        Route::prefix('subscriber')->name('subscriber.')->group(function() {
            Route::get('/', [App\Http\Controllers\Admin\NewsletterSubscriberController::class, 'index'])->name('view');
            Route::get('/send-newsletter/{newsletter}', [App\Http\Controllers\Admin\NewsletterSubscriberController::class, 'sendNewsletter'])->name('sendNewsletter');
            Route::get('/send-custom-newsletter/{email}', [App\Http\Controllers\Admin\NewsletterSubscriberController::class, 'sendCustomNewsletter'])->name('sendCustomNewsletter');
            Route::post('/send', [App\Http\Controllers\Admin\NewsletterSubscriberController::class, 'send'])->name('send');
            Route::get('/delete/{newsletterSubscriber}', [App\Http\Controllers\Admin\NewsletterSubscriberController::class, 'destroy'])->name('delete');
        });
    });
    // role
    Route::prefix('roles')->name('role.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\RoleController::class, 'index'])->name('view');
        Route::get('/create', [App\Http\Controllers\Admin\RoleController::class, 'create'])->name('create');
        Route::post('/store', [App\Http\Controllers\Admin\RoleController::class, 'store'])->name('store');
        Route::get('/show/{role}', [App\Http\Controllers\Admin\RoleController::class, 'show'])->name('show');
        Route::get('/edit/{role}', [App\Http\Controllers\Admin\RoleController::class, 'edit'])->name('edit');
        Route::post('/update/{role}', [App\Http\Controllers\Admin\RoleController::class, 'update'])->name('update');
        Route::post('/delete/{role}', [App\Http\Controllers\Admin\RoleController::class, 'destroy'])->name('delete');
        Route::get('/status/{status/{role}', [App\Http\Controllers\Admin\RoleController::class, 'status'])->name('status');
    });
    // settings controller
    Route::prefix('settings')->name('settings.')->group(function () {

        // seo tools  Settings
        Route::prefix('seo-tools')->name('seo.')->group(function () {
            Route::get('/',[App\Http\Controllers\Admin\SeoToolController::class, 'index'])->name('view');
            Route::post('/store',[App\Http\Controllers\Admin\SeoToolController::class, 'store'])->name('store');
        });
        
        // social login  Settings
        Route::prefix('social-login')->name('socialLogin.')->group(function () {
            Route::get('/',[App\Http\Controllers\Admin\SocialLoginConfigurationController::class, 'index'])->name('view');
            Route::post('/store/{type}',[App\Http\Controllers\Admin\SocialLoginConfigurationController::class, 'store'])->name('store');
        });

        // email  Settings
        Route::prefix('email')->name('email.')->group(function () {
            Route::get('/',[App\Http\Controllers\Admin\EmailSettingController::class, 'index'])->name('view');
            Route::post('/store/{type}',[App\Http\Controllers\Admin\EmailSettingController::class, 'store'])->name('store');
        });

        // visual  Settings
        Route::prefix('visual')->name('visual.')->group(function () {
            Route::get('/',[App\Http\Controllers\Admin\VisualSettingController::class, 'index'])->name('view');
            Route::post('/store',[App\Http\Controllers\Admin\VisualSettingController::class, 'store'])->name('store');
        });

        // font settings
        Route::prefix('font')->name('font.')->group(function () {
            Route::get('/',[App\Http\Controllers\Admin\FontSettingController::class,'index'])->name('view');
            Route::post('/store',[App\Http\Controllers\Admin\FontSettingController::class,'store'])->name('store');
            Route::get('/edit/{fontSetting}', [App\Http\Controllers\Admin\FontSettingController::class, 'edit'])->name('edit');
            Route::post('/update/{fontSetting}', [App\Http\Controllers\Admin\FontSettingController::class, 'update'])->name('update');
            Route::delete('/delete/{fontSetting}', [App\Http\Controllers\Admin\FontSettingController::class, 'destroy'])->name('delete');
            // site font settings
            Route::post('/site/store',[App\Http\Controllers\Admin\SiteFontSettingController::class,'store'])->name('site');
        });
        
        // Language  Settings
        Route::prefix('language')->name('language.')->group(function () {
            Route::get('/',[App\Http\Controllers\Admin\LanguageSettingController::class, 'index'])->name('view');
            Route::post('/store',[App\Http\Controllers\Admin\LanguageSettingController::class, 'store'])->name('store');
            Route::get('/edit/{languageSetting}', [App\Http\Controllers\Admin\LanguageSettingController::class, 'edit'])->name('edit');
            Route::post('/update/{languageSetting}', [App\Http\Controllers\Admin\LanguageSettingController::class, 'update'])->name('update');
            Route::delete('/delete/{languageSetting}', [App\Http\Controllers\Admin\LanguageSettingController::class, 'destroy'])->name('delete');
        });

        // general setting 
        Route::prefix('general')->name('general.')->group(function () {
            Route::get('/',[App\Http\Controllers\Admin\GeneralSettingController::class, 'index'])->name('view');
            Route::post('/store',[App\Http\Controllers\Admin\GeneralSettingController::class, 'store'])->name('store');

            // contact setting
            Route::prefix('contact')->name('contact.')->group(function () {
                Route::post('/store',[App\Http\Controllers\Admin\ContactSettingsController::class, 'store'])->name('store');
            });

            // Social Media Setting
            Route::prefix('social-media')->name('socialMedia.')->group(function () {
                Route::post('/store',[App\Http\Controllers\Admin\SocialMediaSettingsController::class, 'store'])->name('store');
            });

            // google recaptcha
            Route::prefix('googlerecaptcha')->name('GoogleReCAPTCHA.')->group(function () {
                Route::post('/store',[App\Http\Controllers\Admin\GoogleReCAPTCHAController::class, 'store'])->name('store');
            });

        });

        // application setting
        Route::prefix('application')->name('application.')->group(function () {
            Route::get('/',[App\Http\Controllers\Admin\ApplicationSettingController::class, 'index'])->name('view');
            Route::post('/store',[App\Http\Controllers\Admin\ApplicationSettingController::class, 'store'])->name('store');
            
            // maintenanceMode
            Route::prefix('maintenance-mode')->name('MaintenanceMode.')->group(function () {
                Route::post('/store',[App\Http\Controllers\Admin\MaintenanceModeController::class, 'store'])->name('store');
            });
        });
                
        // Facebook Comments Plugin Code
    //     Route::post('/Facebook-Comments-Plugin-Code',[App\Http\Controllers\Admin\FacebookCommentsSettingsController::class, 'store'])->name('store.facebook.cps');
        //custom css
    //     Route::post('/custom-css',[App\Http\Controllers\Admin\CustomCSSSettingsController::class, 'store'])->name('store.custom.css');
       // custom javascript
    //     Route::post('/custom-JavaScript',[App\Http\Controllers\Admin\CustomJsCodesController::class, 'store'])->name('store.custom.js');
    
    });

    Route::post('/logout', [App\Http\Controllers\Auth\Admin\AdminLoginController::class, 'destroy'])->name('logout');
});