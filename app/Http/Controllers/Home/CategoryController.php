<?php
namespace App\Http\Controllers\Home;

use App\Models\Post;
use App\Models\Category;
use App\Models\Navigation;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function categories($slug){

        $category = Category::where(['slug'=>$slug])->first();
        if (Auth::check()) {
            $posts = Post::where(['category_id'=>$category->id, 'visibility'=>1, 'status'=>1])->latest()->paginate(10);
        }else {
            $posts = Post::where(['category_id'=>$category->id, 'visibility'=>1, 'status'=>1])->where('show_auth_user', '!=', 1)->latest()->paginate(10);
        }
        // dd(1);
        $meta['ogtype'] = 'category';
        $meta['ogdescription'] = ucwords($category->description);
        $meta['keywords'] = ucwords($category->keywords);

        return view('homepage.category',compact(['category','posts', 'meta']));
    }

    public function subcategories($slug){

        $subcategory = Subcategory::where(['slug'=>$slug])->first();
        if (Auth::check()) {
            $posts = Post::where(['subcategory_id'=>$subcategory->id, 'visibility'=>1, 'status'=>1])->latest()->paginate(10);
        }else {
            $posts = Post::where(['subcategory_id'=>$subcategory->id, 'visibility'=>1, 'status'=>1])->where('show_auth_user', '!=', 1)->latest()->paginate(10);
        }

        $meta['ogtype'] = 'category';
        $meta['ogdescription'] = ucwords($subcategory->description);
        $meta['keywords'] = ucwords($subcategory->keywords);

        return view('homepage.subcategory',compact(['subcategory','posts','meta']));
    }
}
