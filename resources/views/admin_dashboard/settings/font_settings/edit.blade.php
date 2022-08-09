@extends('layouts.admin.app')

@section('main')

<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6">
                        <x-bootstrap.card>
                            <x-slot name="title">
                                <span>Add Font</span>
                            </x-slot>

                            <x-slot name="content">
                                <form action="{{ route('admin.settings.update.font', ['id'=>$font_settings->id]) }}" method="POST" class="row fw-bold">
                                    @csrf
                                    {{--  name --}}
                                    <div class="col-12 mt-3">
                                        <label class="form-label">
                                            Name
                                        </label>
                                        <input type="text" class="form-control" value="{{$font_settings->name}}" name="name"
                                            placeholder="Name" required>
                                        <small>(E.g: Open Sans)</small>

                                    </div>
                                    {{-- Short Form --}}
                                    <div class="col-12 mt-3">
                                        <label class="form-label">
                                            Short Form
                                        </label>
                                        <input type="text" class="form-control" value="{{$font_settings->short_form}}" name="short_form"
                                            placeholder="Short Form" required>
                                        <small>(Ex: en)</small>
                                    </div>
                                    {{-- Language Code --}}
                                    <div class="col-12 mt-3">
                                        <label class="form-label">
                                            URL
                                        </label>
                                        <input type="text" class="form-control" name="url" value="{{$font_settings->url}}"
                                            placeholder="URL" required>
                                        <small>(E.g: < link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">)</small>

                                    </div>
                                    {{-- Font Family --}}
                                    <div class="col-12 mt-3">
                                        <label class="form-label">
                                            Font Family
                                        </label>
                                        <input type="text" class="form-control" name="font_family" value="{{$font_settings->font_family}}"
                                            placeholder="Font Family" required>
                                        <small>(E.g: font-family: "Open Sans", Helvetica, sans-serif)</small>

                                    </div>

                                    <div class="col-3 mt-3 float-end">
                                        <input type="submit" class="btn btn-sm btn-primary" value="Add Font">
                                    </div>
                                </form>
                            </x-slot>
                        </x-bootstrap.card>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
