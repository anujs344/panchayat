@extends('layouts.guest')
@section('title', 'Home')

@section('content')
{{-- Slider --}}
<section id="main-carousel">
    @if (count($sliders) > 0)
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($sliders->take(1) as $post)
            <div class="carousel-item active">
                <img src="{{$post->post_image_gallery_id ? $post->mainImage? asset('storage/media/images/post_image_gallery/'.$post->mainImage->image) : ('') : $post->opt_image_url}}" alt="" class="d-block w-100">
                <div class="content">
                    <div class="container-fluid">
                       <a href="{{route('post.view', [$post->post_type, $post->slug])}}">
                            <h1>{{ucfirst($post->title)}}</h1>
                            {{-- <h5 class="mt-4 text-white"> {{ucwords($post->subtitle)}} </h5> --}}
                            <div class="l-d">
                                <h5 class="mt-4 author text-white"> {{ucwords($post->author)}} </h5>
                                <span class="text-white">{{ucwords($post->location)}}</span>
                                <span class="mx-2 text-warning"> | </span>
                                <span class="text-white"> {{date('M d, Y', strtotime($post->created_at))}} </span>
                            </div>
                       </a>
                    </div>
                </div>
            </div>
            @endforeach
            
            @foreach ($sliders->skip(1) as $post)
            <div class="carousel-item">
                <img src="{{$post->post_image_gallery_id ? $post->mainImage? asset('storage/media/images/post_image_gallery/'.$post->mainImage->image) : ('') : $post->opt_image_url}}" alt="" class="d-block w-100">
                <div class="content">
                    <div class="container-fluid">
                       <a href="{{route('post.view', [$post->post_type, $post->slug])}}">
                        <h1>{{ucfirst($post->title)}}</h1>
                        {{-- <h5 class="mt-4 text-white"> {{ucwords($post->subtitle)}} </h5> --}}
                        <div class="l-d">
                            <h5 class="mt-4 author text-white"> {{ucwords($post->author)}} </h5>
                            <span class="text-white">{{ucwords($post->location)}}</span>
                            <span class="mx-2 text-warning"> | </span>
                            <span class="text-white"> {{date('M d, Y', strtotime($post->created_at))}} </span>
                        </div>
                       </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
    </div>
    @endif
</section>

{{-- navigation post --}}
@forelse ($navigations->where('title', '!=', 'home') as $n)
@if ($n->category->name == 'वीडियो' || $n->category->name == 'video')
<section id="video-blog">
    <div class="head d-flex mb-5 mt-3" style="justify-content: space-between; align-items: baseline;">
        <h4 class="" id="heading">{{ucwords($n->category->name)}}</h4>
        <span class="more float-end"><a href="{{route('category.view', [$n->category->slug])}}" style="text-decoration: underline; color:#000">View More</a></span>
    </div>
    @auth
    @if (count($n->category->posts->where('visibility',1)->where('status',1)) > 0)
    <div class="row">
        @foreach ($n->category->posts->where('visibility',1)->where('status',1)->take(1) as $list)
        <div class="col-lg-6">
            <div class="big-video d-none d-lg-block">
                <a href="{{route('post.view', [$list->post_type, $list->slug])}}">
                    <iframe src="{{$list->video_embed_url}}" id="video_embed_preview" frameborder="0" allow="encrypted-media" allowfullscreen class="video-embed-preview"></iframe>
                </a>
            </div>
        </div>
        @endforeach
        <div class="col-lg-6 mt-2 mt-lg-0">
            <div class="small-vid row row-cols-1 row-cols-sm-2 row-cols-lg-1">
                @foreach ($n->category->posts->where('visibility',1)->where('status',1)->take(3) as $list)
                <div class="col mb-3 mb-lg-auto">
                    <div class="row mb-2">
                        <div class="col-lg-6 col-12 mb-2">
                            <div class="vid">
                                <!--<a href="{{route('post.view', [$list->post_type, $list->slug])}}">-->
                                    <iframe src="{{$list->video_embed_url}}" id="video_embed_preview" frameborder="0" allow="encrypted-media" allowfullscreen class="video-embed-preview"></iframe>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="card-desc">
                                <a href="{{route('post.view', [$list->post_type, $list->slug])}}">
                                    <h5 class="news-title">
                                        {{ucwords($list->title)}}
                                    </h5>
                                </a>
                                <a href="{{route('post.video')}}" >
                                    <span class="text-muted small">{{ucfirst($list->post_type)}}</span>
                                </a>
                                <a href="{{route('post.author', [$list->author])}}" >
                                    <div class="author text-warning">{{ucwords($list->author)}}</div>
                                </a>
                                <div class="l-d">
                                    <a href="{{route('post.fromLocationPost', [$list->location])}}">
                                        <small>{{ucwords($list->location)}}</small>
                                    </a>
                                    <span class="mx-2"> | </span>
                                    <small class="text-muted"> {{date('M d, Y', strtotime($list->created_at))}} </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @else
        <div class="ms-4 py-0">No posts available...</div>
    @endif
    @else
    @if (count($n->category->posts->where('visibility',1)->where('status',1)->where('show_auth_user', '!=', 1)) > 0)
        <div class="row">
            @foreach ($n->category->posts->where('visibility',1)->where('status',1)->where('show_auth_user', '!=', 1)->take(1) as $list)
            <div class="col-lg-6">
                <div class="big-video d-none d-lg-block">
                    <a href="{{route('post.view', [$list->post_type, $list->slug])}}">
                        <iframe src="{{$list->video_embed_url}}" id="video_embed_preview" frameborder="0" allow="encrypted-media" allowfullscreen class="video-embed-preview"></iframe>
                    </a>
                </div>
            </div>
            @endforeach
            <div class="col-lg-6 mt-2 mt-lg-0">
                <div class="small-vid row row-cols-1 row-cols-sm-2 row-cols-lg-1">
                    @foreach ($n->category->posts->where('visibility',1)->where('status',1)->where('show_auth_user', '!=', 1)->take(3) as $list)
                    <div class="col mb-3 mb-lg-auto">
                        <div class="row mb-2">
                            <div class="col-lg-6 col-12 mb-2">
                                <div class="vid">
                                    <a href="{{route('post.view', [$list->post_type, $list->slug])}}">
                                        <iframe src="{{$list->video_embed_url}}" id="video_embed_preview" frameborder="0" allow="encrypted-media" allowfullscreen class="video-embed-preview"></iframe>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="card-desc">
                                    <a href="{{route('post.view', [$list->post_type, $list->slug])}}">
                                        <h5 class="news-title">
                                            {{ucwords($list->title)}}
                                        </h5>
                                    </a>
                                    <a href="{{route('post.video')}}" >
                                        <span class="text-muted small">{{ucfirst($list->post_type)}}</span>
                                    </a>
                                    <a href="{{route('post.author', [$list->author])}}" >
                                        <div class="author text-warning">{{ucwords($list->author)}}</div>
                                    </a>
                                    <div class="l-d">
                                        <a href="{{route('post.fromLocationPost', [$list->location])}}">
                                            <small>{{ucwords($list->location)}}</small>
                                        </a>
                                        <span class="mx-2"> | </span>
                                        <small class="text-muted"> {{date('M d, Y', strtotime($list->created_at))}} </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    @else
        <div class="ms-4 py-0">No posts available...</div>
    @endif
    @endauth
</section>
@else
<section id="blog-card" class="overflow-hidden">
    <div class="container-fluid my-4">
        <div class="head d-flex mb-4" style="justify-content: space-between; align-items: baseline;">
            <h4 id="heading">{{ucwords($n->category->name)}}</h4>
            <a href="{{route('category.view', [$n->category->slug])}}" style="text-decoration: underline; color:#000">View More</a>
        </div>
        <div class="row">
        @auth
            @forelse ($n->category->posts->where('visibility',1)->where('status',1)->take(5) as $list)
                @if ($list->post_type == 'article')
                <div class="col-12 col-sm-6 mb-3">
                    <div class="news-card">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="image">
                                    <a href="{{route('post.view', [$list->post_type, $list->slug])}}">
                                        <img src="{{$list->post_image_gallery_id ? $list->mainImage?  asset('storage/media/images/post_image_gallery/'.$list->mainImage->image) : ('') : $list->opt_image_url}}" alt="">
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
                                        <span class="text-muted small">{{ucfirst($list->post_type)}}</span>
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
                <div class="ms-4 my-0">
                    {{'No post available...'}}
                </div>
            @endforelse
        @else
            @forelse ($n->category->posts->where('visibility',1)->where('status',1)->where('show_auth_user', '!=', 1)->take(5) as $list)
                @if ($list->post_type == 'article')
                <div class="col-12 col-sm-6 mb-3">
                    <div class="news-card">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="image">
                                    <a href="{{route('post.view', [$list->post_type, $list->slug])}}">
                                        <img src="{{$list->post_image_gallery_id ? $list->mainImage?  asset('storage/media/images/post_image_gallery/'.$list->mainImage->image) : ('') : $list->opt_image_url}}" alt="">
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
                                        <span class="text-muted small">{{ucfirst($list->post_type)}}</span>
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
                <div class="ms-4 my-0">
                    {{'No post available...'}}
                </div>
            @endforelse
        @endauth
        </div>
    </div>
</section>
@endif
@empty
    <div class="ms-4">{{'No posts available...'}}</div>
@endforelse

{{-- <section id="reports" class="bg-light">
    <div class="container-fluid my-4">
        <div class="head d-flex mb-5 mt-3" style="justify-content: space-between; align-items: baseline;">
            <h3 class="" id="heading"> Our Surveys & Reports</h3>
            <span class="more float-end"><a href="" style="text-decoration: underline;">View More</a></span>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="report-card">
                    <div class="row">
                        <div class="col-6">
                            <div class="image">
                               <a href="">
                                <img src="img\newspaper-car.jpg" alt="">
                               </a>
                            </div>
                        </div>
                        <div class="col-6">
                           <a href="">
                            <h3 class="title">
                                All India Suryey on Lorem Ipsum Usage (2020-2021)
                            </h3>
                            <div class="date">
                                <span class="text-muted">July 27, 2021</span>
                            </div>
                           </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="report-card">
                    <div class="row">
                        <div class="col-6">
                            <div class="image">
                                <a href="">
                                    <img src="img\newspaper-car.jpg" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-6">
                            <a href="">
                                <h3 class="title">
                                    Our Report on Lorem Ipsum Usage Lorem ipsum dolor sit. (2020-2021)
                                </h3>
                                <div class="date">
                                    <span class="text-muted">July 27, 2021</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}

{{-- <section id="s-donate" class="my-5">
    <div class="container text-center">
        <h1 class="text-center" style="color: rgb(255, 192, 20); font-weight: 900; text-shadow: 3px 3px black;">
            Like Our Work?
        </h1>
        <h4 >You Can Support us by Donating!</h4>

        <div class="row mt-5">
            <div class="col-6">
                <div class="donate-card py-5 px-2">
                    <h1><i class="fas fa-hand-holding-usd"></i></h1>
                    <h3>Donate to NewsBlog</h3>
                </div>
            </div>
            <div class="col-6">
                <div class="donate-card py-5 px-2">
                    <h1><i class="fas fa-hands-helping"></i></h1>
                    <h3>Support to NewsBlog</h3>
                </div>
            </div>
        </div>
    </div>
</section> --}}

@endsection

