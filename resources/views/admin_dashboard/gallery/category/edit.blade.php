@extends('layouts.admin.app')

@section('main')
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col">
                <x-bootstrap.card>
                    <x-slot name="title">
                        <div>Update Category</div>
                    </x-slot>
                    <x-slot name="controls">
                        <a href="{{ route('admin.gallery.category.view') }}" role="button" class="btn btn-primary btn-sm d-flex align-items-center">
                            <i class='bx bx-images me-1'></i>
                            Categories
                        </a>
                    </x-slot>
                    <x-slot name="content">
                        {{-- validation --}}
                        <x-jet-validation-errors class="mb-2 text-danger" />
                        <form action="{{route('admin.gallery.category.update', [$galleryCategory->id])}}" method="post">
                            @csrf
                            {{-- title --}}
                            <div class="col-12 mt-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="name" class="form-control" placeholder="Title" value="{{ucwords($galleryCategory->name)}}" required>
                            </div>
                            {{-- albums --}}
                            <div class="col-12 mt-3">
                                <label class="form-label">Album</label>
                                <select name="album_id" class="form-select" required>
                                    @if (isset($galleryAlbums))
                                        @foreach ($galleryAlbums as $list)
                                            <option value="{{$list->id}}"
                                                @if ($list->id == $galleryCategory->gallery_album_id)
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