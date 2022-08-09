<?php

namespace App\Http\Controllers\Admin;

use App\Models\GalleryAlbum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GalleryAlbumController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(GalleryAlbum::class, 'galleryAlbum');
    }
    public function index()
    {
        $galleryAlbums = GalleryAlbum::all();
        return view('admin_dashboard.gallery.album.index', compact('galleryAlbums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_dashboard.gallery.album.create');
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
        ]);

        $save = GalleryAlbum::create([
            'name' => trim(strtolower($request->input('name'))),
        ]);

        if ($save) {
            return redirect()->route('admin.gallery.album.view')->with('success', 'Album successfully created');
        } else {
            return redirect()->route('admin.gallery.album.view')->with('error', 'Album not created');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GalleryAlbum  $galleryAlbum
     * @return \Illuminate\Http\Response
     */
    public function show(GalleryAlbum $galleryAlbum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GalleryAlbum  $galleryAlbum
     * @return \Illuminate\Http\Response
     */
    public function edit(GalleryAlbum $galleryAlbum)
    {
        return view('admin_dashboard.gallery.album.edit', compact('galleryAlbum'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GalleryAlbum  $galleryAlbum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GalleryAlbum $galleryAlbum)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $galleryAlbum->name = trim(strtolower($request->input('name')));

        if ($galleryAlbum->save()) {
            return redirect()->route('admin.gallery.album.view')->with('success', 'Album successfully updated');
        } else {
            return redirect()->route('admin.gallery.album.view')->with('error', 'Album not updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GalleryAlbum  $galleryAlbum
     * @return \Illuminate\Http\Response
     */
    public function destroy(GalleryAlbum $galleryAlbum)
    {
        $delete = $galleryAlbum->delete();
        if ($delete) {
            $galleryAlbum->category()->images()->delete();
            $galleryAlbum->category()->delete();
            return redirect()->route('admin.gallery.album.view')->with('success', 'Album successfully deleted');
        } else {
            return redirect()->route('admin.gallery.album.view')->with('error', 'Album not deleted');
        }
    }
}
