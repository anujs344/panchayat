<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PostImageGallery;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PostImageGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postImageGallery = PostImageGallery::latest()->get();
        $url = asset('storage/media/images/post_image_gallery');
        $img = '';
        foreach ($postImageGallery as $value) {
            $img .= '<div class="col-file-manager" id="img_col_id_'.$value->id.'">
                        <div class="file-box" data-file-id="'.$value->id.'" data-mid-file-path="'.$url."/".$value->image.'" data-default-file-path="'.$url."/".$value->image.'" data-slider-file-path="'.$url."/".$value->image.'" data-big-file-path="'.$url."/".$value->image.'">
                            <div class="image-container">
                                <img src="'.$url."/".$value->image.'" alt="" class="w-100">
                            </div>
                            <span class="file-name">'.$value->image.'</span>
                        </div>
                    </div>';
        }
        return $img;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = $request->file('file');
        // return $image->name; die;
        $img = date('Y-m-d'). '-at-' . date('H-i-s') .'.'.$image->extension();
        PostImageGallery::create([
            'image' => $img,
        ]);
        $image->storeAs('media/images/post_image_gallery', $img, 'public');
        return response()->json(['success'=>$img]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PostImageGallery  $postImageGallery
     * @return \Illuminate\Http\Response
     */
    public function show(PostImageGallery $postImageGallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostImageGallery  $postImageGallery
     * @return \Illuminate\Http\Response
     */
    public function edit(PostImageGallery $postImageGallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostImageGallery  $postImageGallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostImageGallery $postImageGallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostImageGallery  $postImageGallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostImageGallery $postImageGallery)
    {
        if(Storage::exists('/public/media/images/post_image_gallery/'.$postImageGallery->image)){
            Storage::delete(['public/media/images/post_image_gallery/' . $postImageGallery->image]);
        }
        $postImageGallery->delete();
    }
}
