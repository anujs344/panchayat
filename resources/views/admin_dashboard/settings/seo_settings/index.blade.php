@extends('layouts.admin.app')

@section('main')
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col">
                {{-- seo tools --}}
                <x-bootstrap.card>
                    <x-slot name="title">
                        <span>SEO Tools</span>
                    </x-slot>
                    <x-slot name="content">
                        {{-- validation --}}
                        <x-jet-validation-errors class="mb-2 text-danger" />
                        <form action="{{route('admin.settings.seo.store')}}" method="POST">
                        @csrf
                        {{-- site title --}}
                        <div class="col-12 mt-3">
                            <label class="form-label">
                                Site Title
                            </label>
                            <input type="text" class="form-control" name="site_title" placeholder="Site Title" value="{{isset($seo) ? ucwords($seo->site_title) : null}}" required>
                        </div>
                        {{-- home title --}}
                        <div class="col-12 mt-3">
                            <label class="form-label">
                                Home Title
                            </label>
                            <input type="text" class="form-control" name="home_title" placeholder="Home Title" value="{{isset($seo) ? ucwords($seo->home_title) : null}}" required>
                        </div>
                        {{-- description --}}
                        <div class="col-12 mt-3">
                            <label class="form-label">
                                Description
                            </label>
                            <input type="text" class="form-control" name="description" placeholder="Description" value="{{isset($seo) ? ucwords($seo->description) : null}}" required>
                        </div>
                        {{-- keywords --}}
                        <div class="col-12 mt-3">
                            <label class="form-label">
                                Keywords
                            </label>
                            <textarea type="text" class="form-control h-auto" name="keywords" placeholder="Keywords" required>{{isset($seo) ? ucwords($seo->keywords) : null}}</textarea>
                        </div>
                        {{-- publish --}}
                        <div class="col-12 mt-3 d-flex justify-content-end">
                            <button type="submit" name="submit" class="btn btn-primary btn-sm">Save Changes</button>
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