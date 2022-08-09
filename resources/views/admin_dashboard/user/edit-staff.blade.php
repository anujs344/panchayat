@extends('layouts.admin.app')

@section('main')
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col">
                <x-bootstrap.card>
                    <x-slot name="title">
                        <div>Edit Staff</div>
                    </x-slot>
                    <x-slot name="controls">
                        <a href="{{ route('admin.staff.view') }}" role="button" class="btn btn-primary btn-sm d-flex align-items-center">
                            <i class='bx bx-images me-1'></i>
                            Staffs
                        </a>
                    </x-slot>
                    <x-slot name="content">
                        {{-- validation --}}
                        <x-jet-validation-errors class="mb-2 text-danger" />
                        <form action="{{route('admin.staff.update', [$admin->id])}}" method="post">
                            @csrf
                            {{-- name --}}
                            <div class="col-12 mt-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ucwords($admin->name)}}" required>
                            </div>
                            {{-- email --}}
                            <div class="col-12 mt-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Email" value="{{$admin->email}}" required>
                            </div>
                            {{-- role --}}
                            <div class="col-12 mt-3">
                                <label class="form-label">Role</label>
                                <select name="role_id" class="form-select" required>
                                    <option value="" selected>Select</option>
                                    @if (isset($roles))
                                        @foreach ($roles as $list)
                                            <option value="{{$list->id}}"
                                            @if ($list->id == $admin->role_id)
                                                {{'selected'}}
                                            @endif    
                                            >
                                                {{ucwords($list->name)}}
                                            </option>       
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            {{-- publish --}}
                            <div class="col-12 mt-3 d-flex justify-content-end">
                                <button type="submit" name="submit" class="btn btn-primary btn-sm">Update</button>
                            </div>
                        </form>
                    </x-slot>
                </x-bootstrap.card>
            </div>
        </div>
    </div>
</div>

@endsection