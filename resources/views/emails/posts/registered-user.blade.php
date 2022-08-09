@component('mail::message')
# Hello

<div style="font-weight: bold;text-align:center;margin:20px 0 10px;">
    {{$post->title}}
</div>
<div>
    <img src="{{$post->post_image_gallery_id ? asset('storage/media/images/post_image_gallery/'.$post->mainImage->image) : $post->opt_image_url}}" alt="{{$post->title}}">
</div>

@component('mail::button', ['url' => route('post.view', [$post->post_type,$post->slug])])
View Post
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
