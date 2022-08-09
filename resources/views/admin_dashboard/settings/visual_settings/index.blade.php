@extends('layouts.admin.app')

@section('main')
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <div class="row row-cols-1">
            <div class="col">
                <x-bootstrap.card>
                    <x-slot name="title">
                        <span>Visual Settings</span>
                    </x-slot>

                    <x-slot name="content">
                        {{-- validation --}}
                        <x-jet-validation-errors class="mb-2 text-danger" />
                        <form action="{{route('admin.settings.visual.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- Logo --}}
                        <div class="col-12 mt-3">
                            <label class="form-label mb-2">Logo</label>
                            @if (isset($visualSetting))
                            <div class="mb-2">
                                <img src="{{asset('storage/media/images/logo/' . $visualSetting->logo)}}" alt="logo" style="max-width: 250px; max-height: 250px;">
                            </div>
                            @endif
                            <div class="d-block">
                                <a class='btn btn-success btn-sm btn-file-upload'>
                                    Change logo
                                    <input type="file" name="logo" size="40" accept=".png, .jpg, .jpeg, .gif, .svg" onchange="$('#upload-file-info1').html($(this).val().replace(/.*[\/\\]/, ''));$('#upload-file-info1').show();">
                                </a>
                                (.png, .jpg, .jpeg, .gif, .svg)
                            </div>
                            <span class='logo-label logo-label-info' id="upload-file-info1" style="display: none"></span>
                        </div>
                        {{-- Logo footer --}}
                        <div class="col-12 mt-3">
                            <label class="form-label mb-2">Logo Footer</label>
                            @if (isset($visualSetting))
                            <div class="mb-2">
                                <img src="{{asset('storage/media/images/logo/' . $visualSetting->logo_footer)}}" alt="logo footer" style="max-width: 250px; max-height: 250px;">
                            </div>
                            @endif
                            <div class="d-block">
                                <a class='btn btn-success btn-sm btn-file-upload'>
                                    Change logo
                                    <input type="file" name="logo_footer" size="40" accept=".png, .jpg, .jpeg, .gif, .svg" onchange="$('#upload-file-info2').html($(this).val().replace(/.*[\/\\]/, ''));$('#upload-file-info2').show();">
                                </a>
                                (.png, .jpg, .jpeg, .gif, .svg)
                            </div>
                            <span class='logo-label logo-label-info' id="upload-file-info2" style="display: none"></span>
                        </div>
                        {{-- Logo email --}}
                        <div class="col-12 mt-3">
                            <label class="form-label mb-2">Logo Email</label>
                            @if (isset($visualSetting))
                            <div class="mb-2">
                                <img src="{{asset('storage/media/images/logo/' . $visualSetting->logo_email)}}" alt="logo email" style="max-width: 200px; max-height: 200px;">
                            </div>
                            @endif
                            <div class="d-block">
                                <a class='btn btn-success btn-sm btn-file-upload'>
                                    Change logo
                                    <input type="file" name="logo_email" size="40" accept=".png, .jpg, .jpeg" onchange="$('#upload-file-info3').html($(this).val().replace(/.*[\/\\]/, ''));$('#upload-file-info3').show();">
                                </a>
                                (.png, .jpg, .jpeg)
                            </div>
                            <span class='logo-label logo-label-info' id="upload-file-info3" style="display: none"></span>
                        </div>
                        {{-- favicon icon --}}
                        <div class="col-12 mt-3">
                            <label class="control-label mb-2">Favicon (16x16px)</label>
                            @if (isset($visualSetting))
                            <div class="mb-2">
                                <img src="{{asset('storage/media/images/logo/' . $visualSetting->favicon_icon)}}" alt="favicon icon" style="max-width: 100px; max-height: 100px;">
                            </div>
                            @endif
                            <div class="d-block">
                                <a class='btn btn-success btn-sm btn-file-upload'>
                                    Change logo
                                    <input type="file" name="favicon_icon" size="40" accept=".png" onchange="$('#upload-file-info4').html($(this).val().replace(/.*[\/\\]/, ''));$('#upload-file-info4').show();">
                                </a>
                                (.png)
                            </div>
                            <span class='logo-label logo-label-info' id="upload-file-info4" style="display: none"></span>
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