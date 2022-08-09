@extends('layouts.admin.app')

@section('main')
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col">
                <x-bootstrap.card>
                    <x-slot name="title">
                        <div>Add Staff</div>
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
                        <form action="{{route('admin.staff.store')}}" method="post">
                            @csrf
                            {{-- name --}}
                            <div class="col-12 mt-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Name" required>
                            </div>
                            {{-- email --}}
                            <div class="col-12 mt-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                            </div>
                            {{-- password --}}
                            <div class="col-12 mt-3">
                                <label for="password" class="form-label mb-0">Password</label><br>
                                <small class="text-success">Default (123)</small>
                            </div>
                            {{-- role --}}
                            <div class="col-12 mt-3">
                                <label class="form-label">Role</label>
                                <select name="role_id" class="form-select" required>
                                    <option value="" selected>Select</option>
                                    @if (isset($roles))
                                        @foreach ($roles as $list)
                                            <option value="{{$list->id}}">
                                                {{ucwords($list->name)}}
                                            </option>       
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            {{-- publish --}}
                            <div class="col-12 mt-3 d-flex justify-content-end">
                                <button type="submit" name="submit" class="btn btn-primary btn-sm">Add Staff</button>
                            </div>
                        </form>
                    </x-slot>
                </x-bootstrap.card>
            </div>
        </div>
    </div>
</div>

@endsection