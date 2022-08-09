@extends('layouts.admin.app')

@section('main')
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <div class="fs-5 fw-bold text-dark">Edit Article</div>
            <a href="{{ route('admin.post.view') }}" role="button" class="btn btn-primary btn-sm d-flex align-items-center">
                <i class='bx bx-menu me-1'></i>
                Posts
            </a>
        </div>
        <hr>
        
        <!-- form start -->
        <form action="{{ route('admin.post.update', [$post->id, 'post_type'=>$post->post_type]) }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            @csrf
            <input type="hidden" name="post_type" value="article">
            <div class="row">
                <div class="col-xl-8">
                    <div class="card radius-10 w-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="d-flex flex-column">
                                    <h5 class="mb-0">Post Details</h5>
                                </div>
                            </div>

                            {{-- validation --}}
                            <x-jet-validation-errors class="mb-2 text-danger" />

                            {{-- title --}}
                            <div class="col-12 mt-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" class="form-control text-truncate" onkeyup="createSlug(this)" id="title" placeholder="Title" value="{{ucwords($post->title)}}">
                            </div>
                            {{-- subtitle --}}
                            <div class="col-12 mt-3">
                                <label for="subtitle" class="form-label">Sub Title</label>
                                <input type="text" name="subtitle" class="form-control" id="subtitle" value="{{ucwords($post->subtitle)}}" placeholder="Sub Title">
                            </div>
                            {{-- slug --}}
                            <div class="col-12 mt-3">
                                <label class="form-label">Slug
                                    <small>(If you leave it blank, it will be generated automatically.)</small>
                                </label>
                                <input type="text" class="form-control" name="slug" data-slug="slug" placeholder="Slug" value="{{$post->slug}}">
                            </div>
                            {{-- description --}}
                            <div class="col-12 mt-3">
                                <label class="form-label">Summary & Description (Meta Tag)</label>
                                <textarea class="form-control" name="description" placeholder="Summary & Description (Meta Tag)" >{{ucwords($post->description)}}</textarea>
                            </div>
                            {{-- keywords --}}
                            <div class="col-12 mt-3">
                                <label class="form-label">Keywords (Meta Tag)</label>
                                <input type="text" class="form-control" name="keywords" placeholder="Keywords (Meta Tag)" value="{{ucwords($post->keywords)}}">
                            </div>
                            {{-- visibility --}}
                            <div class="col-12 mt-3">
                                <div class="row g-sm-2">
                                    <div class="col-md-4 col-sm-12">
                                        <label class="fw-bold">Visibility</label>
                                    </div>
                                    @if ($post->visibility == 1)
                                    <div class="col-lg-2 col-md-4 col-sm-12">
                                        <input type="radio" id="rb_visibility_1" name="visibility" value="1" class="polaris" checked>
                                        <label for="rb_visibility_1" class="cursor-pointer">Show</label>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-sm-12">
                                        <input type="radio" id="rb_visibility_2" name="visibility" value="0" class="polaris">
                                        <label for="rb_visibility_2" class="cursor-pointer">Hide</label>
                                    </div>
                                    @else
                                    <div class="col-lg-2 col-md-4 col-sm-12">
                                        <input type="radio" id="rb_visibility_1" name="visibility" value="1" class="polaris">
                                        <label for="rb_visibility_1" class="cursor-pointer">Show</label>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-sm-12">
                                        <input type="radio" id="rb_visibility_2" name="visibility" value="0" class="polaris" checked>
                                        <label for="rb_visibility_2" class="cursor-pointer">Hide</label>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            {{-- show right column--}}
                            <div class="col-12 mt-3">
                                <div class="row g-sm-2">
                                    <div class="col-md-4 col-sm-12">
                                        <label class="fw-bold">Show Right Column</label>
                                    </div>
                                    @if ($post->show_right_column == 1)
                                    <div class="col-lg-2 col-md-4 col-sm-12">
                                        <input type="radio" name="show_right_column" value="1" class="polaris" id="right_column_enabled" checked>
                                        <label for="right_column_enabled" class="option-label">Yes</label>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-sm-12">
                                        <input type="radio" name="show_right_column" value="0" class="polaris" id="right_column_disabled">
                                        <label for="right_column_disabled" class="option-label">No</label>
                                    </div>  
                                    @else
                                    <div class="col-lg-2 col-md-4 col-sm-12">
                                        <input type="radio" name="show_right_column" value="1" class="polaris" id="right_column_enabled">
                                        <label for="right_column_enabled" class="option-label">Yes</label>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-sm-12">
                                        <input type="radio" name="show_right_column" value="0" class="polaris" id="right_column_disabled" checked>
                                        <label for="right_column_disabled" class="option-label">No</label>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            {{-- featured --}}
                            <div class="col-12 mt-3">
                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <label class="form-label fw-bold">Add to Featured</label>
                                    </div>
                                    <div class="col-md-8 col-sm-12 ps-md-2">
                                        @if ($post->featured == 1)
                                        <input type="checkbox" name="is_featured" value="1" class="polaris" checked>
                                        @else
                                        <input type="checkbox" name="is_featured" value="1" class="polaris">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            {{-- breaking --}}
                            <div class="col-12 mt-3">
                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <label class="form-label fw-bold">Add to Breaking</label>
                                    </div>
                                    <div class="col-md-8 col-sm-12 ps-sm-2">
                                        @if ($post->breaking == 1)
                                        <input type="checkbox" name="is_breaking" class="polaris" value="1" checked>
                                        @else
                                        <input type="checkbox" name="is_breaking" class="polaris" value="1">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            {{-- slider --}}
                            <div class="col-12 mt-3">
                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <label class="form-label fw-bold">Add to Slider</label>
                                    </div>
                                    <div class="col-md-8 col-sm-12 ps-sm-2">
                                        @if ($post->slider == 1)
                                        <input type="checkbox" class="polaris" name="is_slider" value="1" checked>
                                        @else
                                        <input type="checkbox" name="is_slider" class="polaris" value="1">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            {{-- recommended --}}
                            <div class="col-12 mt-3">
                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <label class="form-label fw-bold">Add to Recommended</label>
                                    </div>
                                    <div class="col-md-8 col-sm-12 ps-sm-2">
                                        @if ($post->recommended == 1)
                                        <input type="checkbox" class="polaris" name="is_recommended" value="1" checked>
                                        @else
                                        <input type="checkbox" class="polaris" name="is_recommended" value="1">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            {{-- Show Only to Registered Users --}}
                            <div class="col-12 mt-3">
                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <label class="form-label fw-bold">Show Only to Registered Users</label>
                                    </div>
                                    <div class="col-md-8 col-sm-12 ps-sm-2">
                                        @if ($post->show_auth_user == 1)
                                        <input type="checkbox" name="show_auth" class="polaris" value="1" checked>
                                        @else
                                        <input type="checkbox" name="show_auth" class="polaris" value="1">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            {{-- Send Post to All Subscribers (Newsletter) --}}
                            <div class="col-12 mt-3">
                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <label class="form-label fw-bold">Send Post to All Subscribers (Newsletter)</label>
                                    </div>
                                    <div class="col-md-8 col-sm-12 ps-sm-2">
                                        @if ($post->send_subscriber == 1)
                                        <input type="checkbox" name="send_to_subscriber" value="1" class="polaris" checked>
                                        @else
                                        <input type="checkbox" name="send_to_subscriber" value="1" class="polaris">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            {{-- Tags --}}
                            <div class="col-12 mt-3">
                                <label class="form-label fw-bold">Tags</label>
                                <input type="text" name="tags" class="form-control" data-role="tagsinput" placeholder="Tags" value="{{$post->tags}}">
                                <small>(Type tag and hit enter)</small>
                            </div>
                            {{-- Optional URL --}}
                            <div class="col-12 mt-3">
                                <label class="form-label fw-bold">Optional URL</label>
                                <input type="text" class="form-control" name="opt_url" placeholder="Optional URL" value="{{$post->opt_url}}">
                            </div>
                            {{-- author --}}
                            <div class="col-12 mt-3">
                                <label class="form-label">Author</label>
                                <input type="text" class="form-control" name="author" placeholder="Author Name" value="{{ucwords($post->author)}}" required>
                            </div>
                        </div>
                    </div>
                    {{-- content --}}
                    <div id="main_editor">
                        <div class="fw-bold mt-3">
                            Contents
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-12 editor-buttons">
                                <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#file_manager_image" data-image-type="editor">
                                    <i class="bx bx-image"></i>
                                    Add Image
                                </button>
                            </div>
                        </div>
                        <textarea class="tinyMCE form-control" name="content">{{$post->content}}</textarea>
                    </div>
                </div>
                <div class="col-xl-4">
                    {{-- main post image --}}
                    <div class="card radius-10 w-100">
                        <div class="card-body">
                            <div class="d-flex flex-column fs-6 mb-3">
                                <div class="fw-bold">Image</div>
                                <small class="small">Main post image</small>
                            </div>
                            {{-- main image --}}
                            <div id="post_select_image_container" class="post-select-image-container">
                                @if (isset($post->mainImage))
                                <img src="{{asset('storage/media/images/post_image_gallery/'.$post->mainImage->image)}}" alt="" style="object-fit: contain">
                                <a id="btn_delete_post_main_image" class="btn text-white btn-sm btn-delete-selected-file-image">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/></svg>
                                </a>
                                @else
                                    <a class="btn-select-image" data-bs-toggle="modal" data-bs-target="#file_manager_image" data-image-type="main">
                                        <div class="btn-select-image-inner">
                                            <i class="bx bx-images"></i>
                                            <button class="btn">Select Image</button>
                                        </div>
                                    </a>
                                @endif                                
                            </div>
                            <input type="hidden" name="post_image_id" id="post_image_id" value="{{$post->mainImage->id ?? ''}}">
                            {{-- image url --}}
                            <div class="col-12 mt-3">
                                <label for="title" class="form-label fw-bold">or&nbsp;Add Image Url</label>
                                <input type="text" name="opt_main_image_url" class="form-control" id="video_thumbnail_url" placeholder="Add Image Url" value="{{$post->opt_image_url}}">
                            </div>
                            {{-- image desc --}}
                            <div class="col-12 mt-3">
                                <label class="form-label fw-bold">Image Description</label>
                                <input type="text" class="form-control" name="image_desc" placeholder="Image Description" value="{{$post->image_desc}}">
                            </div>
                        </div>
                    </div>
                    {{-- additional images --}}
                    <div class="card radius-10 w-100">
                        <div class="card-body">
                            <div class="fw-bold">Additional Images</div>
                            <p class="small">More main images (slider will be active)</p>
                            <a class='btn btn-sm btn-primary' data-bs-toggle="modal" data-bs-target="#file_manager_image" data-image-type="additional">
                                Select Image
                            </a>
                        </div>
                        {{-- additional image list --}}
                        <div class="card-body">
                            <div class="additional-image-list">
                                @if (isset($post->postSlider) > 0)
                                    @foreach ($post->postSlider as $list)
                                    <div class="additional-item additional-item-{{$list->post_image_gallery_id}}">
                                        <img class="img-additional" src="{{asset('storage/media/images/post_image_gallery/'.$list->postImageGallery->image)}}" alt="" height="140px" width="120px" style="object-fit: contain">
                                        <input type="hidden" name="additional_post_image_id[]" value="{{$list->post_image_gallery_id}}">
                                        <a class="btn btn-sm text-white btn-delete-additional-image" data-value="{{$list->post_image_gallery_id}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                                            </svg>
                                        </a>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    {{-- files --}}
                    <div class="card radius-10 w-100">
                        <div class="card-body">
                            <div class="fw-bold">Files</div>
                            <p class="small">Downloadable additional files (.pdf, .docx, .zip etc..)</p>
                            <a class='btn btn-sm btn-primary' data-bs-toggle="modal" data-bs-target="#file_manager">
                                Select File
                            </a>
                        </div>
                        <div class="card-body">
                            <div id="post_selected_files" class="post-selected-files">
                                @if (isset($post->postFile) > 0)
                                    @foreach ($post->postFile as $list)
                                    <div id="file_{{$list->post_file_gallery_id}}" class="item">
                                        <input type="hidden" name="post_selected_file_id[]" value="{{$list->post_file_gallery_id}}">
                                        <div class="left">
                                            <i class="bx bx-file"></i>
                                        </div>
                                        <div class="center">
                                            <span>{{$list->postFileGallery->file}}</span>
                                        </div>
                                        <div class="right">
                                            <a href="javascript:void(0)" class="btn btn-sm text-white btn-selected-file-list-item btn-delete-selected-file" data-value="{{$list->post_file_gallery_id}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill text-danger" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    {{-- category / location --}}
                    <div class="card radius-10 w-100">
                        <div class="card-body">
                            {{-- category --}}
                            <div class="col-12 mt-3">
                                <label class="form-label">Category</label>
                                <select id="categories" name="category_id" class="form-select" onchange="get_sub_categories(this.value);" required>
                                    @foreach ($categories as $list)
                                        <option value="{{$list->id}}"
                                            @if ($list->id == $post->category_id)
                                                {{'selected'}}
                                            @endif
                                        >
                                            {{ucwords($list->name)}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- subcategory --}}
                            <div class="col-12 mt-3">
                                <label class="form-label">Subcategory</label>
                                <select id="subcategories" name="subcategory_id" class="form-select">
                                    <option value="0">Select a category</option>
                                    @if (isset($post->category_id))
                                        @foreach ($post->category->child as $list)
                                        <option value="{{$list->id}}"
                                        @if ($list->id == $post->subcategory_id)
                                            {{'selected'}}
                                        @endif
                                        >
                                            {{ucwords($list->name)}}
                                        </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            {{-- location --}}
                            <div class="col-12 mt-3">
                                <label class="form-label">Post Location</label>
                                <input type="text" class="form-control" name="location" value="{{ucwords($post->location)}}" placeholder="Post Location" required>
                            </div>
                            {{-- publish --}}
                            <div class="col-12 mt-3 d-flex justify-content-end">
                                <button type="submit" name="status" value="1" class="btn btn-primary btn-sm" onclick="allow_submit_form = true;">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        
        <!-- Button trigger modal -->
          
        <!-- Images Gallery Modal -->
        <div id="file_manager_image" class="modal fade modal-file-manager" role="dialog">
            <div class="modal-dialog modal-xl">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header flex-wrap">
                        <h5 class="modal-title col-6 col-sm-4 col-xl-3">Images</h5>
                        <button type="button" class="btn-close col-2 col-sm-4 col-xl-5 order-sm-3" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="order-sm-2 col-12 col-sm-6 col-xl-4">
                            <input type="text" id="input_search_image" class="form-control" placeholder="Search">
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row gx-0">
                            {{-- upload image --}}
                            <div class="col-12 col-sm-4 col-xl-3 border-end">
                                <div class="dm-uploader-container px-2 py-1">
                                    <div id="drag-and-drop-zone-image" class="dm-uploader text-center">
                                        <p class="file-manager-file-types">
                                            <span>JPG</span>
                                            <span>JPEG</span>
                                            <span>PNG</span>
                                            <span>GIF</span>
                                        </p>
                                        <p class="dm-upload-icon">
                                            <i class='bx bx-cloud-upload' ></i>
                                        </p>
                                        <p class="dm-upload-text">Drag and drop files here or</p>
                                        <p class="text-center">
                                            <button class="btn btn-outline-secondary btn-browse-files btn-sm">Browse Files</button>
                                        </p>
                                        <a class='btn btn-sm dm-btn-select-files'>
                                            <input type="file" name="file" size="40" multiple="multiple">
                                        </a>
                                        <ul class="dm-uploaded-files" id="files-image"></ul>
                                        <button type="button" id="btn_reset_upload_image" class="btn btn-sm btn-reset-upload">Reset</button>
                                    </div>
                                </div>
                            </div>
                            {{-- view image --}}
                            <div class="col-12 col-sm-8 col-xl-9">
                                <div class="file-manager-content">
                                    <div id="image_file_upload_response"></div>
                                </div>
                            </div>
                            <input type="hidden" id="selected_img_file_id">
                            <input type="hidden" id="selected_img_mid_file_path">
                            <input type="hidden" id="selected_img_default_file_path">
                            <input type="hidden" id="selected_img_slider_file_path">
                            <input type="hidden" id="selected_img_big_file_path">
                        </div>
                    </div>
                    {{-- model footer --}}
                    <div class="modal-footer">
                        <button type="button" id="btn_img_delete" class="btn btn-danger btn-sm btn-file-delete">
                            <i class="bx bx-trash bx-xs pb-1"></i>
                            Delete
                        </button>
                        <button type="button" id="btn_img_select" class="btn btn-sm btn-info btn-file-select">
                            <i class="bx bx-check bx-xs pb-1"></i>
                            Select Image
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
          
        <!-- Files Gallery Modal -->
        <div id="file_manager" class="modal fade modal-file-manager" role="dialog">
            <div class="modal-dialog modal-xl">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header flex-wrap">
                        <h5 class="modal-title col-6 col-sm-4 col-xl-3">Files</h5>
                        <button type="button" class="btn-close col-2 col-sm-4 col-xl-5 order-sm-3" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="order-sm-2 col-12 col-sm-6 col-xl-4">
                            <input type="text" id="input_search_file" class="form-control" placeholder="Search">
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row gx-0">
                            {{-- upload image --}}
                            <div class="col-12 col-sm-4 col-xl-3 border-end">
                                <div class="dm-uploader-container px-2 py-1">
                                    <div id="drag-and-drop-zone" class="dm-uploader text-center">
                                        <p class="dm-upload-icon">
                                            <i class="bx bx-cloud-upload"></i>
                                        </p>
                                        <p class="dm-upload-text">Drag and drop files here or</p>
                                        <p class="text-center">
                                            <button class="btn btn-default btn-browse-files">Browse Files</button>
                                        </p>
        
                                        <a class='btn btn-md dm-btn-select-files'>
                                            <input type="file" name="file" size="40" multiple="multiple">
                                        </a>
                                        <ul class="dm-uploaded-files" id="files-file"></ul>
                                        <button type="button" id="btn_reset_upload" class="btn btn-reset-upload">Reset</button>
                                    </div>
                                </div>
                            </div>
                            {{-- view image --}}
                            <div class="col-12 col-sm-8 col-xl-9">
                                <div class="file-manager-content">
                                    <div class="col-sm-12">
                                        <div id="file_upload_response"></div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="selected_file_id">
                            <input type="hidden" id="selected_file_name">
                            <input type="hidden" id="selected_file_path">
                        </div>
                    </div>
                    {{-- model footer --}}
                    <div class="modal-footer">
                        <button type="button" id="btn_file_delete" class="btn btn-danger btn-sm btn-file-delete">
                            <i class="bx bx-trash bx-xs pb-1"></i>
                            Delete
                        </button>
                        <button type="button" id="btn_file_select" class="btn btn-sm btn-info btn-file-select">
                            <i class="bx bx-check bx-xs pb-1"></i>
                            Select File
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
<!--end page wrapper -->
@endsection

@push('js')

{{-- configuration --}}
<script>
    var base_url = "{{url('admin') . '/'}}"
    var get_url = "{{route('admin.postImageGallery.view')}}";
    var get_file_url = "{{route('admin.postFileGallery.view')}}";
    var delete_url = "{{url('admin/post-image-gallery/delete') . '/'}}";
    var delete_file_url = "{{url('admin/post-file-gallery/delete') . '/'}}";
    var fb_app_id = "";
    var txt_select_image = "Select Image";
    
    // tinymce
    if ($('textarea.tinyMCE').length > 0) {
        init_tinymce('textarea.tinyMCE', 500);
    }
</script>

{{-- general --}}
<script>
    // hide delete & select model button
    $('#btn_img_delete').hide();
    $('#btn_file_delete').hide();
    $('#btn_img_select').hide();
    $('#btn_file_select').hide();
    $('#btn_reset_upload_image').hide();
    $('#btn_reset_upload').hide();
    $('[data-bs-dismiss="modal"]').click(function (){
        $('#btn_img_delete').hide();
        $('#btn_file_delete').hide();
        $('#btn_img_select').hide();
        $('#btn_file_select').hide();
        $('#btn_reset_upload_image').hide();
        $('#btn_reset_upload').hide();
    });

    
    var post_type = "article";
    var text_select_a_result = "Select a result";
    var text_result = "Result";
    //warn before close the page
    var allow_submit_form = false;
    window.onbeforeunload = function () {
        if ($('#title').val().trim().length > 0) {
            if (allow_submit_form == false) {
                return 'You have unsaved changes! Are you sure you want to leave this page?';
            }
        }
    };
        
</script>

<!-- Post Image Gallery -->
<script type="text/html" id="files-template-image">
    <li class="media">
        <img class="preview-img" src="{{ asset('assets/plugins/file-manager/file.png') }}" alt="">
        <div class="media-body">
            <div class="progress">
                <div class="dm-progress-waiting"></div>
                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </li>
</script>

<script>
    var txt_processing = "Processing...";
    $(function () {
        $('#drag-and-drop-zone-image').dmUploader({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('admin.postImageGallery.store') }}",
            queue: true,
            allowedTypes: 'image/*',
            extFilter: ["jpg", "jpeg", "png", "gif"],
            extraData: function (id) {
                return {
                    "file_id": id,
                };
            },
            onDragEnter: function () {
                this.addClass('active');
            },
            onDragLeave: function () {
                this.removeClass('active');
            },
            onInit: function () {
            },
            onComplete: function (id) {
            },
            onNewFile: function (id, file) {
                ui_multi_add_file(id, file, "image");
                if (typeof FileReader !== "undefined") {
                    var reader = new FileReader();
                    var img = $('#uploaderFile' + id).find('img');

                    reader.onload = function (e) {
                        img.attr('src', e.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            },
            onBeforeUpload: function (id) {
                $('#uploaderFile' + id + ' .dm-progress-waiting').hide();
                ui_multi_update_file_progress(id, 0, '', true);
                ui_multi_update_file_status(id, 'uploading', 'Uploading...');
                $("#btn_reset_upload_image").show();
            },
            onUploadProgress: function (id, percent) {
                ui_multi_update_file_progress(id, percent);
            },
            onUploadSuccess: function (id, data) {
                document.getElementById("uploaderFile" + id).remove();
                refresh_images();
                ui_multi_update_file_status(id, 'success', 'Upload Complete');
                ui_multi_update_file_progress(id, 100, 'success', false);
                $("#btn_reset_upload_image").hide();
            },
            onUploadError: function (id, xhr, status, message) {
                if (message == "Not Acceptable") {
                    $("#uploaderFile" + id).remove();
                    $(".error-message-img-upload").show();
                    $(".error-message-img-upload p").html("");
                    setTimeout(function () {
                        $(".error-message-img-upload").fadeOut("slow");
                    }, 4000)
                }
            },
            onFallbackMode: function () {
            },
            onFileSizeError: function (file) {
            },
            onFileTypeError: function (file) {
            },
            onFileExtError: function (file) {
            },
        });
    });

    $(document).on('click', '#btn_reset_upload_image', function () {
        $("#drag-and-drop-zone-image").dmUploader("reset");
        $("#files-image").empty();
        $(this).hide();
    });
</script>

<!-- Post File Gallery -->
<script type="text/html" id="files-template-file">
    <li class="media">
        <img class="preview-img" src="{{ asset('assets/plugins/file-manager/file.png') }}" alt="">
        <div class="media-body">
            <div class="progress">
                <div class="dm-progress-waiting"></div>
                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </li>
</script>

<script>
    var txt_processing = "Processing...";
    $(function () {
        $('#drag-and-drop-zone').dmUploader({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('admin.postFileGallery.store')}}",
            queue: true,
            extraData: function (id) {
                return {
                    "file_id": id,
                };
            },
            onDragEnter: function () {
                this.addClass('active');
            },
            onDragLeave: function () {
                this.removeClass('active');
            },
            onInit: function () {
            },
            onComplete: function (id) {
            },
            onNewFile: function (id, file) {
                ui_multi_add_file(id, file, "file");
            },
            onBeforeUpload: function (id) {
                $('#uploaderFile' + id + ' .dm-progress-waiting').hide();
                ui_multi_update_file_progress(id, 0, '', true);
                ui_multi_update_file_status(id, 'uploading', 'Uploading...');
                $("#btn_reset_upload").show();
            },
            onUploadProgress: function (id, percent) {
                ui_multi_update_file_progress(id, percent);
            },
            onUploadSuccess: function (id, data) {
                refresh_files();
                document.getElementById("uploaderFile" + id).remove();
                ui_multi_update_file_status(id, 'success', 'Upload Complete');
                ui_multi_update_file_progress(id, 100, 'success', false);
                $("#btn_reset_upload").hide();
            },
            onUploadError: function (id, xhr, status, message) {
            },
            onFallbackMode: function () {
            },
            onFileSizeError: function (file) {
            },
            onFileTypeError: function (file) {
            },
            onFileExtError: function (file) {
            },
        });
    });

    $(document).on('click', '#btn_reset_upload', function () {
        $("#drag-and-drop-zone").dmUploader("reset");
        $("#files-file").empty();
        $(this).hide();
    });
</script>

@endpush