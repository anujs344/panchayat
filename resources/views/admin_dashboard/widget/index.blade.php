@extends('layouts.admin.app')

@section('main')
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col">
                <x-bootstrap.card>
                    <x-slot name="title">
                        <div>Widgets</div>
                    </x-slot>
                    <x-slot name="controls">
                        <a href="{{ route('admin.widget.create') }}" role="button" class="btn btn-primary btn-sm d-flex align-items-center">
                            <i class='bx bx-plus bx-xs me-1 pb-1 fw-bold'></i>
                            Add Widget
                        </a>
                    </x-slot>
                    <x-slot name="content">
                        <hr>
                        <div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th class="text-center">Id</th>
										<th class="text-nowrap">Title</th>
										<th class="text-nowrap text-center">Order</th>
										<th class="text-nowrap">Type</th>
										<th class="text-nowrap text-center">Visibility</th>
										<th class="text-nowrap">Date Added</th>
										<th class="text-center text-nowrap">Options</th>
									</tr>
								</thead>
								<tbody>
                                    @foreach ($widgets as $list)
                                        <tr>
                                            <td class="text-center">{{$list->id}}</td>
                                            <td>{{ucwords($list->title)}}</td>
                                            <td class="text-center">{{$list->widget_order}}</td>
                                            <td><small class="bg-info px-2 text-white radius-15">{{ucwords($list->type)}}</small></td>
                                            <td class="text-center">
                                                @if ($list->visibility == 1)
                                                <i class="bx bx-show text-white bg-success px-2 py-1 radius-10"></i>
                                                @else
                                                <i class="bx bx-hide text-white bg-success px-2 py-1 radius-10"></i>
                                                @endif
                                            </td>
                                            <td><small>{{$list->created_at}}</small></td>
                                            <td class="dropdown text-center">
                                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Select an option
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="{{route('admin.widget.edit', $list->id)}}">
                                                            <i class='bx bxs-edit bx-xs me-2'></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" onclick="deleteConfirm(event)" href="javascript:void(0)">
                                                            <form action="{{route('admin.widget.delete', $list->id)}}" method="get" class="d-none"></form>
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
@endsection

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