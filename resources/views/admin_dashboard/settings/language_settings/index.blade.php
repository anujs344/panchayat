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
                                <span>Default Language</span>
                            </x-slot>

                            <x-slot name="content">
                                <form action="" method="POST" class="row fw-bold">
                                    @csrf
                                    {{-- Language --}}
                                    <div class="col-12 mt-3">
                                        <label class="form-label">
                                            Language
                                        </label>
                                        <select name="language" id="" class="form-select">
                                            <option value="">English</option>
                                        </select>
                                    </div>

                                    <div class="col-3 mt-4 ">
                                        <input type="submit" class="btn btn-sm btn-primary" value="Save Changes">
                                    </div>
                                </form>
                            </x-slot>
                        </x-bootstrap.card>

                        {{-- Language Settings --}}

                        <x-bootstrap.card>
                            <x-slot name="title">
                                <span>Add Language</span>
                            </x-slot>

                            <x-slot name="content">
                                <form action="{{ route('admin.settings.language.store')}}" method="POST" class="row fw-bold">
                                    @csrf
                                    {{-- Language name --}}
                                    <div class="col-12 mt-3">
                                        <label class="form-label">
                                            Language Name
                                        </label>
                                        <input type="text" class="form-control" name="language_name"
                                            placeholder="Language Name" required>
                                        <small>(Ex: English)</small>

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
                                            Language Code
                                        </label>
                                        <input type="text" class="form-control" name="language_code"
                                            placeholder="Language Code" required>
                                        <small>(Ex: en_us)</small>

                                    </div>
                                    {{-- Menu Order --}}
                                    <div class="col-12 mt-3">
                                        <label class="form-label">
                                            Menu Order
                                        </label>
                                        <input type="number" class="form-control" value="1" min="1" name="menu_order"
                                            required>
                                    </div>
                                    {{-- Text Editor Language --}}
                                    <div class="col-12 mt-3">
                                        <label class="form-label">
                                            Text Editor Language
                                        </label>
                                        <select name="text_editor_language" id="" class="form-select">
                                            <option value="ar">Arabic</option>
                                            <option value="hy">Armenian</option>
                                            <option value="az">Azerbaijani</option>
                                            <option value="eu">Basque</option>
                                            <option value="be">Belarusian</option>
                                            <option value="bn_BD">Bengali (Bangladesh)</option>
                                            <option value="bs">Bosnian</option>
                                            <option value="bg_BG">Bulgarian</option>
                                            <option value="ca">Catalan</option>
                                            <option value="zh_CN">Chinese (China)</option>
                                            <option value="zh_TW">Chinese (Taiwan)</option>
                                            <option value="hr">Croatian</option>
                                            <option value="cs">Czech</option>
                                            <option value="da">Danish</option>
                                            <option value="dv">Divehi</option>
                                            <option value="nl">Dutch</option>
                                            <option value="en">English</option>
                                            <option value="et">Estonian</option>
                                            <option value="fo">Faroese</option>
                                            <option value="fi">Finnish</option>
                                            <option value="fr_FR">French</option>
                                            <option value="gd">Gaelic, Scottish</option>
                                            <option value="gl">Galician</option>
                                            <option value="ka_GE">Georgian</option>
                                            <option value="de">German</option>
                                            <option value="el">Greek</option>
                                            <option value="he">Hebrew</option>
                                            <option value="hi_IN">Hindi</option>
                                            <option value="hu_HU">Hungarian</option>
                                            <option value="is_IS">Icelandic</option>
                                            <option value="id">Indonesian</option>
                                            <option value="it">Italian</option>
                                            <option value="ja">Japanese</option>
                                            <option value="kab">Kabyle</option>
                                            <option value="kk">Kazakh</option>
                                            <option value="km_KH">Khmer</option>
                                            <option value="ko_KR">Korean</option>
                                            <option value="ku">Kurdish</option>
                                            <option value="lv">Latvian</option>
                                            <option value="lt">Lithuanian</option>
                                            <option value="lb">Luxembourgish</option>
                                            <option value="ml">Malayalam</option>
                                            <option value="mn">Mongolian</option>
                                            <option value="nb_NO">Norwegian Bokmål (Norway)</option>
                                            <option value="fa">Persian</option>
                                            <option value="pl">Polish</option>
                                            <option value="pt_BR">Portuguese (Brazil)</option>
                                            <option value="pt_PT">Portuguese (Portugal)</option>
                                            <option value="ro">Romanian</option>
                                            <option value="ru">Russian</option>
                                            <option value="sr">Serbian</option>
                                            <option value="si_LK">Sinhala (Sri Lanka)</option>
                                            <option value="sk">Slovak</option>
                                            <option value="sl_SI">Slovenian (Slovenia)</option>
                                            <option value="es">Spanish</option>
                                            <option value="es_MX">Spanish (Mexico)</option>
                                            <option value="sv_SE">Swedish (Sweden)</option>
                                            <option value="tg">Tajik</option>
                                            <option value="ta">Tamil</option>
                                            <option value="tt">Tatar</option>
                                            <option value="th_TH">Thai</option>
                                            <option value="tr">Turkish</option>
                                            <option value="ug">Uighur</option>
                                            <option value="uk">Ukrainian</option>
                                            <option value="vi">Vietnamese</option>
                                            <option value="cy">Welsh</option>
                                        </select>
                                    </div>

                                    {{-- Text Direction --}}
                                    <div class="col-12 mt-3">
                                        <div class="row g-sm-2">
                                            <div class="col-md-4 col-sm-12">
                                                <label class="fw-bold">Text Direction</label>
                                            </div>
                                            <div class="col-lg-2 col-md-4 col-sm-12">
                                                <input type="radio" name="text_direction" value="ltr" checked>
                                                <label class="cursor-pointer">Left to Right</label>
                                            </div>
                                            <div class="col-lg-2 col-md-4 col-sm-12">
                                                <input type="radio" name="text_direction" value="rtl">
                                                <label class="cursor-pointer">Right to Left</label>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Status --}}
                                    <div class="col-12 mt-3">
                                        <div class="row g-sm-2">
                                            <div class="col-md-4 col-sm-12">
                                                <label class="fw-bold">Status</label>
                                            </div>
                                            <div class="col-lg-2 col-md-4 col-sm-12">
                                                <input type="radio" name="status" value="1" checked>
                                                <label class="cursor-pointer">Active</label>
                                            </div>
                                            <div class="col-lg-2 col-md-4 col-sm-12">
                                                <input type="radio" name="status" value="0">
                                                <label class="cursor-pointer">Inactive</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3 mt-3 float-end">
                                        <input type="submit" class="btn btn-sm btn-primary" value="Save Changes">
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
                                                <th>Language Name</th>
                                                <th></th>
                                                <th>Status</th>
                                                <th>Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($language_settings as $ls)
                                            <tr>
                                                <td>{{$ls->id}}</td>
                                                <td>{{$ls->language_name}}</td>
                                                <td><a href="" class="btn btn-sm btn-success float-right">
                                                    <i class="fa fa-exchange"></i>&nbsp;&nbsp;Edit Translations	</a></td>
                                                <td>
                                                    @if ($ls->status == 1)
                                                        <a href="" class="btn btn-sm btn-success">Active</a>

                                                    @elseif ($ls->status == 0)
                                                    <a href="" class="btn btn-sm btn-danger">Inactive</a>
                                                    @endif
                                                </td>
                                                <td class="dropdown">
                                                    <button class="btn btn-secondary btn-sm dropdown-toggle"
                                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Select an option
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item" href="{{route('admin.settings.language.edit',[$ls->id])}}">
                                                                <i class='bx bxs-edit bx-xs me-2'></i>
                                                                Edit
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <form action="{{route('admin.settings.language.delete',[$ls->id])}}" method="post" class="d-flex">
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
