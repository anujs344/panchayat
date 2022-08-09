@extends('layouts.admin.app')

@section('main')

<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-5">
                        <x-bootstrap.card>
                            <x-slot name="title">
                                <span>Site Font</span>
                            </x-slot>

                            <x-slot name="content">
                                <form action="{{route('admin.settings.font.site')}}" method="POST">
                                    @csrf
                                    {{-- Language --}}
                                    {{-- <div class="col-12 mt-3">
                                        <label class="form-label">
                                            Language
                                        </label>
                                        <select name="language" id="" class="form-select">
                                            <option value="1">English</option>
                                        </select>
                                    </div> --}}
                                    {{-- Primary Font (Main) --}}
                                    <div class="col-12 mt-3">
                                        <label class="form-label">
                                            Primary Font (Main)
                                        </label>
                                        <select name="primary_font" id="" class="form-select">
                                            <option value="1" >Arial</option>
                                                    <option value="2" >Arvo</option>
                                                    <option value="3" >Averia Libre</option>
                                                    <option value="4" >Bitter</option>
                                                    <option value="5" >Cabin</option>
                                                    <option value="6" >Cherry Swash</option>
                                                    <option value="7" >Encode Sans</option>
                                                    <option value="8" >Helvetica</option>
                                                    <option value="9" >Hind</option>
                                                    <option value="10" >Josefin Sans</option>
                                                    <option value="11" >Kalam</option>
                                                    <option value="12" >Khula</option>
                                                    <option value="13" >Lato</option>
                                                    <option value="14" >Lora</option>
                                                    <option value="15" >Merriweather</option>
                                                    <option value="16" >Montserrat</option>
                                                    <option value="17" >Mukta</option>
                                                    <option value="18" >Nunito</option>
                                                    <option value="19" selected>Open Sans</option>
                                                    <option value="20" >Oswald</option>
                                                    <option value="21" >Oxygen</option>
                                                    <option value="22" >Poppins</option>
                                                    <option value="23" >PT Sans</option>
                                                    <option value="24" >Raleway</option>
                                                    <option value="25" >Roboto</option>
                                                    <option value="26" >Roboto Condensed</option>
                                                    <option value="27" >Roboto Slab</option>
                                                    <option value="28" >Rokkitt</option>
                                                    <option value="29" >Source Sans Pro</option>
                                                    <option value="30" >Titillium Web</option>
                                                    <option value="31" >Ubuntu</option>
                                                    <option value="32" >Verdana</option>
                                        </select>
                                    </div>
                                    {{-- Secondary Font (Titles) --}}
                                    <div class="col-12 mt-3">
                                        <label class="form-label">
                                            Secondary Font (Titles)
                                        </label>
                                        <select name="secondary_font" id="" class="form-select">
                                            <option value="1" >Arial</option>
                                            <option value="2" >Arvo</option>
                                            <option value="3" >Averia Libre</option>
                                            <option value="4" >Bitter</option>
                                            <option value="5" >Cabin</option>
                                            <option value="6" >Cherry Swash</option>
                                            <option value="7" >Encode Sans</option>
                                            <option value="8" >Helvetica</option>
                                            <option value="9" >Hind</option>
                                            <option value="10" >Josefin Sans</option>
                                            <option value="11" >Kalam</option>
                                            <option value="12" >Khula</option>
                                            <option value="13" >Lato</option>
                                            <option value="14" >Lora</option>
                                            <option value="15" >Merriweather</option>
                                            <option value="16" >Montserrat</option>
                                            <option value="17" >Mukta</option>
                                            <option value="18" >Nunito</option>
                                            <option value="19" >Open Sans</option>
                                            <option value="20" >Oswald</option>
                                            <option value="21" >Oxygen</option>
                                            <option value="22" >Poppins</option>
                                            <option value="23" >PT Sans</option>
                                            <option value="24" >Raleway</option>
                                            <option value="25" selected>Roboto</option>
                                            <option value="26" >Roboto Condensed</option>
                                            <option value="27" >Roboto Slab</option>
                                            <option value="28" >Rokkitt</option>
                                            <option value="29" >Source Sans Pro</option>
                                            <option value="30" >Titillium Web</option>
                                            <option value="31" >Ubuntu</option>
                                            <option value="32" >Verdana</option>
                                        </select>
                                    </div>
                                    {{-- Tertiary Font (Post & Page Text) --}}
                                    <div class="col-12 mt-3">
                                        <label class="form-label">
                                            Tertiary Font (Post & Page Text)
                                        </label>
                                        <select name="tertiary_font" id="" class="form-select">
                                            <option value="1" >Arial</option>
                                            <option value="2" >Arvo</option>
                                            <option value="3" >Averia Libre</option>
                                            <option value="4" >Bitter</option>
                                            <option value="5" >Cabin</option>
                                            <option value="6" >Cherry Swash</option>
                                            <option value="7" >Encode Sans</option>
                                            <option value="8" >Helvetica</option>
                                            <option value="9" >Hind</option>
                                            <option value="10" >Josefin Sans</option>
                                            <option value="11" >Kalam</option>
                                            <option value="12" >Khula</option>
                                            <option value="13" >Lato</option>
                                            <option value="14" >Lora</option>
                                            <option value="15" >Merriweather</option>
                                            <option value="16" >Montserrat</option>
                                            <option value="17" >Mukta</option>
                                            <option value="18" >Nunito</option>
                                            <option value="19" >Open Sans</option>
                                            <option value="20" >Oswald</option>
                                            <option value="21" >Oxygen</option>
                                            <option value="22" >Poppins</option>
                                            <option value="23" >PT Sans</option>
                                            <option value="24" >Raleway</option>
                                            <option value="25" >Roboto</option>
                                            <option value="26" >Roboto Condensed</option>
                                            <option value="27" >Roboto Slab</option>
                                            <option value="28" >Rokkitt</option>
                                            <option value="29" >Source Sans Pro</option>
                                            <option value="30" >Titillium Web</option>
                                            <option value="31" >Ubuntu</option>
                                            <option value="32" selected>Verdana</option>
                                        </select>
                                    </div>

                                    <div class="col-3 mt-4 ">
                                        <input type="submit" class="btn btn-sm btn-primary pull-right" value="Save Changes">
                                    </div>
                                </form>
                            </x-slot>
                        </x-bootstrap.card>

                        {{-- Add Font --}}

                        <x-bootstrap.card>
                            <x-slot name="title">
                                <span>Add Font</span>
                            </x-slot>

                            <x-slot name="content">
                                <form action="{{route('admin.settings.font.store')}}" method="POST">
                                    @csrf
                                    {{--  name --}}
                                    <div class="col-12 mt-3">
                                        <label class="form-label">
                                            Name
                                        </label>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Name" required>
                                        <small>(E.g: Open Sans)</small>

                                    </div>
                                    {{-- Short Form --}}
                                    <div class="col-12 mt-3">
                                        <label class="form-label">
                                            Short Form
                                        </label>
                                        <input type="text" class="form-control" name="short_form"
                                            placeholder="Short Form" required>
                                        <small>(Ex: en)</small>
                                    </div>
                                    {{-- Language Code --}}
                                    <div class="col-12 mt-3">
                                        <label class="form-label">
                                            URL
                                        </label>
                                        <input type="text" class="form-control" name="url"
                                            placeholder="URL" required>
                                        <small>(E.g: < link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">)</small>

                                    </div>
                                    {{-- Font Family --}}
                                    <div class="col-12 mt-3">
                                        <label class="form-label">
                                            Font Family
                                        </label>
                                        <input type="text" class="form-control" name="font_family"
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
                    {{-- Languages --}}
                    <div class="col-lg-7">

                        <x-bootstrap.card>
                            <x-slot name="title">
                                <span>Languages</span>
                            </x-slot>
                            <x-slot name="content">
                                <div style="overflow-x: ">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Font Family</th>
                                                <th>Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($font_settings as $fs)
                                            <tr>
                                                <td>{{$fs->id}}</td>
                                                <td>{{$fs->name}}</td>
                                                <td>{{$fs->font_family}}</td>
                                                <td class="dropdown">
                                                    <button class="btn btn-secondary btn-sm dropdown-toggle"
                                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Select an option
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item" href="{{route('admin.settings.font.edit',[$fs->id])}}">
                                                                <i class='bx bxs-edit bx-xs me-2'></i>
                                                                Edit
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <form action="{{route('admin.settings.font.delete',[$fs->id])}}" method="post" class="d-flex">
                                                                @method('delete')
                                                                @csrf
                                                                <i class='bx bxs-trash bx-xs me-0'></i>
                                                                <input type="submit" class="dropdown-item " value="Delete">
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                       @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </x-slot>
                        </x-bootstrap.card>

                    </div>
                    {{-- Languages --}}
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection

@push('js')
    <script>
        $(document).ready(function () {
            var table = $('#example').DataTable({
                lengthChange: true,
                // buttons: ['copy', 'excel', 'pdf', 'print']
            });

            table.buttons().container()
                .appendTo('#example_wrapper .col-md-6:eq(0)');
        });

    </script>
@endpush
