<?php

namespace App\Http\Controllers\Admin;

use App\Models\GalleryImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GalleryAlbum;
use App\Models\GalleryCategory;
use Illuminate\Support\Facades\Storage;

class GalleryImageController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(GalleryImage::class, 'galleryImage');
    }

    public function index()
    {
        $galleryImages = GalleryImage::with(['category.album'])->get();
        return view('admin_dashboard.gallery.image.index', compact(['galleryImages']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $galleryAlbums = GalleryAlbum::with(['category'])->get();
        return view('admin_dashboard.gallery.image.create', compact(['galleryAlbums']));
    }

    public function getCategory(Request $request)
    {
        $galleryCategory = GalleryCategory::where('gallery_album_id', $request->albumId)->get();
        $category = '';
        foreach ($galleryCategory as $list) {
            $category .= '<option value="'.$list->id.'">'.ucwords($list->name).'</option>';
        }
        return $category;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'album_id' => 'required',
            'album_id' => 'required',
            'category_id' => 'required',
            'images.*' => 'required',
        ]);

        if ($request->hasFile('images')) {
            // return $request->file('images'); die;
            foreach ($request->images as $image) {
                $imageName = str_shuffle('abcdefhoieo87878') . '.' . $image->getClientOriginalExtension();
                $image->storeAs('media/images/image_gallery', $imageName, 'public');
                GalleryImage::create([
                    'image' => $imageName,
                    'description' => trim(strtolower($request->input('description'))),
                    'gallery_album_id' => $request->input('album_id'),
                    'gallery_category_id' => $request->input('category_id'),
                ]);
            }
            return redirect()->route('admin.gallery.image.view')->with('success', 'Gallery Image successfully created');
        }
        return redirect()->route('admin.gallery.image.view')->with('error', 'Gallery Image not created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GalleryImage  $galleryImage
     * @return \Illuminate\Http\Response
     */
    public function show(GalleryImage $galleryImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GalleryImage  $galleryImage
     * @return \Illuminate\Http\Response
     */
    public function edit(GalleryImage $galleryImage)
    {
        $galleryAlbums = GalleryAlbum::with(['category'])->get();
        return view('admin_dashboard.gallery.image.edit', compact(['galleryImage', 'galleryAlbums']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GalleryImage  $galleryImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GalleryImage $galleryImage)
    {
        $request->validate([
            'album_id' => 'required',
            'album_id' => 'required',
            'category_id' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $imageName = str_shuffle('abcdefhoieo87878') . '.' . $request->image->getClientOriginalExtension();
            Storage::delete(['public/media/images/image_gallery/' . $galleryImage->image]);
            $request->image->storeAs('media/images/image_gallery/', $imageName, 'public');

            $galleryImage->image = $imageName;
            $galleryImage->description = $request->input('description');
            $galleryImage->gallery_album_id = $request->input('album_id');
            $galleryImage->gallery_category_id = $request->input('category_id');

            return redirect()->route('admin.gallery.image.view')->with('success', 'Gallery Image successfully updated');
        } else {
            $galleryImage->image = $galleryImage->image;
            $galleryImage->description = $request->input('description');
            $galleryImage->gallery_album_id = $request->input('album_id');
            $galleryImage->gallery_category_id = $request->input('category_id');

            return redirect()->route('admin.gallery.image.view')->with('success', 'Gallery Image successfully updated');
        }
        return redirect()->route('admin.gallery.image.view')->with('error', 'Gallery Image not updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GalleryImage  $galleryImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(GalleryImage $galleryImage)
    {
        $deleted = $galleryImage->delete();
        if ($deleted) {
            Storage::delete(['public/media/images/image_gallery/' . $galleryImage->image]);
            return redirect()->route('admin.gallery.image.view')->with('success', 'Gallery Image successfully deleted');
        } else {
            return redirect()->route('admin.gallery.image.view')->with('error', 'Gallery Image not deleted');
        }
        
    }
}
