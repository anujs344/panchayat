@extends('layouts.admin.app')

@section('main')
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            {{-- add category --}}
            <div class="col-12 d-flex">
                <x-bootstrap.card>
                    <x-slot name="title">
                        <div class="fs-5 fw-bold text-dark">Add Category</div>
                    </x-slot>
                    <x-slot name="controls">
                        <a href="{{ route('admin.category.view') }}" role="button" class="btn btn-primary btn-sm d-flex align-items-center">
                            <i class='bx bx-folder-open me-1'></i>
                            Categories
                        </a>
                    </x-slot>
                    <x-slot name="content">
                        <hr>
                        {{-- validation --}}
                        <x-jet-validation-errors class="mb-2 text-danger" />
                        <form action="{{ route('admin.category.store') }}" method="POST" class="row fw-bold">
                            @csrf
                            {{-- name --}}
                            <div class="col-12 mt-3">
                                <label class="form-label">Category Name</label>
                                <input type="text" name="name" class="form-control" onkeyup="createSlug(this)" placeholder="Category Name" required>
                            </div>
                            {{-- slug --}}
                            <div class="col-12 mt-3">
                                <label class="form-label">Slug
                                    <small>
                                        (If you leave it blank, it will be generated automatically.)
                                    </small>
                                </label>
                                <input type="text" class="form-control" data-slug="slug" name="slug" placeholder="Slug">
                            </div>
                            {{-- description --}}
                            <div class="col-12 mt-3">
                                <label class="form-label">
                                    Description (Meta Tag)
                                </label>
                                <input type="text" class="form-control" name="description" placeholder="Description (Meta Tag)">
                            </div>
                            {{-- keywords --}}
                            <div class="col-12 mt-3">
                                <label class="form-label">
                                    Keywords (Meta Tag)
                                </label>
                                <input type="text" class="form-control" name="keywords" placeholder="Keywords (Meta Tag)">
                            </div>
                            {{-- menu order --}}
                            <div class="col-12 mt-3">
                                <label class="form-label">Menu Order</label>
                                <input type="number" name="menu_order" min="1" value="1" class="form-control">
                            </div>
                            {{-- show on menu --}}
                            <div class="col-12 mt-3">
                                <div class="row g-sm-2">
                                    <div class="col-xl-2 col-md-3 col-sm-12">
                                        <label class="fw-bold">Show on Menu</label>
                                    </div>
                                    <div class="col-xl-1 col-md-2 col-sm-12">
                                        <input type="radio" name="menu_status" value="1" class="polaris" checked>
                                        <label class="cursor-pointer">Yes</label>
                                    </div>
                                    <div class="col-xl-1 col-md-2 col-sm-12">
                                        <input type="radio" name="menu_status" class="polaris" value="0">
                                        <label class="cursor-pointer">No</label>
                                    </div>
                                </div>
                            </div>
                            {{-- show on homepage --}}
                            <div class="col-12 mt-3">
                                <div class="row g-sm-2">
                                    <div class="col-xl-2 col-md-3 col-sm-12">
                                        <label class="fw-bold">Show on Homepage</label>
                                    </div>
                                    <div class="col-xl-1 col-md-2 col-sm-12">
                                        <input type="radio" name="home_status" value="1" class="polaris" checked>
                                        <label class="cursor-pointer">Yes</label>
                                    </div>
                                    <div class="col-xl-1 col-md-2 col-sm-12">
                                        <input type="radio" name="home_status" class="polaris" value="0">
                                        <label class="cursor-pointer">No</label>
                                    </div>
                                </div>
                            </div>
                            {{-- show on footer --}}
                            <div class="col-12 mt-3">
                                <div class="row g-sm-2">
                                    <div class="col-xl-2 col-md-3 col-sm-12">
                                        <label class="fw-bold">Show on Footer</label>
                                    </div>
                                    <div class="col-xl-1 col-md-2 col-sm-12">
                                        <input type="radio" name="footer_status" value="1" class="polaris" checked>
                                        <label class="cursor-pointer">Yes</label>
                                    </div>
                                    <div class="col-xl-1 col-md-2 col-sm-12">
                                        <input type="radio" name="footer_status" class="polaris" value="0">
                                        <label class="cursor-pointer">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-4 d-flex justify-content-end">
                              <button type="submit" class="btn btn-primary btn-sm">Add Category</button>
                            </div>
                        </form>
                    </x-slot>
                </x-bootstrap.card>
            </div>
        </div>
    </div>
</div>
<!--end page wrapper -->
@endsection