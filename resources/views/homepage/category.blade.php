@extends('layouts.guest')
@section('title', 'Category')

@section('content')

<section id="page-header" class="mb-5">
    <div class="header-poster">
        <img src="{{asset('assets_home\img\page-poster.jpg')}}" alt="">
        <div class="content">
           <div class="info">
            <h1 class="page-title">
                {{ucwords($category->name)}}
            </h1>
            {{-- <h4>Lorem ipsum dolor sit amet consectetur.</h4> --}}
           </div>
        </div>
    </div>
</section>

<section id="blog-card" class="overflow-hidden">
    <div class="container-fluid my-4">
        <div class="row">
        @forelse ($posts as $list)
        @if ($list->post_type == 'article')
        <div class="col-12 col-sm-6 mb-3">
            <div class="news-card">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="image">
                            <a href="{{route('post.view', [$list->post_type, $list->slug])}}">
                                <img src="{{$list->post_image_gallery_id ? $list->mainImage? asset('storage/media/images/post_image_gallery/'.$list->mainImage->image) : ('') : $list->opt_image_url}}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-2 mt-lg-0">
                        <div class="card-desc">
                            <a href="{{route('post.view', [$list->post_type, $list->slug])}}">
                                <h5 class="news-title">
                                    {{ucwords($list->title)}}
                                </h5>
                            </a>
                            <a href="{{route('post.article')}}" >
                                <span class="text-muted small l-d">{{ucfirst($list->post_type)}}</span>
                            </a>
                            <a href="{{route('post.author', [$list->author])}}" >
                                <p class="author">{{ucwords($list->author)}}</p>
                            </a>
                            <div class="l-d">
                                <a href="{{route('post.fromLocationPost', [$list->location])}}">
                                    <small>{{ucwords($list->location)}}</small>
                                </a>
                                <span class="mx-2"> | </span>
                                <small> {{date('M d, Y', strtotime($list->created_at))}} </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if ($list->post_type == 'video' || $list->post_type == 'वीडियो')
        <div class="col-12 col-sm-6 mb-3">
            <div class="news-card">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="image">
                            <a href="{{route('post.view', [$list->post_type, $list->slug])}}">
                                <iframe src="{{$list->video_embed_url}}" id="video_embed_preview" frameborder="0" allow="encrypted-media" allowfullscreen class="video-embed-preview" style="height:100%;width:100%;"></iframe>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-2 mt-lg-0">
                        <div class="card-desc">
                            <a href="{{route('post.view', [$list->post_type, $list->slug])}}">
                                <h5 class="news-title">
                                    {{ucwords($list->title)}}
                                </h5>
                            </a>
                            <a href="{{route('post.video')}}" >
                                <span class="text-muted small l-d">{{ucfirst($list->post_type)}}</span>
                            </a>
                            <a href="{{route('post.author', [$list->author])}}" >
                                <p class="author">{{ucwords($list->author)}}</p>
                            </a>
                            <div class="l-d">
                                <a href="{{route('post.fromLocationPost', [$list->location])}}">
                                    <small>{{ucwords($list->location)}}</small>
                                </a>
                                <span class="mx-2"> | </span>
                                <small> {{date('M d, Y', strtotime($list->created_at))}} </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @empty
            <div class="ms-4">{{'No posts available...'}}</div>                   
        @endforelse
        </div>
    </div>
</section>

<div class="d-flex justify-content-center">{{$posts->links()}}</div>

@endsection
