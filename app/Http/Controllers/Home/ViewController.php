<?php
namespace App\Http\Controllers\Home;

use App\Models\Post;
use App\Models\User;

use App\Models\Comment;
use App\Models\SeoTool;
use Jorenvh\Share\Share;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ViewController extends Controller
{
    
    public function show($type, $slug)
    {
        $post = Post::with(['mainImage'])->whereSlug($slug)->where(['visibility'=>1, 'status'=>1])->first();
        
        if (Auth::check()) {
            $relatedPosts = Post::where(['category_id'=>$post->category_id, 'visibility'=>1, 'status'=>1])->where('id', '!=', $post->id)->latest()->limit(5)->get();
        }else {
            $relatedPosts = Post::where(['category_id'=>$post->category_id, 'visibility'=>1, 'status'=>1])->where('show_auth_user', '!=', 1)->where('id', '!=', $post->id)->latest()->limit(5)->get();
        }
        
        

        $tags = explode(',',$post->tags);
        
        // social links
       

        
        $meta['ogurl'] = urlencode(route('post.view', [$post->post_type, $post->slug]));
        $meta['ogtitle'] = ucwords($post->title);
        $meta['ogtype'] = $post->post_type;
        $meta['ogdescription'] = ucwords($post->description);
        $meta['ogimage'] = $post->post_image_gallery_id ? asset('storage/media/images/post_image_gallery/'.$post->mainImage->image) : $post->opt_image_url;
        $meta['keywords'] = ucwords($post->keywords);
        
        if ($type == 'article') {
            
            return view('homepage.view', compact(['post', 'tags','relatedPosts', 'meta']));

        }
        if ($type == 'video') {
            return view('homepage.video.view', compact(['post', 'tags','relatedPosts', 'meta']));
        }
    }

    public function tag($tag)
    {
        if (Auth::check()) {
            $data['posts'] = Post::where('tags','like',"%{$tag}%")->where(['visibility'=>1, 'status'=>1])->latest()->paginate(10);
        }else {
            $data['posts'] = Post::where('tags','like',"%{$tag}%")->where(['visibility'=>1, 'status'=>1])->where('show_auth_user', '!=', 1)->latest()->paginate(10);
        }
        
        $data['type'] = $tag;

        $seo = SeoTool::find(1);
        $meta['ogtitle'] = ucwords($seo->home_title ?? '');
        $meta['ogdescription'] = ucwords($seo->description ?? '');
        $meta['keywords'] = ucwords($seo->keywords ?? '');
        $meta['ogtype'] = 'tag';

        return view('homepage.post-type', $data, compact('meta'));
    }

    public function author($user)
    {
        if (Auth::check()) {
            $data['posts'] = Post::where(['author'=>$user, 'visibility'=>1, 'status'=>1])->latest()->paginate(10);
        }else {
            $data['posts'] = Post::where(['author'=>$user, 'visibility'=>1, 'status'=>1])->where('show_auth_user', '!=', 1)->latest()->paginate(10);
        }
        
        $data['type'] = $user;

        $seo = SeoTool::find(1);
        $meta['ogtitle'] = ucwords($seo->home_title ?? '');
        $meta['ogdescription'] = ucwords($seo->description ?? '');
        $meta['keywords'] = ucwords($seo->keywords ?? '');
        $meta['ogtype'] = 'tag';

        return view('homepage.post-type', $data, compact('meta'));
    }

    public function video()
    {
        if (Auth::check()) {
            $data['posts'] = Post::where(['visibility'=>1, 'status'=>1, 'post_type'=>'video'])->latest()->paginate(10);
        }else {
            $data['posts'] = Post::where(['visibility'=>1, 'status'=>1, 'post_type'=>'video'])->where('show_auth_user', '!=', 1)->latest()->paginate(10);
        }

        $data['type'] = 'videos';

        $seo = SeoTool::find(1);
        $meta['ogtitle'] = ucwords($seo->home_title ?? '');
        $meta['ogdescription'] = ucwords($seo->description ?? '');
        $meta['keywords'] = ucwords($seo->keywords ?? '');
        $meta['ogtype'] = 'videos';

        return view('homepage.post-type', $data, compact('meta'));
    }

    public function article()
    {
        if (Auth::check()) {
            $data['posts'] = Post::where(['visibility'=>1, 'status'=>1, 'post_type'=>'article'])->latest()->paginate(10);
        }else {
            $data['posts'] = Post::where(['visibility'=>1, 'status'=>1, 'post_type'=>'article'])->where('show_auth_user', '!=', 1)->latest()->paginate(10);
        }
        
        $data['type'] = 'articles';

        $seo = SeoTool::find(1);
        $meta['ogtitle'] = ucwords($seo->home_title ?? '');
        $meta['ogdescription'] = ucwords($seo->description ?? '');
        $meta['keywords'] = ucwords($seo->keywords ?? '');
        $meta['ogtype'] = 'articles';

        return view('homepage.post-type', $data, compact('meta'));
    }

    public function fromLocationPost($location)
    {
        if (Auth::check()) {
            $data['posts'] = Post::where(['visibility'=>1, 'status'=>1, 'location'=>$location])->latest()->paginate(10);
        }else {
            $data['posts'] = Post::where(['visibility'=>1, 'status'=>1, 'location'=>$location])->where('show_auth_user', '!=', 1)->latest()->paginate(10);
        }
        
        $data['type'] = $location;

        $seo = SeoTool::find(1);
        $meta['ogtitle'] = ucwords($seo->home_title ?? '');
        $meta['ogdescription'] = ucwords($seo->description ?? '');
        $meta['keywords'] = ucwords($seo->keywords ?? '');
        $meta['ogtype'] = 'articles';

        return view('homepage.post-type', $data, compact('meta'));
    }

    public function store(Request $request, Post $post)
    {
        $request->validate([
            'comment' => 'required',
        ]);
        if (Auth::check()) {
            $save = Comment::create([
                'user_id' => Auth::user()->id,
                'comment' => strtolower($request->input('comment')),
                'post_id' => $post->id,
            ]);
            if ($save) {
                return back()->withSuccess('Comment successfully posted');
            } else {
                return back()->withError('Comment not posted');
            }
        } else {
            return redirect()->route('login');
        }
    }
}
