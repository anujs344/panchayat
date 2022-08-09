@extends('layouts.admin.app')

@section('main')
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col-12 col-xl-8">
                <x-bootstrap.card>
                    <x-slot name="title">
                        <div>Bulk Post Upload</div>
                    </x-slot>
                    <x-slot name="subTitle">
                        <small>You can add your posts with a CSV or EXCEL file from this section</small>
                    </x-slot>
                    <x-slot name="controls">
                        <a href="{{ route('admin.post.view') }}" role="button" class="btn btn-primary btn-sm d-flex align-items-center">
                            <i class='bx bx-menu me-1'></i>
                            Posts
                        </a>
                    </x-slot>
                    <x-slot name="content">
                        {{-- validation --}}
                        <x-jet-validation-errors class="mb-2 mt-2 text-danger" />
                        <div class="mt-3 mb-2 fw-bold">Upload CSV / EXCEL File</div>
                        {{-- post bulk --}}
                        <div class="dm-uploader-container">
                            <div id="drag-and-drop-zone" class="dm-uploader dm-uploader-csv text-center">
                                <p class="dm-upload-icon">
                                    <i class="bx bx-cloud-upload"></i>
                                </p>
                                <p class="dm-upload-text">Drag and drop files here or</p>
                                <p class="text-center">
                                    <button class="btn btn-outline-secondary btn-sm btn-browse-files">Browse Files</button>
                                </p>
    
                                <a class='btn btn-md dm-btn-select-files'>
                                    <input type="file" name="file" size="40" multiple="multiple">
                                </a>
                                <ul class="dm-uploaded-files" id="files-file"></ul>
                                <button type="button" id="btn_reset_upload" class="btn btn-reset-upload">Reset</button>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="row">
                                <div id="csv_upload_spinner" class="csv-upload-spinner">
                                    <strong class="text-csv-importing">Importing posts...</strong>
                                    <strong class="text-csv-import-completed">Completed!</strong>
                                    <div class="spinner">
                                        <div class="bounce1"></div>
                                        <div class="bounce2"></div>
                                        <div class="bounce3"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="csv-uploaded-files-container">
                                    <ul id="csv_uploaded_files" class="list-group csv-uploaded-files"></ul>
                                </div>
                            </div>
                        </div>
                    </x-slot>
                </x-bootstrap.card>
            </div>
            {{-- Help Documents --}}
            <div class="col-12 col-xl-4">
                <x-bootstrap.card>
                    <x-slot name="title">
                        <div>Help Documents</div>
                    </x-slot>
                    <x-slot name="subTitle">
                        <small>You can use these documents to generate your CSV file</small>
                    </x-slot>
                    <x-slot name="content">
                        <div class="form-group mt-3">
                            <button type="button" class="btn btn-primary btn-sm w-100 my-2" data-bs-toggle="modal" data-bs-target="#modalCategoryIds">
                                Category Ids list
                            </button>
                            <form action="{{route('admin.post.downloadTemplate')}}" method="get">
                                <button class="btn btn-success btn-sm w-100 my-2" name="submit" value="csv_template">
                                    Download Excel Template
                                </button>
                            </form>
                            <form action="{{route('admin.post.downloadExample')}}" method="get">
                                <button class="btn btn-success btn-sm w-100 my-2" name="submit" value="csv_example">
                                    Download Excel Example
                                </button>
                            </form>
                            <button type="button" class="btn btn-info btn-sm w-100 my-2" data-bs-toggle="modal" data-bs-target="#modalDocumentation">
                                Documentation
                            </button>
                        </div>
                    </x-slot>
                </x-bootstrap.card>
            </div>
        </div>
    </div>
</div>

{{-- modal --}}
<div id="modalCategoryIds" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Category / Subcategory Id list</h5>
                <button type="button" class="btn-close col-2 col-sm-4 col-xl-5 order-sm-3" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @forelse ($categories as $list)
                    <p>{{ucwords($list->name)}}: Id = {{$list->id}}</p>
                    @if (count($list->child) > 0)
                    @foreach ($list->child as $child)
                    <p style="padding-left: 30px;">{{ucwords($child->name)}}: Id = {{$child->id}}</p>
                    @endforeach
                    @endif
                @empty
                    <p>No category available...</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<div id="modalDocumentation" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: 0;">
                <h5 class="modal-title">Bulk Post Upload</h5>
                <button type="button" class="btn-close col-2 col-sm-4 col-xl-5 order-sm-3" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered w-100">
                    <tr>
                        <th>Field</th>
                        <th>Description</th>
                    </tr>
                    {{-- <tr>
                        <td style="width: 180px;">lang_id</td>
                        <td>Data Type: Integer <br><strong>Required</strong> <br><span style="color: #777;">Example: 1</span></td>
                    </tr> --}}
                    <tr>
                        <td style="width: 180px;">title</td>
                        <td>Data Type: String <br><strong>Required</strong><br><span style="color: #777;">Example: Test title</span></td>
                    </tr>
                    <tr>
                        <td style="width: 180px;">subtitle</td>
                        <td>Data Type: String <br><strong>Optional</strong><br><span style="color: #777;">Example: Test subtitle</span></td>
                    </tr>
                    <tr>
                        <td style="width: 180px;">slug</td>
                        <td>Data Type: String <br><strong>Optional</strong> <small>(If you leave it blank, it will be generated automatically. Must be unique and in english)</small> <br> <span style="color: #777;">Example: test-title</span></td>
                    </tr>
                    <tr>
                        <td style="width: 180px;">description</td>
                        <td>Data Type: String <br><strong>Optional</strong><br> <span style="color: #777;">Example: This is description</span></td>
                    </tr>
                    <tr>
                        <td style="width: 180px;">keywords</td>
                        <td>Data Type: String <br><strong>Optional</strong> <br> <span style="color: #777;">Example: test, post</span></td>
                    </tr>
                    <tr>
                        <td style="width: 180px;">tags</td>
                        <td>Data Type: String <br><strong>Optional</strong> <br> <span style="color: #777;">Example: test, post</span></td>
                    </tr>
                    <tr>
                        <td style="width: 180px;">author</td>
                        <td>Data Type: String <br><strong>Required</strong> <br> <span style="color: #777;">Example: rahul</span></td>
                    </tr>
                    <tr>
                        <td style="width: 180px;">content</td>
                        <td>Data Type: String <br><strong>Required</strong><br> <span style="color: #777;">Example: This is content</span></td>
                    </tr>
                    <tr>
                        <td style="width: 180px;">category_id</td>
                        <td>Data Type: Integer <br><strong>Required</strong><br> <span style="color: #777;">Example: 2</span></td>
                    </tr>
                    <tr>
                        <td style="width: 180px;">post_type</td>
                        <td>Data Type: String <br><strong>Required</strong><br><span style="color: #333;"><b>article</b> or <b>video</b><b>audio</b></span></td>
                    </tr>
                    <tr>
                        <td style="width: 180px;">video_embed_url</td>
                        <td>Data Type: String<br><strong>Optional</strong> <br> <span style="color: #777;">Example: https://www.youtube.com/embed/V9ypxcc0TpI</span></td>
                    </tr>
                    <tr>
                        <td style="width: 180px;">status</td>
                        <td>Data Type: Boolean, Default: 0 <br><strong>Optional</strong><br> <span style="color: #333;"><b>1</b> or <b>0</b></span></td>
                    </tr>
                    <tr>
                        <td style="width: 180px;">image_url</td>
                        <td>Data Type: String <br><strong>Optional</strong><br> <span style="color: #777;">Example: https://upload.wikimedia.org/wikipedia/commons/7/70/Labrador-sea-paamiut.jpg</span></td>
                    </tr>
                    <tr>
                        <td style="width: 180px;">image_description</td>
                        <td>Data Type: String <br><strong>Optional</strong><br> <span style="color: #777;">Example: Labrador sea</span></td>
                    </tr>
                    <tr>
                        <td style="width: 180px;">location</td>
                        <td>Data Type: String <br><strong>Required</strong><br> <span style="color: #777;">Example: delhi</span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
    $(function () {
        $('#drag-and-drop-zone').dmUploader({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('admin.post.bulkPostUpload')}}",
            multiple: true,
            extFilter: ["csv","xlsx"],
            extraData: function (id) {},
            onDragEnter: function () {
                this.addClass('active');
            },
            onDragLeave: function () {
                this.removeClass('active');
            },
            onNewFile: function (id, file) {
                $("#csv_upload_spinner").show();
                $("#csv_upload_spinner .spinner").show();
                $("#csv_upload_spinner .text-csv-importing").show();
                $("#csv_upload_spinner .text-csv-import-completed").hide();
                $("#csv_uploaded_files").empty();
            },
            onUploadSuccess: function (id, response) {
                var obj_sub = response;
                if (obj_sub.result == 1) {
                    $("#csv_upload_spinner .text-csv-importing").hide();
                    $("#csv_upload_spinner .spinner").hide();
                        
                    $("#csv_uploaded_files").prepend('<li class="list-group-item list-group-item-success d-flex align-items-center"><i class="bx bxs-check-circle bx-sm bx-flashing"></i>&nbsp;<span class="fw-bold ms-2">' + obj_sub.title + '</span></li>');

                    $("#csv_upload_spinner .text-csv-import-completed").css('display', 'block');
                } else {
                    $("#csv_upload_spinner").hide();
                    $("#csv_uploaded_files").prepend('<li class="list-group-item list-group-item-danger d-flex align-items-center"><i class="bx bxs-error-circle bx-sm bx-flashing"></i>&nbsp;<span class="fw-bold ms-2">' + obj_sub.title + '</span></li>');
                }
            },
            onUploadError:function(id, xhr, status, message){
                $("#csv_upload_spinner").hide();
                $("#csv_uploaded_files").prepend('<li class="list-group-item list-group-item-danger d-flex align-items-center"><i class="bx bxs-error-circle bx-sm bx-flashing"></i>&nbsp;<span class="fw-bold ms-2">' + status + ': ' + '</span><span>'+message+'</span></li>');
            }
        });
    });

    // function add_csv_item(number_of_items, txt_file_name, index) {
    //     if (index <= number_of_items) {
    //         var data = {
    //             "txt_file_name": txt_file_name,
    //             "index": index
    //         };
    //         $.ajax({
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             },
    //             type: "POST",
    //             url: base_url + "post_controller/import_csv_item_post",
    //             data: data,
    //             success: function (response) {
    //                 var obj_sub = JSON.parse(response);
    //                 if (obj_sub.result == 1) {
    //                     $("#csv_uploaded_files").prepend('<li class="list-group-item list-group-item-success"><i class="fa fa-check"></i>&nbsp;' + obj_sub.index + '.&nbsp;' + obj_sub.title + '</li>');
    //                 } else {
    //                     $("#csv_uploaded_files").prepend('<li class="list-group-item list-group-item-danger"><i class="fa fa-times"></i>&nbsp;' + obj_sub.index + '.</li>');
    //                 }
    //                 if (obj_sub.index == number_of_items) {
    //                     $("#csv_upload_spinner .text-csv-importing").hide();
    //                     $("#csv_upload_spinner .spinner").hide();
    //                     $("#csv_upload_spinner .text-csv-import-completed").css('display', 'block');
    //                 }
    //                 index = index + 1;
    //                 add_csv_item(number_of_items, txt_file_name, index);
    //             }
    //         });
    //     }
    // }
</script>
@endpush