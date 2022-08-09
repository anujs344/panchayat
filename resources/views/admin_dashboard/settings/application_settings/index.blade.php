@extends('layouts.admin.app')

@section('main')
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <div class="row row-cols-1 row-cols-xl-2">
            {{-- validation --}}
            <x-jet-validation-errors class="mb-2 text-danger" />
            <div class="col d-flex">
                <x-bootstrap.card>
                    <x-slot name="title">
                        <span>Application Configuration</span>
                    </x-slot>
                    <x-slot name="content">
                        <form action="{{route('admin.settings.application.store')}}" method="POST">
                        @csrf
                        {{-- Application Name --}}
                        <div class="col-12 mt-3">
                            <label class="form-label">
                                Application Name
                            </label>
                            <input type="text" class="form-control" name="application_name" placeholder="Application Name" value="{{isset($applicationSetting) ? ucwords($applicationSetting->application_name) : null}}" required>
                        </div>
                        {{-- timezone --}}
                        <div class="col-12 mt-3">
                            <label class="form-label">Timezone</label>
                            <select name="timezone" class="form-select" style="font-size: 14px;">
                                {{-- <option value="">None</option> --}}
                                @foreach ($timezones as $list)
                                <option class="small" value="{{$list['name']}}"
                                @if (isset($applicationSetting) && $list['name'] == $applicationSetting->timezone)
                                    {{'selected'}}
                                @endif
                                >
                                    {{$list['name']}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        {{-- Cookie Prefix --}}
                        {{-- <div class="col-12 mt-3">
                            <label class="form-label">Cookie Prefix</label>
                            <input type="text" name="cookie_prefix" class="form-control" value="{{isset($applicationSetting) ? $applicationSetting->cookie_prefix : null}}" placeholder="604b01e40d216">
                        </div> --}}
                        {{-- publish --}}
                        <div class="col-12 mt-3 d-flex justify-content-end">
                            <button type="submit" name="submit" class="btn btn-primary btn-sm">Save Changes</button>
                        </div>
                    </form>
                    </x-slot>
                </x-bootstrap.card>
            </div>
            {{-- Maintenance Mode --}}
            <div class="col d-flex">
                <x-bootstrap.card>
                    <x-slot name="title">
                        <span>Maintenance Mode</span>
                    </x-slot>
                    <x-slot name="content">
                        <form action="{{route('admin.settings.application.MaintenanceMode.store')}}" method="POST">
                            @csrf
                            {{-- Title --}}
                            <div class="col-12 mt-3">
                                <label class="form-label">
                                    Title
                                </label>
                                <input type="text" class="form-control" name="title" value="{{isset($maintenanceMode) ? $maintenanceMode->title : null}}" placeholder="Comming Soon" required>
                            </div>
                            {{-- Description --}}
                            <div class="col-12 mt-3">
                                <label class="form-label">
                                    Description
                                </label>
                                <textarea name="description" id="" cols="30" class="form-control h-auto" placeholder="Description">{{isset($maintenanceMode) ? $maintenanceMode->description : null}}</textarea>
                            </div>
                            {{-- Status --}}
                            <div class="col-12 mt-3">
                                <div class="row">
                                    <div class="col-sm-12 col-md-2 mb-sm-2">
                                        <label class="fw-bold">Status</label>
                                    </div>
                                    @if (isset($maintenanceMode))
                                        @if ($maintenanceMode->status == 1)
                                        <div class="col-sm-12 col-md-2 col-xl-3">
                                            <input type="radio" name="status" value="1" checked>
                                            <label class="cursor-pointer">Enable</label>
                                        </div>
                                        <div class="col-sm-12 col-md-2 col-xl-3">
                                            <input type="radio" name="status" value="0">
                                            <label class="cursor-pointer">Disable</label>
                                        </div>
                                        @else
                                        <div class="col-sm-12 col-md-2 col-xl-3">
                                            <input type="radio" name="status" value="1">
                                            <label class="cursor-pointer">Enable</label>
                                        </div>
                                        <div class="col-sm-12 col-md-2 col-xl-3">
                                            <input type="radio" name="status" value="0" checked>
                                            <label class="cursor-pointer">Disable</label>
                                        </div>
                                        @endif
                                    @else
                                    <div class="col-sm-12 col-md-2 col-xl-3">
                                        <input type="radio" name="status" value="1" checked>
                                        <label class="cursor-pointer">Enable</label>
                                    </div>
                                    <div class="col-sm-12 col-md-2 col-xl-3">
                                        <input type="radio" name="status" value="0">
                                        <label class="cursor-pointer">Disable</label>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            {{-- Image --}}
                            <div class="col-12 mt-3">
                                <label class="form-label">
                                    Image: assets/img/maintenance_bg.jpg
                                </label>
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