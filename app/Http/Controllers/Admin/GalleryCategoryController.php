<?php

namespace App\Http\Controllers\Admin;

use App\Models\GalleryAlbum;
use Illuminate\Http\Request;
use App\Models\GalleryCategory;
use App\Http\Controllers\Controller;

class GalleryCategoryController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(GalleryCategory::class, 'galleryCategory');
    }

    public function index()
    {
        $galleryCategories = GalleryCategory::with(['album'])->get();
        return view('admin_dashboard.gallery.category.index', compact('galleryCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $galleryAlbums = GalleryAlbum::all();
        return view('admin_dashboard.gallery.category.create', compact('galleryAlbums'));
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
            'name' => 'required',
            'album_id' => 'required',
        ]);

        $save = GalleryCategory::create([
            'name' => trim(strtolower($request->input('name'))),
            'gallery_album_id' => trim(strtolower($request->input('album_id'))),
        ]);

        if ($save) {
            return redirect()->route('admin.gallery.category.view')->with('success', 'Category successfully created');
        } else {
            return redirect()->route('admin.gallery.category.view')->with('error', 'Category not created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GalleryCategory  $galleryCategory
     * @return \Illuminate\Http\Response
     */
    public function show(GalleryCategory $galleryCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GalleryCategory  $galleryCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(GalleryCategory $galleryCategory)
    {
        $galleryAlbums = GalleryAlbum::all();
        return view('admin_dashboard.gallery.category.edit', compact('galleryCategory', 'galleryAlbums'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GalleryCategory  $galleryCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GalleryCategory $galleryCategory)
    {
        $request->validate([
            'name' => 'required',
            'album_id' => 'required',
        ]);

        $galleryCategory->name = trim(strtolower($request->input('name')));
        $galleryCategory->gallery_album_id = trim(strtolower($request->input('album_id')));

        if ($galleryCategory->save()) {
            return redirect()->route('admin.gallery.category.view')->with('success', 'Category successfully updated');
        } else {
            return redirect()->route('admin.gallery.category.view')->with('error', 'Category not updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GalleryCategory  $galleryCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(GalleryCategory $galleryCategory)
    {
        $delete = $galleryCategory->delete();
        if ($delete) {
            $galleryCategory->images()->delete();
            return redirect()->route('admin.gallery.category.view')->with('success', 'Category successfully deleted');
        } else {
            return redirect()->route('admin.gallery.category.view')->with('error', 'Category not deleted');
        }
    }
}
