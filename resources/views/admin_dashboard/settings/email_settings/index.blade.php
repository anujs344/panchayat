@extends('layouts.admin.app')

@section('main')
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <div class="row row-cols-2">
            {{-- Email setting --}}
            <div class="col d-flex">
                <x-bootstrap.card>
                    <x-slot name="title">
                        <span>Email Settings</span>
                    </x-slot>
                    <x-slot name="content">
                        {{-- validation --}}
                        <x-jet-validation-errors class="mb-2 text-danger" />
                        <form action="{{route('admin.settings.email.store', ['setting'])}}" method="POST">
                        @csrf
                        {{-- library --}}
                        <div class="col-12 mt-3">
                            <label class="form-label">Mail Library</label>
                            <select name="library" class="form-select" style="font-size: 12px;">
                                {{-- <option value="">None</option> --}}
                                @foreach ($mailers as $list)
                                <option value="{{$list['name']}}"
                                @if (isset($emailSetting) && $list['name'] == $emailSetting->library)
                                    {{'selected'}}
                                @endif
                                >
                                    {{strtoupper($list['name'])}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        {{-- address --}}
                        <div class="col-12 mt-3">
                            <label class="form-label">Mail From Address</label>
                            <input type="email" name="from_address" value="{{isset($emailSetting) ? $emailSetting->from_address : null}}" class="form-control" placeholder="Mail From Address">
                        </div>
                        {{-- name --}}
                        <div class="col-12 mt-3">
                            <label class="form-label">Mail From Name</label>
                            <input type="text" name="from_name" value="{{isset($emailSetting) ? $emailSetting->from_name : null}}" class="form-control" placeholder="Mail From Name">
                        </div>
                        {{-- host --}}
                        <div class="col-12 mt-3">
                            <label class="form-label">Mail Host</label>
                            <input type="text" name="host" value="{{isset($emailSetting) ? $emailSetting->host : null}}" class="form-control" placeholder="Mail Host">
                        </div>
                        {{-- port --}}
                        <div class="col-12 mt-3">
                            <label class="form-label">Mail Port</label>
                            <input type="text" name="port" value="{{isset($emailSetting) ? $emailSetting->port : null}}" class="form-control" placeholder="Mail Port">
                        </div>
                        {{-- username --}}
                        <div class="col-12 mt-3">
                            <label class="form-label">Mail Username</label>
                            <input type="text" name="username" value="{{isset($emailSetting) ? $emailSetting->username : null}}" class="form-control" placeholder="Mail Username">
                        </div>
                        {{-- password --}}
                        <div class="col-12 mt-3">
                            <label class="form-label">Mail Password</label>
                            <input type="password" name="password" value="{{isset($emailSetting) ? $emailSetting->password : null}}" class="form-control" placeholder="Mail Password">
                        </div>
                        {{-- template --}}
                        <div class="col-12 mt-3">
                            <label class="form-label">Email Template</label>
                            
                        </div>
                        {{-- publish --}}
                        <div class="col-12 mt-3 d-flex justify-content-end">
                            <button type="submit" name="submit" class="btn btn-primary btn-sm">Save Changes</button>
                        </div>
                    </form>
                    </x-slot>
                </x-bootstrap.card>
            </div>
            {{-- Email verification / Contact message / Send Test Email --}}
            <div class="col">
                <div class="row row-cols-1">
                    <div class="col">
                        <x-bootstrap.card>
                            <x-slot name="title">
                                <span>Email Verification</span>
                            </x-slot>
                            <x-slot name="content">
                                <form action="{{route('admin.settings.email.store', ['verification'])}}" method="POST">
                                    @csrf
                                    <div class="col-12 mt-3">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6 col-xl-4 mb-sm-2">
                                                <label class="fw-bold">Email Verification</label>
                                            </div>
                                            @if (isset($emailSetting))
                                                @if ($emailSetting->verification_status == 1)
                                                <div class="col-sm-12 col-md-3 col-xl-3">
                                                    <input type="radio" name="verification_status" value="1" checked>
                                                    <label class="cursor-pointer">Enable</label>
                                                </div>
                                                <div class="col-sm-12 col-md-3 col-xl-3">
                                                    <input type="radio" name="verification_status" value="0">
                                                    <label class="cursor-pointer">Disable</label>
                                                </div>
                                                @else
                                                <div class="col-sm-12 col-md-3 col-xl-3">
                                                    <input type="radio" name="verification_status" value="1">
                                                    <label class="cursor-pointer">Enable</label>
                                                </div>
                                                <div class="col-sm-12 col-md-3 col-xl-3">
                                                    <input type="radio" name="verification_status" value="0" checked>
                                                    <label class="cursor-pointer">Disable</label>
                                                </div>
                                                @endif
                                            @else
                                            <div class="col-sm-12 col-md-3 col-xl-3">
                                                <input type="radio" name="verification_status" value="1">
                                                <label class="cursor-pointer">Enable</label>
                                            </div>
                                            <div class="col-sm-12 col-md-3 col-xl-3">
                                                <input type="radio" name="verification_status" value="0" checked>
                                                <label class="cursor-pointer">Disable</label>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    {{-- publish --}}
                                    <div class="col-12 mt-3 d-flex justify-content-end">
                                        <button type="submit" name="submit" class="btn btn-primary btn-sm">Save Changes</button>
                                    </div>
                                </form>
                            </x-slot>
                        </x-bootstrap.card>
                    </div>
                    <div class="col">
                        <x-bootstrap.card>
                            <x-slot name="title">
                                <span>Contact Messages</span>
                            </x-slot>
                            <x-slot name="content">
                                <form action="{{route('admin.settings.email.store', ['contact'])}}" method="POST">
                                    @csrf
                                    <div class="col-12 mt-3">
                                        <div class="row">
                                            <div class="col-12 mb-2">
                                                <label class="fw-bold">Send Contact Messages to Email Address</label>
                                            </div>
                                            @if (isset($emailSetting))
                                                @if ($emailSetting->contact_message_status == 1)
                                                <div class="col-sm-12 col-md-4 col-xl-3">
                                                    <input type="radio" name="contact_message_status" value="1" checked>
                                                    <label class="cursor-pointer">Yes</label>
                                                </div>
                                                <div class="col-sm-12 col-md-4 col-xl-3">
                                                    <input type="radio" name="contact_message_status" value="0">
                                                    <label class="cursor-pointer">No</label>
                                                </div>
                                                @else
                                                <div class="col-sm-12 col-md-4 col-xl-3">
                                                    <input type="radio" name="contact_message_status" value="1">
                                                    <label class="cursor-pointer">Yes</label>
                                                </div>
                                                <div class="col-sm-12 col-md-4 col-xl-3">
                                                    <input type="radio" name="contact_message_status" value="0" checked>
                                                    <label class="cursor-pointer">No</label>
                                                </div>
                                                @endif
                                            @else
                                            <div class="col-sm-12 col-md-4 col-xl-3">
                                                <input type="radio" name="contact_message_status" value="1">
                                                <label class="cursor-pointer">Yes</label>
                                            </div>
                                            <div class="col-sm-12 col-md-4 col-xl-3">
                                                <input type="radio" name="contact_message_status" value="0" checked>
                                                <label class="cursor-pointer">No</label>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label class="form-label">Email (Contact messages will be sent to this email.)</label>
                                        <input type="email" name="contact_message_email" value="{{isset($emailSetting) ? $emailSetting->contact_message_email : null}}" class="form-control" placeholder="Email">
                                    </div>
                                    {{-- publish --}}
                                    <div class="col-12 mt-3 d-flex justify-content-end">
                                        <button type="submit" name="submit" class="btn btn-primary btn-sm">Save Changes</button>
                                    </div>
                                </form>
                            </x-slot>
                        </x-bootstrap.card>
                    </div>
                    <div class="col">
                        <x-bootstrap.card>
                            <x-slot name="title">
                                <span>Send Test Email</span>
                            </x-slot>
                            <x-slot name="subTitle">
                                <small>You can send a test mail to check if your mail server is working.</small>
                            </x-slot>
                            <x-slot name="content">
                                <form action="{{route('admin.settings.email.store', ['test_mail'])}}" method="POST">
                                    @csrf
                                    <div class="col-12 mt-3">
                                        <div class="row">
                                            <div class="col-12 mb-2">
                                                <label class="form-label">Email Address</label>
                                                <input type="email" name="test_mail" class="form-control" placeholder="Email Address">
                                            </div>
                                        </div>
                                    </div>
                                    {{-- publish --}}
                                    <div class="col-12 mt-3 d-flex justify-content-end">
                                        <button type="submit" name="submit" class="btn btn-primary btn-sm">Send Email</button>
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
<!--end page wrapper -->
@endsection