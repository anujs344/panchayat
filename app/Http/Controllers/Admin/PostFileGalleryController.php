<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PostFileGallery;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PostFileGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postFileGallery = PostFileGallery::latest()->get();
        $url = asset('storage/media/files/post_file_gallery');
        $file = '';
        foreach ($postFileGallery as $value) {
            $file .= '<div class="col-file-manager" id="file_col_id_'.$value->id.'">
                        <div class="file-box" data-file-id="'.$value->id.'">
                            
                            <span class="file-name" data-file-name="'.$value->file.'">'.$value->file.'</span>
                        </div>
                    </div>';
        }
        return $file;
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
        $files = $request->file('file');
        // return $image->name; die;
        $file = date('Y-m-d'). '-at-' . date('H-i-s') .'.'.$files->extension();
        PostFileGallery::create([
            'file' => $file,
        ]);
        $files->storeAs('media/files/post_file_gallery', $file, 'public');
        return response()->json(['success'=>$file]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PostFileGallery  $postFileGallery
     * @return \Illuminate\Http\Response
     */
    public function show(PostFileGallery $postFileGallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostFileGallery  $postFileGallery
     * @return \Illuminate\Http\Response
     */
    public function edit(PostFileGallery $postFileGallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostFileGallery  $postFileGallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostFileGallery $postFileGallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostFileGallery  $postFileGallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostFileGallery $postFileGallery)
    {
        if(Storage::exists('/public/media/files/post_file_gallery/'.$postFileGallery->file)){
            Storage::delete(['public/media/files/post_file_gallery/' . $postFileGallery->file]);
        }
        $postFileGallery->delete();
    }
}
