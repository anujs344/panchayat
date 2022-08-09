@extends('layouts.admin.app')

@section('main')
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col">
                <x-bootstrap.card>
                    <x-slot name="title">
                        <div class="fw-bold">Update Pending Comments</div>
                    </x-slot>
                    <x-slot name="controls">
                        <a href="{{ route('admin.comment.pending') }}" role="button" class="btn btn-primary btn-sm d-flex align-items-center">
                            <i class='bx bx-menu me-1'></i>
                            Pending Comments
                        </a>
                    </x-slot>
                    <x-slot name="content">
                        {{-- validation --}}
                        <x-jet-validation-errors class="mb-2 text-danger" />
                        <form action="{{route('admin.comment.update', [$comment->id])}}" method="post">
                            @csrf
                            {{-- approved comment --}}
                            <div class="col-12 mt-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select" required>
                                    <option value="">Select</option>
                                    <option value="1">Approved</option>
                                </select>
                            </div>
                            {{-- publish --}}
                            <div class="col-12 mt-3 d-flex justify-content-end">
                                <button type="submit" name="submit" class="btn btn-primary btn-sm">Approved</button>
                            </div>
                        </form>
                    </x-slot>
                </x-bootstrap.card>
            </div>
        </div>
    </div>
</div>