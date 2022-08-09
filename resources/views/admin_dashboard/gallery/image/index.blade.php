@extends('layouts.admin.app')

@section('main')
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col">
                <x-bootstrap.card>
                    <x-slot name="title">
                        <div>Gallery Images</div>
                    </x-slot>
                    <x-slot name="controls">
                        <a href="{{ route('admin.gallery.image.create') }}" role="button" class="btn btn-primary btn-sm d-flex align-items-center">
                            <i class='bx bx-plus bx-xs me-1 pb-1 fw-bold'></i>
                            Add Image
                        </a>
                    </x-slot>
                    <x-slot name="content">
                        <hr>
                        <div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th class="text-center">Id</th>
										<th class="text-center">Image</th>
										<th class="text-nowrap">Description</th>
										<th class="text-nowrap">Album Name</th>
										<th class="text-nowrap">Category Name</th>
										<th class="text-nowrap">Date Added</th>
										<th class="text-center text-nowrap">Options</th>
									</tr>
								</thead>
								<tbody>
                                    @foreach ($galleryImages as $list)
                                        <tr>
                                            <td>{{$list->id}}</td>
                                            <td>
                                                <img src="{{asset('storage/media/images/image_gallery/'.$list->image)}}" alt="{{$list->image}}" width="140px" height="120px" style="object-fit: contain">
                                            </td>
                                            <td>{{ucwords($list->description)}}</td>
                                            <td>{{ucwords($list->category->album->name)}}</td>
                                            <td>{{ucwords($list->category->name)}}</td>
                                            <td><small>{{$list->created_at}}</small></td>
                                            <td class="dropdown text-center">
                                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Select an option
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="{{route('admin.gallery.image.edit', $list->id)}}">
                                                            <i class='bx bxs-edit bx-xs me-2'></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" onclick="deleteConfirm(event)" href="javascript:void(0)">
                                                            <form action="{{route('admin.gallery.image.delete', $list->id)}}" method="get" class="d-none"></form>
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
						</div>
                    </x-slot>
                </x-bootstrap.card>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>

        $(document).ready(function() {
			var table = $('#example').DataTable( {
				lengthChange: true,
				buttons: [{"extend":'excel', 'className':'btn btn-sm', 'text':'<i class="bx bx-spreadsheet pb-1"></i> Excel'}, {'extend':'pdf', 'text':'<i class="bx bxl-adobe pb-1"></i> Pdf', 'className':'btn btn-sm'}, {'extend':'print', 'text':'<i class="bx bx-printer pb-1"></i> Print', 'className':'btn btn-sm'}]
			} );
		 
			table.buttons().container()
			.appendTo( '.table-controls' );
		});
                
    </script>
@endpush