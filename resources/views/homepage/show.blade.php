@extends('layouts.guest')
@section('title', 'Post')

@section('content')

<div class="d-flex flex-column">
    {{-- post head --}}
    <section id="main-poster">
        <div class="poster">
            <img src="{{$post->post_image_gallery_id ? asset('storage/media/images/post_image_gallery/'.$post->mainImage->image) : $post->opt_image_url}}" alt="">
            <div class="content px-4">
                <div class="container-fluid flex-column justify-content-end">
                    <div class="cat-date">
                        <span class="cat-name">{{ucwords($post->category->name)}}</span>
                        <span class="mx-3">|</span>
                        <small>{{date('M d, Y', strtotime($post->created_at))}}</small>
                    </div>
                    <div class="title">
                        <h2>{{ucwords($post->title)}}</h2>
                    </div>
                    <div class="desc d-none d-md-block">
                        <p class="lead">
                            {{ucfirst($post->subtitle)}}
                        </p>
                    </div>
                    <div class="actions d-none d-lg-block">
                        <div class="action-content d-flex">
                            <span>{{ucwords($post->author)}}</span>
                            <span>
                                Share
                                {{-- {!! Share::page($meta['ogurl'], $post->title)->facebook()->twitter() !!} --}}
                                <!--@foreach ($shareButtons as $key => $val)-->
                                <!--<a href="{!! $val !!}" class="p-0 mx-1"><i class="fab fa-{{$key}} text-white"></i></a>-->
                                <!--@endforeach-->
                            </span>
                            <span class="print_post" class="cursor-pointer">
                                Print this Story
                            </span>
                            <span>
                                <i class="fas fa-map-marker me-1"></i>
                                {{ucwords($post->location)}}
                            </span>
                            <span class="see-more">
                                <a href="{{route('post.fromLocationPost', [$post->location])}}" class="text-white">See More from this Area</a>
                            </span>
                        </div>
                    </div>
               </div>
            </div>
        </div>
    </section>
    {{-- actions --}}
    <section id="small-actions" class="d-block d-lg-none">
        <div class="row">
            <div class="col-6">
                <span>{{ucwords($post->author)}}</span>
            </div>
            <div class="col-6 border-0">
                <span>
                    Share
                    <!--@foreach ($shareButtons as $key => $val)-->
                    <!--    <a href="{!! $val !!}" class="p-0 mx-1 text-reset"><i class="fab fa-lg fa-{{$key}}"></i></a>-->
                    <!--@endforeach-->
                </span>
            </div>
            <div class="col-6">
                <span class="print_post ">
                    <a href="javascript:void(0);" class="text-dark">
                        Print this Story
                    </a>
                </span>
            </div>
            <div class="col-6 border-0">
                <span>
                    <i class="fas fa-map-marker me-2"></i>
                    {{ucwords($post->location)}}
                </span>
            </div>
            <div class="col-6">
                <span class="see-more">
                    <a href="{{route('post.fromLocationPost', [$post->location])}}" class="text-dark">See More from this Area</a>
                </span>
            </div>
        </div>
    </section>
    {{-- small screen subtitle --}}
    <section id="small-subtitle" class="d-md-none px-2">
        <div class="container-fluid mt-3">
            {{ucfirst($post->subtitle)}}
        </div>
    </section>
    {{-- post content --}}
    <section id="blog-text">
        <div class="container-fluid mt-2">
            {!! $post->content !!}
        </div>
    </section>
    {{-- tags --}}
    <div class="tags d-flex flex-wrap align-items-center my-3 px-4 px-md-5">
        <span class="fw-bold me-2">Tags:</span>
        @foreach ($tags as $list)
            <a href="{{route('post.tag', [$list])}}" class="border text-decoration-none text-dark py-1 px-3 mx-1 my-1">{{$list}}</a>
        @endforeach
    </div><hr>
    {{-- comments --}}
    <p class="fw-bold px-4 px-md-5">Comment</p>
    @if (Session()->has('success'))
        <div class="alert alert-success mx-4 mx-md-5">{{session('success')}}</div>
    @endif
    @if (Session()->has('error'))
        <div class="alert alert-danger mx-4 mx-md-5">{{session('error')}}</div>
    @endif
    <form action="{{route('post.store', [$post->id])}}" method="post" class="px-4 px-md-5 mb-4">
        @csrf
        <div class="d-flex align-items-start mb-3">
            <i class="fas fa-user-circle fa-3x me-2 text-secondary"></i>
            <textarea name="comment" class="form-control" rows="6">{{old('comment')}}</textarea>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-success btn-sm px-3">Post <i class="far fa-paper-plane ms-2"></i></button>
        </div>
    </form>
</div>

{{-- author detail --}}
<section id="author-details" class="bg-dark p-5 text-white">
    <div class="container d-flex justify-content-evenly flex-wrap">
        <h2 class="author-name">{{ucwords($post->author)}}</h2>
        <a href="{{route('post.author', [$post->author])}}" class="btn btn-warning" role="button">Other Stories From {{ucwords($post->author)}}</a>
    </div>
</section>

{{-- related posts --}}
<section id="blog-card" class="overflow-hidden">
    <div class="container-fluid my-4">
        <div class="head d-flex mb-4" style="justify-content: space-between; align-items: baseline;">
            <h4 id="heading">Related Posts</h4>
            <a href="{{route('category.view', [$post->category->slug])}}" style="text-decoration: underline; color: black;">View More</a>
        </div>
        <div class="row">
        @forelse ($relatedPosts as $list)
        @if ($list->post_type == 'article')
        <div class="col-12 col-sm-6 mb-3">
            <div class="news-card">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="image">
                            <a href="{{route('post.view', [$list->post_type, $list->slug])}}">
                            <img src="{{$list->post_image_gallery_id ? asset('storage/media/images/post_image_gallery/'.$list->mainImage->image) : $list->opt_image_url}}" alt="">
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
        @empty
            <div class="ms-4">{{'No related posts'}}</div>                   
        @endforelse
    </div>
</section>
@endsection

@push('styles')
    <style>
        @media print {
            .content {
                display: none;
            }

            #blog-text {
                padding: 0px !important;
            }
            
            .poster {
                height: 400px !important;
            }

            img{
                width: 100% !important;
                /* object-fit: contain !important; */
            }
            
        }
    </style>
@endpush
@push('js')
    <script>
        $(document).ready(function(){
            $(".print_post").on("click",function(){
                $("#main-poster, #blog-text").printThis({
                    importCSS:true,
                    importStyle:true,
                    pageTitle: "{{config('app.name', '')}}",
                    header: '<h2 class="cat-name border-top mt-3 pt-2">{{ucwords($post->title)}}</h2><div>{{ucfirst($post->subtitle)}}</div><div class="flex justify-content-between mb-2"><small class="small">{{ucwords($post->author) . ' | ' . date("M d, Y", strtotime($post->created_at))}}</small><small></small></div>'
                })
            });
        });
        
    </script>
@endpush

