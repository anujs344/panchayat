@extends('layouts.admin.app')

@section('main')
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col">
                <x-bootstrap.card>
                    <x-slot name="title">
                        <div>Profile Information</div>
                    </x-slot>
                    <x-slot name="subTitle">
                        <small>Update your account's profile information and email address.</small>
                    </x-slot>
                    <x-slot name="content">
                        <div class="mt-4">Photo</div>
                        <form action="{{route('admin.profile.update',[Auth::user()->id])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="d-flex flex-column">
                                <img src="{{ Auth::user()->profile_photo_path ? asset('storage/'.Auth::user()->profile_photo_path) : Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" id="wizardPicturePreview" class=" rounded-circle my-3" width="100px;">
                                <button class="btn btn-secondary btn-sm" type="button" value="" style="width: 250px;position: relative;">
                                    <input type="file" name="file" id="wizard-picture" style="cursor: pointer;
                                    display: inline-block;
                                    height:100%;
                                    left: 0;
                                    opacity: 0 !important;
                                    position: absolute;
                                    top: 0;
                                    width:100%;">
                                    SELECT A NEW PHOTO
                                </button>
                            </div>
                            <div class="mt-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" value="{{isset(Auth::user()->name) ? ucwords(Auth::user()->name) : ''}}" class="form-control">
                            </div>
                            <div class="mt-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" value="{{isset(Auth::user()->email) ? Auth::user()->email : ''}}" class="form-control">
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success btn-sm mt-3 ms-auto">Save</button>
                            </div>
                        </form>
                    </x-slot>
                </x-bootstrap.card>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <x-bootstrap.card>
                    <x-slot name="title">
                        <div>Update Password</div>
                    </x-slot>
                    <x-slot name="subTitle">
                        <small>Ensure your account is using a long, random password to stay secure.</small>
                    </x-slot>
                    <x-slot name="content">
                        {{-- validation --}}
                        <x-jet-validation-errors class="mb-2 text-danger" />
                        <form action="{{route('admin.profile.password',[Auth::user()->id])}}" method="post">
                            @csrf
                            <div class="mt-3">
                                <label class="form-label">Current Password</label>
                                <input type="password" name="current_password" class="form-control">
                            </div>
                            <div class="mt-3">
                                <label class="form-label">New Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="mt-3">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success btn-sm mt-3 ms-auto">Save</button>
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
        $(document).ready(function(){
        // Prepare the preview for profile picture
            $("#wizard-picture").change(function(){
                readURL(this);
            });
        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush