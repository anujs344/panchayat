@extends('layouts.admin.app')

@section('main')
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            {{-- categories list --}}
            <div class="col-12">
                <x-bootstrap.card>
                    <x-slot name="title">
                        <div>Recommended Posts</div>
                    </x-slot>
                    <x-slot name="controls">
                        <div class="table-controls"></div>
                    </x-slot>
                    <x-slot name="content">
                    <hr>
                        <div id="wrapp" class="row my-3"></div>
                        <table id="example" class="table table-hover table-sm" style="width:100%">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" onclick="checkAll(this)" class="form-check-input" id="checkall"></th>
                                    <th class="text-center">Id</th>
                                    <th class="text-nowrap">Post</th>
                                    <th class="text-nowrap">Post Type</th>
                                    <th class="text-nowrap">Category</th>
                                    <th class="text-nowrap">Author</th>
                                    <th class="text-nowrap">Page Views</th>
                                    <th class="text-nowrap">Added Date</th>
                                    <th class="d-print-none text-center">Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $list)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="checkbox[]" class="checkbox" value="{{$list->id}}" onclick="check(this);" form="form1">
                                        </td>
                                        <td class="text-center border-end"><span>{{$list->id}}</span></td>
                                        <td class="border-end">
                                            <div class="d-flex">
                                                <img src="{{$list->post_image_gallery_id ? asset('storage/media/images/post_image_gallery/'.$list->mainImage->image) : $list->opt_image_url}}" alt="{{$list->title}}" style="width: 120px;height:120px;object-fit:contain">
                                                <div class="d-flex flex-column mx-2">
                                                    <a href="" class="mb-3 fw-bold text-dark small">{{strtoupper($list->title)}}</a>
                                                    <div class="d-flex">
                                                        {!! $list->slider == 1 ? '<small class="bg-danger text-white me-1 px-2 radius-30">Slider</small>' : '' !!}
                                                        {!! $list->featured == 1 ? '<small class="bg-success text-white me-1 px-2 radius-30">Featured</small>' : '' !!}
                                                        {!! $list->breaking == 1 ? '<small class="bg-dark text-white me-1 px-2 radius-30">Breaking</small>' : '' !!}
                                                        {!! $list->recommended == 1 ? '<small class="bg-info text-white me-1 px-2 radius-30">Recommended</small>' : '' !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="border-end"><span class="small">{{ucwords($list->post_type)}}</span></td>
                                        <td class="border-end"><small class="text-nowrap px-2">{{ucwords($list->category->name)}}</small>
                                        </td>
                                        <td class="fw-bold small border-end">{{ucwords($list->author)}}</td>
                                        <td class="text-center border-end">{{$list->view_counts}}</td>
                                        <td class="border-end"><small>{{$list->created_at}}</small></td>
                                        <td class="dropdown d-print-none text-center">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Select an option
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="{{route('admin.post.edit', [$list->id, 'post_type'=>$list->post_type])}}">
                                                        <i class='bx bxs-edit bx-xs me-2'></i>
                                                        Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)" onclick="deleteConfirm(event)" class="dropdown-item" >
                                                        <form action="{{route('admin.post.delete', [$list->id])}}" method="get" class="d-none"></form>
                                                        <i class='bx bxs-trash bx-xs me-2'></i>
                                                        Delete
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- Delete post or add / remove post from post type --}}
                        <div class="bulk-options my-3">
                            <button class="btn btn-sm btn-danger btn-table-delete" onclick="deleteConfirm(event);">
                                <form action="{{route('admin.post.deleteSelectedPosts')}}" method="post" class="d-none" id="form1">
                                    @csrf
                                </form>
                                <i class="bx bx-trash bx-xs pb-1 option-icon"></i>
                                Delete
                            </button>
                            {{-- <button class="btn btn-sm btn-default btn-table-delete" onclick="post_bulk_options('add_slider');">
                                <i class="bx bx-plus bx-xs pb-1 option-icon"></i>
                                Add to Slider
                            </button>
                            <button class="btn btn-sm btn-default btn-table-delete" onclick="post_bulk_options('add_featured');">
                                <i class="bx bx-plus bx-xs pb-1 option-icon"></i>
                                Add to Featured
                            </button>
                            <button class="btn btn-sm btn-default btn-table-delete" onclick="post_bulk_options('add_breaking');">
                                <i class="bx bx-plus bx-xs pb-1 option-icon"></i>
                                Add to Breaking
                            </button>
                            <button class="btn btn-sm btn-default btn-table-delete" onclick="post_bulk_options('add_recommended');">
                                <i class="bx bx-plus bx-xs pb-1 option-icon"></i>
                                Add to Recommended
                            </button>
                            <button class="btn btn-sm btn-default btn-table-delete" onclick="post_bulk_options('remove_slider');">
                                <i class="bx bx-minus bx-xs pb-1 option-icon"></i>
                                Remove from Slider
                            </button>
                            <button class="btn btn-sm btn-default btn-table-delete" onclick="post_bulk_options('remove_featured');">
                                <i class="bx bx-minus bx-xs pb-1 option-icon"></i>
                                Remove from Featured
                            </button>
                            <button class="btn btn-sm btn-default btn-table-delete" onclick="post_bulk_options('remove_breaking');">
                                <i class="bx bx-minus bx-xs pb-1 option-icon"></i>
                                Remove from Breaking
                            </button>
                            <button class="btn btn-sm btn-default btn-table-delete" onclick="post_bulk_options('remove_recommended');">
                                <i class="bx bx-minus bx-xs pb-1 option-icon"></i>
                                Remove from Recommended
                            </button> --}}
                        </div>
                    </x-slot>
                </x-bootstrap.card>
            </div>
        </div>
    
    </div>
</div>
<!--end page wrapper -->
@endsection

@push('js')
    <script>
        $(document).ready(function() {
			var table = $('#example').DataTable({
                "scrollX": true,
                "processing": true,
				lengthChange: true,
                // "dom": '<"#shown"lf>',
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
				buttons: [{"extend":'excel', 'className':'btn btn-sm', 'text':'<i class="bx bx-spreadsheet pb-1"></i> Excel'}, {'extend':'pdf', 'text':'<i class="bx bxl-adobe pb-1"></i> Pdf', 'className':'btn btn-sm'}, {'extend':'print', 'text':'<i class="bx bx-printer pb-1"></i> Print', 'className':'btn btn-sm'}],

                initComplete: function () {
                    this.api().columns([1,3,4,5]).every( function (d) {
                        var column = this;
                        var theadname = $("#example th").eq([d]).text();
                        var select = $(
                            '<select class="form-select form-select-sm col mx-2" aria-label=".form-select-sm example"><option value="">' + theadname + ": All</option></select>"
                        );
                        select.appendTo('#wrapp')
                        .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());
                            column.search( val ? '^'+val+'$' : '', true, false ).draw();
                        });
                        column.cells('', column[0]).render('display').sort().unique().each( function ( d, j ) {
                            var val = $('<div/>').html(d).text();
                            if(column.search() === '^'+d+'$'){
                                select.append( '<option value="' + val + '" selected="selected">' + val + '</option>' );
                            } else {
                                select.append( '<option value="'+val+'">'+val+'</option>' );
                            }
                        });
                    });
                },
			});
		 
			table.buttons().container()
			.appendTo( '.table-controls' );
		});
            
    </script>
@endpush