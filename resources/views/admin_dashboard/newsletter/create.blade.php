@extends('layouts.admin.app')

@section('main')
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col">
                <x-bootstrap.card>
                    <x-slot name="title">
                        <div>Add Newsletter</div>
                    </x-slot>
                    <x-slot name="controls">
                        <a href="{{ route('admin.newsletter.view') }}" role="button" class="btn btn-primary btn-sm d-flex align-items-center">
                            <i class='bx bx-menu me-1'></i>
                            Newsletters
                        </a>
                    </x-slot>
                    <x-slot name="content">
                        {{-- validation --}}
                        <x-jet-validation-errors class="mb-2 text-danger" />
                        <form action="{{route('admin.newsletter.store')}}" method="post">
                            @csrf
                            {{-- title --}}
                            <div class="col-12 mt-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Title" required>
                            </div>
                            {{-- content --}}
                            <div id="main_editor" class="mt-3">
                                <div class="fw-bold mb-2">
                                    Content
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 editor-buttons">
                                        <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#file_manager_image" data-image-type="editor">
                                            <i class="bx bx-image"></i>
                                            Add Image
                                        </button>
                                    </div>
                                </div>
                                <textarea class="tinyMCE form-control" name="content"></textarea>
                            </div>
                            {{-- publish --}}
                            <div class="col-12 mt-3 d-flex justify-content-end">
                                <button type="submit" name="submit" value="1" class="btn btn-primary btn-sm">Add Newsletter</button>
                            </div>
                        </form>
                    </x-slot>
                </x-bootstrap.card>
            </div>
        </div>
    </div>
</div>

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

@endsection

@push('js')
{{-- configuration --}}
<script>
    var base_url = "{{url('admin') . '/'}}"
    var get_url = "{{route('admin.postImageGallery.view')}}";
    var delete_url = "{{url('admin/post-image-gallery/delete') . '/'}}";
    var txt_select_image = "Select Image";

    // tinymce
    if ($('textarea.tinyMCE').length > 0) {
        init_tinymce('textarea.tinyMCE', 500);
    }

    // hide delete & select model button
    $('#btn_img_delete').hide();
    $('#btn_img_select').hide();
    $('#btn_reset_upload_image').hide();
    $('#btn_reset_upload').hide();
    $('[data-bs-dismiss="modal"]').click(function (){
        $('#btn_img_delete').hide();
        $('#btn_img_select').hide();
        $('#btn_reset_upload_image').hide();
        $('#btn_reset_upload').hide();
    });

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
@endpush