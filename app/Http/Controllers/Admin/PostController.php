<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\PostFile;
use App\Models\PostImage;
use App\Models\Subcategory;
use App\Imports\PostsImport;
use Illuminate\Http\Request;
use App\Exports\PostExampleExport;
use App\Exports\PostTemplateExport;
use App\Http\Controllers\Controller;
use App\Mail\PostToRegisteredUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class PostController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post');
    }

    public function index()
    {
        $posts = Post::with(['category', 'subcategory', 'mainImage'])->where(['visibility'=>1, 'status'=>1])->latest()->get();
        return view('admin_dashboard.post.views.index', compact('posts'));
    }

    public function postFormat()
    {
        $permissions = request()->user()->role->permissions->pluck('name')->toArray();

        if (in_array('add_post', $permissions) || request()->user()->role->name == 'admin') {
            return view('admin_dashboard.post.post-format');
        } else {
            abort(403, 'you are unauthorized for this service');
        }
    }

    public function create(Request $request)
    {
        $categories = Category::all();
        if ($request->type == 'article') {
            return view('admin_dashboard.post.article.create', compact('categories'));
        }
        if ($request->type == 'video') {
            return view('admin_dashboard.post.video.create', compact('categories'));
        }
        if ($request->type == 'audio') {
            return view('admin_dashboard.post.audio.create', compact('categories'));
        }
        
    }

    public function getSubcategory(Request $request)
    {
        $category = $request->parent_id;
        $subcategory = Subcategory::where('category_id', $category)->get();
        $option = '';
        foreach ($subcategory as $list) {
            $option .= '<option value="'.$list->id.'">'.ucwords($list->name).'</option>';
        }
        return $option;
    }

    public function get_video_from_url(Request $request)
    {
        $url = $request->url;
        $embed_url = str_replace('watch?v=', 'embed/', $url);
        $value = explode('v=', $url);
        $video_id = 'http://img.youtube.com/vi/' . $value[1] . '/hqdefault.jpg';
        return response()->json(['video_embed_code'=>$embed_url, 'video_thumbnail'=>$video_id]);
    }

    public function store(Request $request)
    {
        $postImg = $request->input('additional_post_image_id');
        $postfiles = $request->input('post_selected_file_id');

        if (isset($request->scheduled_post)) {
            $scheduled = $request->input('date_published');
        } else {
            $scheduled = null;
        }

        $request->validate([
            'title' => 'required',
            'slug' => 'unique:posts,slug,',
            'author' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'location' => 'required',
        ],[],[
            'category_id' => 'category',
        ]);

        $save = Post::create([
            'post_type' => strtolower($request->input('post_type')),
            'title' => strtolower($request->input('title')),
            'subtitle' => strtolower($request->input('subtitle')),
            'slug' => strtolower($request->input('slug')),
            'author' => strtolower($request->input('author')),
            'description' => strtolower($request->input('description')),
            'keywords' => strtolower($request->input('keywords')),
            'visibility' => $request->input('visibility'),
            'show_right_column' => $request->input('show_right_column') ?? 0,
            'featured' => $request->input('is_featured') ?? 0,
            'breaking' => $request->input('is_breaking') ?? 0,
            'slider' => $request->input('is_slider') ?? 0,
            'recommended' => $request->input('is_recommended') ?? 0,
            'show_auth_user' => $request->input('show_auth') ?? 0,
            'send_subscriber' => $request->input('send_to_subscriber') ?? 0,
            'tags' => trim(strtolower($request->input('tags'))),
            'opt_url' => $request->input('opt_url'),
            'content' => trim(strtolower($request->input('content'))),
            'post_image_gallery_id' => $request->input('post_image_id'),
            'opt_image_url' => $request->input('opt_main_image_url'),
            'video_embed_url' => $request->input('video_embed_url'),
            'category_id' => $request->input('category_id'),
            'subcategory_id' => $request->input('subcategory_id'),
            'location' => trim(strtolower($request->input('location'))),
            'admin_id' => Auth::user()->id,
            'status' => $request->input('status'),
            'scheduled_post_date' => $scheduled,
        ]);

        if ($save) {
            // Post Images
            if ($request->post_type == 'article') {
                if (isset($postImg)) {
                    foreach ($postImg as $val) {
                        PostImage::create([
                            'post_id' => $save->id,
                            'post_image_gallery_id' => $val,
                        ]);
                    }
                }
            }
            // Post Files
            if ($request->post_type == 'article' || $request->post_type == 'video') {
                if (isset($postfiles)) {
                    foreach ($postfiles as $file) {
                        PostFile::create([
                            'post_id' => $save->id,
                            'post_file_gallery_id' => $file,
                        ]);
                    }
                }
            }
            // send mail
            $users = User::all();
            if (isset($request->send_to_subscriber)) {
                foreach ($users as $user) {
                    Mail::to($user->email)->send(new PostToRegisteredUser($save));
                }
            }
            return redirect()->route('admin.post.view')->with('success', 'Post successfully created');
            
        } else {
            return redirect()->route('admin.post.view')->with('error', 'Post not created');
        }
    }

    public function show(Post $post)
    {
        //
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $post->load(['category:id,name']);
        if (isset($post->post_image_gallery_id)) {
            $post->load(['mainImage:id,image']);
        }

        if ($post->post_type == 'article') {
            return view('admin_dashboard.post.article.edit', compact('post', 'categories', 'subcategories'));
        }
        if ($post->post_type == 'video') {
            return view('admin_dashboard.post.video.edit', compact('post', 'categories', 'subcategories'));
        }
        
    }

    public function update(Request $request, Post $post)
    {
        $postImg = $request->input('additional_post_image_id');
        $postfiles = $request->input('post_selected_file_id');
        
        $request->validate([
            'title' => 'required',
            'slug' => 'unique:posts,slug,'. $post->id,
            'author' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'location' => 'required',
        ],[],[
            'category_id' => 'category',
        ]);

        $post->post_type = strtolower($request->input('post_type'));
        $post->title = strtolower($request->input('title'));
        $post->subtitle = strtolower($request->input('subtitle'));
        $post->slug = strtolower($request->input('slug'));
        $post->author = strtolower($request->input('author'));
        $post->description = strtolower($request->input('description'));
        $post->keywords = strtolower($request->input('keywords'));
        $post->visibility = $request->input('visibility');
        $post->show_right_column = $request->input('show_right_column') ?? 0;
        $post->featured = $request->input('is_featured') ?? 0;
        $post->breaking = $request->input('is_breaking') ?? 0;
        $post->slider = $request->input('is_slider') ?? 0;
        $post->recommended = $request->input('is_recommended') ?? 0;
        $post->show_auth_user = $request->input('show_auth') ?? 0;
        $post->send_subscriber = $request->input('send_to_subscriber') ?? 0;
        $post->tags = trim(strtolower($request->input('tags')));
        $post->opt_url = $request->input('opt_url');
        $post->content = $request->input('content');
        $post->post_image_gallery_id = $request->input('post_image_id');
        $post->opt_image_url = $request->input('opt_main_image_url');
        $post->video_embed_url = $request->input('video_embed_url');
        $post->category_id = $request->input('category_id');
        $post->subcategory_id = $request->input('subcategory_id');
        $post->location = trim(strtolower($request->input('location')));
        $post->admin_id = Auth::user()->id;
        $post->status = $request->input('status');
        if (isset($request->scheduled_post)) {
            $post->scheduled_post_date = $request->input('date_published');
        } else {
            $post->scheduled_post_date = null;
        }

        if ($post->save()) {
            // Post Images
            if ($request->post_type == 'article') {
                if (isset($post->postSlider)) {
                    foreach ($post->postSlider as $list) {
                        $list->delete();
                    }
                }
                if (isset($postImg)) {
                    foreach ($postImg as $val) {
                        PostImage::create([
                            'post_id' => $post->id,
                            'post_image_gallery_id' => $val,
                        ]);
                    }
                }
            }

            // Post Files
            if ($request->post_type == 'article' || $request->post_type == 'video') {
                if (isset($post->postFile)) {
                    foreach ($post->postFile as $list) {
                        $list->delete();
                    }
                }
                if (isset($postfiles)) {
                    foreach ($postfiles as $file) {
                        PostFile::create([
                            'post_id' => $post->id,
                            'post_file_gallery_id' => $file,
                        ]);
                    }
                }
            }

            return redirect()->route('admin.post.view')->with('success', 'Post successfully updated');
            
        } else {
            return redirect()->route('admin.post.view')->with('error', 'Post not updated');
        }
    }

    public function destroy(Post $post)
    {
        $deleted = $post->delete();
        if ($deleted) {
            $post->postSlider()->delete();
            $post->postFile()->delete();
            $post->comments()->delete();
            return redirect()->route('admin.post.view')->with('success', 'Post successfully deleted');
        }
        return redirect()->route('admin.post.view')->with('error', 'Post not deleted');
    }

    public function deleteSelectedPosts(Request $request)
    {
        $permissions = request()->user()->role->permissions->pluck('name')->toArray();

        if (in_array('posts', $permissions) || request()->user()->role->name == 'admin') {
            $posts = Post::whereId($request->checkbox)->get();
            foreach ($posts as $post) {
                $post->delete();
                $post->postSlider()->delete();
                $post->postFile()->delete();
                $post->comments()->delete();
                return redirect()->route('admin.post.view')->with('success', 'Post successfully deleted');
            }
            return redirect()->route('admin.post.view')->with('error', 'Post not deleted');
        } else {
            abort(403, 'you are unauthorized for this service');
        }
    }

    public function sliderPost()
    {
        $permissions = request()->user()->role->permissions->pluck('name')->toArray();

        if (in_array('posts', $permissions) || request()->user()->role->name == 'admin') {
            $posts = Post::with(['category', 'subcategory', 'mainImage'])->where(['slider' => 1])->latest()->get();
            return view('admin_dashboard.post.views.slider-post', compact('posts'));
        } else {
            abort(403, 'you are unauthorized for this service');
        }
    }
    public function featuredPost()
    {
        $permissions = request()->user()->role->permissions->pluck('name')->toArray();

        if (in_array('posts', $permissions) || request()->user()->role->name == 'admin') {
            $posts = Post::with(['category', 'subcategory', 'mainImage'])->where(['featured' => 1])->latest()->get();
            return view('admin_dashboard.post.views.featured-post', compact('posts'));
        } else {
            abort(403, 'you are unauthorized for this service');
        }
    }
    public function breakingPost()
    {
        $permissions = request()->user()->role->permissions->pluck('name')->toArray();

        if (in_array('posts', $permissions) || request()->user()->role->name == 'admin') {
            $posts = Post::with(['category', 'subcategory', 'mainImage'])->where(['breaking' => 1])->latest()->get();
            return view('admin_dashboard.post.views.breaking-post', compact('posts'));
        } else {
            abort(403, 'you are unauthorized for this service');
        }
    }
    public function recommendedPost()
    {
        $permissions = request()->user()->role->permissions->pluck('name')->toArray();

        if (in_array('posts', $permissions) || request()->user()->role->name == 'admin') {
            $posts = Post::with(['category', 'subcategory', 'mainImage'])->where(['recommended' => 1])->latest()->get();
            return view('admin_dashboard.post.views.recommended-post', compact('posts'));
        } else {
            abort(403, 'you are unauthorized for this service');
        }
    }
    public function pendingPost()
    {
        $permissions = request()->user()->role->permissions->pluck('name')->toArray();

        if (in_array('posts', $permissions) || request()->user()->role->name == 'admin') {
            $posts = Post::with(['category', 'subcategory', 'mainImage'])->where(['visibility' => 0])->latest()->get();
            return view('admin_dashboard.post.views.pending-post', compact('posts'));
        } else {
            abort(403, 'you are unauthorized for this service');
        }
    }
    public function scheduledPost()
    {
        $permissions = request()->user()->role->permissions->pluck('name')->toArray();

        if (in_array('posts', $permissions) || request()->user()->role->name == 'admin') {
            $posts = Post::with(['category', 'subcategory', 'mainImage'])->where('scheduled_post_date', '!=', null)->latest()->get();
            return view('admin_dashboard.post.views.scheduled-post', compact('posts'));
        } else {
            abort(403, 'you are unauthorized for this service');
        }
    }
    public function draftPost()
    {
        $permissions = request()->user()->role->permissions->pluck('name')->toArray();

        if (in_array('posts', $permissions) || request()->user()->role->name == 'admin') {
            $posts = Post::with(['category', 'subcategory', 'mainImage'])->where(['status' => 0])->latest()->get();
            return view('admin_dashboard.post.views.draft-post', compact('posts'));
        } else {
            abort(403, 'you are unauthorized for this service');
        }
    }

    public function bulkPost()
    {
        $permissions = request()->user()->role->permissions->pluck('name')->toArray();

        if (in_array('bulkpostupload', $permissions) || request()->user()->role->name == 'admin') {
            $categories = Category::with(['child'])->get();
            return view('admin_dashboard.post/bulk-post', compact('categories'));
        } else {
            abort(403, 'you are unauthorized for this service');
        }
    }

    public function bulkPostUpload(Request $request)
    {
        $permissions = request()->user()->role->permissions->pluck('name')->toArray();

        if (in_array('bulkpostupload', $permissions) || request()->user()->role->name == 'admin') {
            $path = $request->file('file');
            $files = $_FILES['file'];
            $file = json_decode(json_encode($files));
            (new PostsImport)->import($path);
            return response()->json(['result'=>1,'title'=>$file->name]);
            
        } else {
            abort(403, 'you are unauthorized for this service');
        }
    }

    public function downloadTemplate()
    {
        $permissions = request()->user()->role->permissions->pluck('name')->toArray();

        if (in_array('bulkpostupload', $permissions) || request()->user()->role->name == 'admin') {
            return Excel::download(new PostTemplateExport, 'post_template.xlsx');
        } else {
            abort(403, 'you are unauthorized for this service');
        }
    }

    public function downloadExample()
    {
        $permissions = request()->user()->role->permissions->pluck('name')->toArray();

        if (in_array('bulkpostupload', $permissions) || request()->user()->role->name == 'admin') {
            return Excel::download(new PostExampleExport, 'post_example.xlsx');
        } else {
            abort(403, 'you are unauthorized for this service');
        }
    }
}
