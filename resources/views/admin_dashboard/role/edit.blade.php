@extends('layouts.admin.app')

@section('main')
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col">
                <x-bootstrap.card>
                    <x-slot name="title">
                        <div>Edit Role</div>
                    </x-slot>
                    <x-slot name="controls">
                        <a href="{{ route('admin.role.view') }}" role="button" class="btn btn-primary btn-sm d-flex align-items-center">
                            <i class='bx bx-menu bx-xs me-1'></i>
                            Roles
                        </a>
                    </x-slot>
                    <x-slot name="content">
                        {{-- validation --}}
                        <x-jet-validation-errors class="mb-2 text-danger" />
                        <form action="{{route('admin.role.update', [$role->id])}}" method="post">
                            @csrf
                            {{-- name --}}
                            <div class="col-12 mt-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ucwords($role->name)}}" placeholder="Role Name ..." required>
                            </div>
                            {{-- permission --}}
                            <div class="col-12 mt-3">
                                <label class="form-label">Assign Permision</label>
                            </div>
                            <div class="col-12 mt-3 form-check">
                                <input type="checkbox" onclick="checkAll(this)" class="form-check-input" id="checkall">
                                <label class="form-check-label">All Permission</label>
                            </div>
                            @foreach ($permissions as $list)
                                <div class="col-12 mt-3 form-check">
                                    <input type="checkbox" name="permissions[]" value="{{$list->id}}" onclick="check(this);" class="form-check-input checkbox"
                                    @forelse ($role->permissions as $permission)
                                        @if ($permission->name == $list->name)
                                            {{'checked'}}
                                        @endif
                                    @empty
                                    @endforelse
                                    >
                                    <label class="form-check-label">{{$list->display_name}}</label>
                                </div>
                            @endforeach
                            {{-- publish --}}
                            <div class="col-12 mt-3 d-flex justify-content-end">
                                <button type="submit" name="submit" class="btn btn-primary btn-sm">Update Role</button>
                            </div>
                        </form>
                    </x-slot>
                </x-bootstrap.card>
            </div>
        </div>
    </div>
</div>

@endsection