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
                        <div>Newsletters</div>
                    </x-slot>
                    <x-slot name="controls">
                        <a href="{{ route('admin.newsletter.create') }}" role="button" class="btn btn-primary btn-sm d-flex align-items-center">
                            <i class='bx bx-plus bx-xs me-1 pb-1 fw-bold'></i>
                            Add Newsletter
                        </a>
                    </x-slot>
                    <x-slot name="content">
                        <hr>
                        <div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th class="text-center">Id</th>
										<th>Title</th>
										<th class="text-center">Send Email</th>
										<th>Date Added</th>
										<th class="text-center">Options</th>
									</tr>
								</thead>
								<tbody>
                                    @foreach ($newsletters as $list)
                                        <tr>
                                            <td class="text-center">{{$list->id}}</td>
                                            <td>{{ucwords($list->title)}}</td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.newsletter.subscriber.sendNewsletter', [$list->id]) }}" role="button" class="btn btn-primary btn-sm">
                                                    <i class='bx bx-envelope bx-xs me-1 fw-bold'></i>
                                                    Send Email
                                                </a>
                                            </td>
                                            <td><small>{{$list->created_at}}</small></td>
                                            <td class="dropdown text-center">
                                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Select an option
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="{{route('admin.newsletter.show', $list->id)}}">
                                                            <i class='bx bxs-show bx-xs me-2'></i>
                                                            View
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="{{route('admin.newsletter.edit', $list->id)}}">
                                                            <i class='bx bxs-edit bx-xs me-2'></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" onclick="deleteConfirm(event)" href="javascript:void(0)">
                                                            <form action="{{route('admin.newsletter.delete', $list->id)}}" method="get" class="d-none"></form>
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
<!--end page wrapper -->
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