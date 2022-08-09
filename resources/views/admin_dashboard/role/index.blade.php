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
                        <div>Roles</div>
                    </x-slot>
                    <x-slot name="controls">
                        <a href="{{ route('admin.role.create') }}" role="button" class="btn btn-primary btn-sm d-flex align-items-center">
                            <i class='bx bx-plus me-1 fw-bold pb-1'></i>
                            Add Role
                        </a>
                    </x-slot>
                    <x-slot name="content">
                        <hr>
                        <div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th class="text-center">Id</th>
										<th class="text-center">Role</th>
										<th class="text-nowrap">Permissions</th>
										<th class="text-center text-nowrap">Options</th>
									</tr>
								</thead>
								<tbody>
                                    @foreach ($roles as $list)
                                        <tr>
                                            <td class="text-center">{{$list->id}}</td>
                                            <td class="text-nowrap">{{ucwords($list->name)}}</td>
                                            <td class="d-flex flex-wrap">
                                                @if ($list->name == 'admin')
                                                <small class="px-2 py-1 bg-success text-white radius-15">
                                                    All Permissions
                                                </small>
                                                @else
                                                    @forelse ($list->permissions as $permission)
                                                    <small class="px-2 py-1 me-1 mb-1 bg-secondary text-white radius-15">
                                                        {{$permission->display_name}}
                                                    </small>
                                                    @empty
                                                    <small class="px-2 py-1 bg-secondary text-white radius-15">
                                                        {{'No permission'}}
                                                    </small>
                                                    @endforelse
                                                @endif
                                            </td>
                                            <td class="dropdown text-center">
                                                @if ($list->id != 1 && $list->id != 2)
                                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Select an option
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="{{route('admin.role.edit', $list->id)}}">
                                                            <i class='bx bxs-edit bx-xs me-2'></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                </ul>
                                                @endif
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