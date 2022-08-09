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
                        <div>Subcategories</div>
                    </x-slot>
                    <x-slot name="controls">
                        <a href="{{ route('admin.subcategory.create') }}" role="button" class="btn btn-primary btn-sm d-flex align-items-center">
                            <i class='bx bx-plus bx-xs me-1 fw-bold'></i>
                            Add Subcategory
                        </a>
                    </x-slot>
                    <x-slot name="content">
                        <hr>
                        <div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th class="text-center">Id</th>
										<th>Name</th>
										<th>Parent Category</th>
										<th class="text-center">Options</th>
									</tr>
								</thead>
								<tbody>
                                    @foreach ($subcategories as $list)
                                        <tr>
                                            <td class="text-center">{{$list->id}}</td>
                                            <td>{{ucwords($list->name)}}</td>
                                            <td>{{ucwords($list->parent->name)}}</td>
                                            <td class="dropdown text-center">
                                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Select an option
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="{{route('admin.subcategory.edit', $list->id)}}">
                                                            <i class='bx bxs-edit bx-xs me-2'></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" onclick="deleteConfirm(event)" href="javascript:void(0)">
                                                            <form action="{{route('admin.subcategory.delete', $list->id)}}" method="get" class="d-none"></form>
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
			var table = $('#example').DataTable({
				lengthChange: true,
			});
		});
                
    </script>
@endpush