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
                        <div>Staffs</div>
                    </x-slot>
                    <x-slot name="controls">
                        <a href="{{ route('admin.staff.create') }}" role="button" class="btn btn-primary btn-sm d-flex align-items-center">
                            <i class='bx bx-plus bx-xs me-1 pb-1 fw-bold'></i>
                            Add Staff
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
										<th class="text-nowrap">Name</th>
										<th class="text-nowrap">Email</th>
										<th class="text-nowrap">Role</th>
										<th class="text-nowrap text-center">Status</th>
										<th class="text-nowrap">Date Added</th>
										<th class="text-center text-nowrap">Options</th>
									</tr>
								</thead>
								<tbody>
                                    @foreach ($admins as $list)
                                        <tr>
                                            <td class="text-center">{{$list->id}}</td>
                                            <td class="text-center">
                                                <img src="{{ $list->profile_photo_path ? asset('storage/'.$list->profile_photo_path) : $list->profile_photo_url }}" alt="{{ $list->name }}" class="user-img">
                                            </td>
                                            <td class="text-nowrap">{{ucwords($list->name)}}</td>
                                            <td class="text-nowrap">{{$list->email}}</td>
                                            <td><small class="bg-info px-2 text-white radius-15">{{ucwords($list->role->name)}}</small></td>
                                            <td class="text-center">
                                                @if ($list->status == 1)
                                                <i class="bg-success px-2 text-white radius-15">Active</i>
                                                @else
                                                <i class="bg-danger px-2 text-white radius-15">Deactive</i>
                                                @endif
                                            </td>
                                            <td><small>{{$list->created_at}}</small></td>
                                            <td class="dropdown text-center">
                                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Select an option
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="{{route('admin.staff.edit', [$list->id])}}">
                                                            <i class='bx bxs-edit bx-xs me-2'></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" onclick="deleteConfirm(event)" href="javascript:void(0)">
                                                            <form action="{{route('admin.staff.delete', [$list->id])}}" method="get" class="d-none"></form>
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
			} );
		});
                
    </script>
@endpush