<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PostAudioGallery;
use App\Http\Controllers\Controller;
use App\Models\Post;

class PostAudioGalleryController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post');
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(PostAudioGallery $postAudioGallery)
    {
        //
    }

    public function edit(PostAudioGallery $postAudioGallery)
    {
        //
    }

    public function update(Request $request, PostAudioGallery $postAudioGallery)
    {
        //
    }

    public function destroy(PostAudioGallery $postAudioGallery)
    {
        //
    }
}
