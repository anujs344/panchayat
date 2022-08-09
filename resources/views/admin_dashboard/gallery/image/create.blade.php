@extends('layouts.admin.app')

@section('main')
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col">
                <x-bootstrap.card>
                    <x-slot name="title">
                        <div>Add Image</div>
                    </x-slot>
                    <x-slot name="controls">
                        <a href="{{ route('admin.gallery.image.view') }}" role="button" class="btn btn-primary btn-sm d-flex align-items-center">
                            <i class='bx bx-images me-1'></i>
                            Images
                        </a>
                    </x-slot>
                    <x-slot name="content">
                        {{-- validation --}}
                        <x-jet-validation-errors class="mb-2 text-danger" />
                        <form action="{{route('admin.gallery.image.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            {{-- albums --}}
                            <div class="col-12 mt-3">
                                <label class="form-label">Album</label>
                                <select name="album_id" class="form-select" onchange="getCategory(this.value)" required >
                                    <option value="" selected>Select</option>
                                    @if (isset($galleryAlbums))
                                        @foreach ($galleryAlbums as $list)
                                            <option value="{{$list->id}}">
                                                {{ucwords($list->name)}}
                                            </option>       
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            {{-- category --}}
                            <div class="col-12 mt-3">
                                <label class="form-label">Category</label>
                                <select id="categories" name="category_id" class="form-select" required>
                                    <option value="" selected>Select</option>
                                </select>
                            </div>
                            {{-- description --}}
                            <div class="col-12 mt-3">
                                <label class="form-label">Image Description</label>
                                <input type="text" name="description" class="form-control" placeholder="Image Description" required>
                            </div>
                            {{-- images --}}
                            <div class="col-12 mt-3">
                                <label class="form-label">Select Image</label>
                                <input class="form-control" type="file" name="images[]" multiple>
                            </div>
                            {{-- publish --}}
                            <div class="col-12 mt-3 d-flex justify-content-end">
                                <button type="submit" name="submit" class="btn btn-primary btn-sm">Add Image</button>
                            </div>
                        </form>
                    </x-slot>
                </x-bootstrap.card>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
    <script>
        function getCategory(val) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url : "{{route('admin.gallery.image.getCategory')}}",
                type : 'post',
                data : {'albumId':val},
                success : function (response){
                    $('#categories').append(response);
                }
            });
        }
    </script>
@endpush