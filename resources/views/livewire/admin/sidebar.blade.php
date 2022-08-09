<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ isset($visualSetting) ? asset('storage/media/images/logo/' . $visualSetting->logo) : '' }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">{{ config('app.name', '') }}</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>

    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li class="menu-label">MAIN NAVIGATION</li>
        {{-- Dashboard --}}
        <li>
            <a href="{{route('admin.dashboard')}}">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        {{-- Navigation --}}
        @can('viewAny', App\Models\Navigation::class)
        <li>
            <a href="{{route('admin.navigation.view')}}">
                <div class="parent-icon"><i class='bx bx-grid-alt'></i>
                </div>
                <div class="menu-title">Navigation</div>
            </a>
        </li>
        @endcan
        {{-- Pages --}}
        {{-- <li>
            <a href="javascript:void(0);" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-file'></i>
                </div>
                <div class="menu-title">Pages</div>
            </a>
            <ul>
                <li> <a href="ecommerce-products.html"><i class="bx bx-right-arrow-alt"></i>Add Page</a>
                </li>
                <li> <a href="ecommerce-products-details.html"><i class="bx bx-right-arrow-alt"></i>Pages</a>
                </li>
            </ul>
        </li> --}}
        {{-- Categories --}}
        @if (in_array('categories', $permissions) || in_array('subcategories', $permissions) || request()->user()->role->name == 'admin')
        <li>
            <a href="javascript:void(0);" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-folder-open'></i>
                </div>
                <div class="menu-title">Categories</div>
            </a>
            <ul>
                @can('viewAny', App\Models\Category::class)
                <li>
                    <a href="{{ route('admin.category.view') }}">
                        <div class=""><i class="bx bx-right-arrow-alt"></i></div>
                        <div class="">Categories</div>
                    </a>
                </li>
                @endcan
                @can('viewAny', App\Models\Subcategory::class)
                <li>
                    <a href="{{ route('admin.subcategory.view') }}">
                        <i class="bx bx-right-arrow-alt"></i>
                        Subcategories
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endif
        {{-- Add Post --}}
        @if (in_array('add_post', $permissions) || request()->user()->role->name == 'admin')
        <li>
            <a href="{{route('admin.post.format')}}">
                <div class="parent-icon"><i class='bx bx-file-blank'></i>
                </div>
                <div class="menu-title">Add Post</div>
            </a>
        </li>
        @endif
        {{-- Bulk Posts --}}
        @if (in_array('bulkpostupload', $permissions) || request()->user()->role->name == 'admin')
        <li>
            <a href="{{route('admin.post.bulkPost')}}">
                <div class="parent-icon"><i class='bx bx-cloud-upload'></i>
                </div>
                <div class="menu-title">Bulk Post Upload</div>
            </a>
        </li>
        @endif
        {{-- Posts --}}
        @can('viewAny', App\Models\Post::class)
        <li>
            <a href="javascript:void(0);" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-menu'></i>
                </div>
                <div class="menu-title">Posts</div>
            </a>
            <ul>
                @can('viewAny', App\Models\Post::class)
                <li>
                    <a href="{{route('admin.post.view')}}"><i class="bx bx-right-arrow-alt"></i>Posts</a>
                </li>
                @endcan
                @if (in_array('posts', $permissions) || request()->user()->role->name == 'admin')
                <li>
                    <a href="{{route('admin.sliderPost')}}"><i class="bx bx-right-arrow-alt"></i>Slider Posts</a>
                </li>
                @endif
                @if (in_array('posts', $permissions) || request()->user()->role->name == 'admin')
                <li>
                    <a href="{{route('admin.featuredPost')}}"><i class="bx bx-right-arrow-alt"></i>Featured Posts</a>
                </li>
                @endif
                @if (in_array('posts', $permissions) || request()->user()->role->name == 'admin')
                <li>
                    <a href="{{route('admin.breakingPost')}}"><i class="bx bx-right-arrow-alt"></i>Breaking Posts</a>
                </li>
                @endif
                @if (in_array('posts', $permissions) || request()->user()->role->name == 'admin')
                <li>
                    <a href="{{route('admin.recommendedPost')}}"><i class="bx bx-right-arrow-alt"></i>Recommended Posts</a>
                </li>
                @endif
                @if (in_array('posts', $permissions) || request()->user()->role->name == 'admin')
                <li>
                    <a href="{{route('admin.pendingPost')}}"><i class="bx bx-right-arrow-alt"></i>Inactive Posts</a>
                </li>
                @endif
                @if (in_array('posts', $permissions) || request()->user()->role->name == 'admin')
                <li>
                    <a href="{{route('admin.scheduledPost')}}"><i class="bx bx-right-arrow-alt"></i>Scheduled Posts</a>
                </li>
                @endif
                @if (in_array('posts', $permissions) || request()->user()->role->name == 'admin')
                <li>
                    <a href="{{route('admin.draftPost')}}"><i class="bx bx-right-arrow-alt"></i>Drafts Posts</a>
                </li>
                @endif
            </ul>
        </li>
        @endcan
        {{-- Widget --}}
        @if (in_array('widget', $permissions) || request()->user()->role->name == 'admin')
        {{-- <li>
            <a href="javascript:void(0);" class="has-arrow">
                <div class="parent-icon"><i class='bx bxs-grid'></i>
                </div>
                <div class="menu-title">Widget</div>
            </a>
            <ul>
                @can('create', App\Models\Widget::class)
                <li> <a href="{{route('admin.widget.create')}}"><i class="bx bx-right-arrow-alt"></i>Add Widget</a>
                </li>
                @endcan
                @can('viewAny', App\Models\Widget::class)
                <li> <a href="{{route('admin.widget.view')}}"><i class="bx bx-right-arrow-alt"></i>Widgets</a>
                </li>
                @endcan
            </ul>
        </li> --}}
        @endif
        {{-- Gallery --}}
        @if (in_array('gallery', $permissions) || request()->user()->role->name == 'admin')
        {{-- <li>
            <a href="javascript:void(0);" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-image' ></i>
                </div>
                <div class="menu-title">Gallery</div>
            </a>
            <ul>
                <li> <a href="{{route('admin.gallery.album.view')}}"><i class="bx bx-right-arrow-alt"></i>Album</a>
                </li>
                <li> <a href="{{route('admin.gallery.category.view')}}"><i class="bx bx-right-arrow-alt"></i>Category</a>
                </li>
                <li> <a href="{{route('admin.gallery.image.view')}}"><i class="bx bx-right-arrow-alt"></i>Images</a>
                </li>
            </ul>
        </li> --}}
        @endif
        {{-- Contact Messages --}}
        @if (in_array('contact_messages', $permissions) || request()->user()->role->name == 'admin')
        <li>
            <a href="{{route('admin.contactMessage.view')}}">
                <div class="parent-icon"><i class='bx bxl-telegram'></i>
                </div>
                <div class="menu-title">Contact Messages</div>
            </a>
        </li>
        @endif
        {{-- Comments --}}
        @if (in_array('comments', $permissions) || request()->user()->role->name == 'admin')
        <li>
            <a href="javascript:void(0);" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-message-rounded-dots'></i>
                </div>
                <div class="menu-title">Comments</div>
            </a>
            <ul>
                <li> <a href="{{route('admin.comment.pending')}}"><i class="bx bx-right-arrow-alt"></i>Pending Comments</a>
                </li>
                <li> <a href="{{route('admin.comment.approved')}}"><i class="bx bx-right-arrow-alt"></i>Approved Comments</a>
                </li>
            </ul>
        </li>
        @endif
        {{-- Newsletter --}}
        @if (in_array('newsletter', $permissions) || request()->user()->role->name == 'admin')
        <li>
            <a href="javascript:void(0);" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-envelope'></i>
                </div>
                <div class="menu-title">Newsletter</div>
            </a>
            <ul>
                <li> <a href="{{route('admin.newsletter.view')}}"><i class="bx bx-right-arrow-alt"></i>Newsletters</a>
                <li> <a href="{{route('admin.newsletter.subscriber.view')}}"><i class="bx bx-right-arrow-alt"></i>Subscribers</a>
                </li>
                </li>
            </ul>
        </li>
        @endif
        {{-- Roles & Permissions --}}
        @if (in_array('role_permissions', $permissions) || request()->user()->role->name == 'admin')
        <li>
            <a href="{{route('admin.role.view')}}">
                <div class="parent-icon"><i class='bx bx-key'></i>
                </div>
                <div class="menu-title">Roles & Permissions</div>
            </a>
        </li>
        @endif
        {{-- Users --}}
        @if (in_array('add_staff', $permissions) || in_array('administrator', $permissions) || in_array('staffs', $permissions) || in_array('users', $permissions) || request()->user()->role->name == 'admin')
        <li>
            <a href="javascript:void(0);" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-group'></i>
                </div>
                <div class="menu-title">Users</div>
            </a>
            <ul>
                @if (in_array('add_staff', $permissions) || request()->user()->role->name == 'admin')
                <li> <a href="{{route('admin.staff.create')}}"><i class="bx bx-right-arrow-alt"></i>Add Staff</a>
                </li>
                @endif
                @if (in_array('administrator', $permissions) || request()->user()->role->name == 'admin')
                <li> <a href="{{route('admin.administrator.view')}}"><i class="bx bx-right-arrow-alt"></i>Administrator</a>
                </li>
                @endif
                @if (in_array('staffs', $permissions) || request()->user()->role->name == 'admin')
                <li> <a href="{{route('admin.staff.view')}}"><i class="bx bx-right-arrow-alt"></i>Staffs</a>
                </li>
                @endif
                @if (in_array('users', $permissions) || request()->user()->role->name == 'admin')
                <li> <a href="{{route('admin.user.view')}}"><i class="bx bx-right-arrow-alt"></i>Users</a>
                </li>
                @endif
            </ul>
        </li>
        @endif
        @if (array_intersect(['seo_tools','social_login_conf','email_settings','visual_settings','general_settings','application_settings'], $permissions) || request()->user()->role->name == 'admin')
        <li class="menu-label">SETTINGS</li>
        @endif
        {{-- SEO Tools --}}
        @if (in_array('seo_tools', $permissions) || request()->user()->role->name == 'admin')
        <li>
            <a href="{{route('admin.settings.seo.view')}}">
                <div class="parent-icon"><i class='bx bx-wrench'></i>
                </div>
                <div class="menu-title">SEO Tools</div>
            </a>
        </li>
        @endif
        {{-- Social Login Configuration --}}
        @if (in_array('social_login_conf', $permissions) || request()->user()->role->name == 'admin')
        <li>
            <a href="{{route('admin.settings.socialLogin.view')}}">
                <div class="parent-icon"><i class='bx bx-share-alt'></i>
                </div>
                <div class="menu-title">Social Login Configuration</div>
            </a>
        </li>
        @endif
        {{-- Cache System --}}
        {{-- <li>
            <a href="#">
                <div class="parent-icon"><i class='bx bx-data'></i>
                </div>
                <div class="menu-title">Cache System</div>
            </a>
        </li> --}}
        {{-- Preferences --}}
        {{-- <li>
            <a href="#">
                <div class="parent-icon"><i class='bx bx-check-square'></i>
                </div>
                <div class="menu-title">Preferences</div>
            </a>
        </li> --}}
        {{-- Route Settings --}}
        {{-- <li>
            <a href="">
                <div class="parent-icon"><i class='bx bxs-traffic-barrier'></i>
                </div>
                <div class="menu-title">Route Settings</div>
            </a>
        </li> --}}
        {{-- Email Settings --}}
        @if (in_array('email_settings', $permissions) || request()->user()->role->name == 'admin')
        <li>
            <a href="{{route('admin.settings.email.view')}}">
                <div class="parent-icon"><i class='bx bx-cog' ></i>
                </div>
                <div class="menu-title">Email Settings</div>
            </a>
        </li>
        @endif
        {{-- Visual Settings --}}
        @if (in_array('visual_settings', $permissions) || request()->user()->role->name == 'admin')
        <li>
            <a href="{{route('admin.settings.visual.view')}}">
                <div class="parent-icon"><i class='bx bx-paint' ></i>
                </div>
                <div class="menu-title">Visual Settings</div>
            </a>
        </li>
        @endif
        {{-- Font Settings --}}
        {{-- <li>
            <a href="{{route('admin.settings.font.view')}}">
                <div class="parent-icon"><i class='bx bx-font' ></i>
                </div>
                <div class="menu-title">Font Settings</div>
            </a>
        </li> --}}
        {{-- Languages Settings --}}
        {{-- <li>
            <a href="{{route('admin.settings.language.view')}}">
                <div class="parent-icon"><i class='bx bx-font-family' ></i>
                </div>
                <div class="menu-title">Languages Settings</div>
            </a>
        </li> --}}
        {{-- General Settings --}}
        @if (in_array('general_settings', $permissions) || request()->user()->role->name == 'admin')
        <li>
            <a href="{{route('admin.settings.general.view')}}">
                <div class="parent-icon"><i class='bx bx-cog' ></i>
                </div>
                <div class="menu-title">General Settings</div>
            </a>
        </li>
        @endif
        {{-- Application Setting --}}
        @if (in_array('application_settings', $permissions) || request()->user()->role->name == 'admin')
        <li>
            <a href="{{route('admin.settings.application.view')}}">
                <div class="parent-icon"><i class='bx bx-layer' ></i>
                </div>
                <div class="menu-title">Application Settings</div>
            </a>
        </li>
        @endif
    </ul>
    <!--end navigation-->
</div>
