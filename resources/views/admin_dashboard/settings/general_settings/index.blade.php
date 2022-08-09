@extends('layouts.admin.app')

@section('main')
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        {{-- validation --}}
        <x-jet-validation-errors class="mb-2 text-danger" />
        {{-- language --}}
        {{-- <div class="row">
            <div class="col-lg-12">
                <x-bootstrap.card>
                    <x-slot name="content">
                        <form action="" method="POST" class="row fw-bold">
                            @csrf
                            <div class="col-12">
                                <label class="form-label">Settings Language</label>
                                <select name="lang_id" class="form-select">
                                    <option value="1" selected>English</option>
                                </select>
                            </div>
                        </form>
                    </x-slot>
                </x-bootstrap.card>
            </div>
        </div> --}}
        <div class="row row-cols-1 row-cols-xl-2">
            {{-- General --}}
            <div class="col d-flex">
                <x-bootstrap.card>
                    <x-slot name="content">
                        <ul class="nav nav-tabs nav-primary" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-bs-toggle="tab" href="#primarygeneral" role="tab"
                                    aria-selected="true">
                                    General Settings
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#primarycontact" role="tab"
                                    aria-selected="false">
                                    Contact Settings
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#primarysocial" role="tab"
                                    aria-selected="false">
                                    Social Media Settings
                                </a>
                            </li>
                            {{-- <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#primaryfacebook" role="tab"
                                    aria-selected="false">
                                    Facebook Comments
                                </a>
                            </li> --}}
                            {{-- <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#primarycustom" role="tab"
                                    aria-selected="false">
                                    Custom CSS Codes
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#primarycustomjs" role="tab"
                                    aria-selected="false">
                                    Custom JavaScript Codes
                                </a>
                            </li> --}}
                        </ul>
                        <div class="tab-content py-3">
                            {{-- GeneralSettings --}}
                            <div class="tab-pane fade show active" id="primarygeneral" role="tabpanel">
                                <form action="{{ route('admin.settings.general.store') }}" method="post">
                                    @csrf
                                    {{-- Navigation menu limit --}}
                                    <div class="col-12 mt-3">
                                        <label class="form-label">Navigation Menu Limit (The number of links that appear in the menu)</label>
                                        <input type="number" name="menu_limit" class="form-control" value="{{isset($generalSetting) ? $generalSetting->menu_limit : 1}}" min="1">
                                      </div>
                                    {{-- Cookie warning --}}
                                    <div class="col-12 mt-3">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-3 col-xl-6">
                                                <label class="form-label">Show Cookies Warning</label>
                                            </div>
                                            @if (isset($generalSetting))
                                                @if ($generalSetting->cookie_warning == 1)
                                                <div class="col-sm-12 col-md-2">
                                                    <input type="radio" name="cookie_warning" value="1" checked>
                                                    <label class="cursor-pointer">Yes</label>
                                                </div>
                                                <div class="col-sm-12 col-md-2">
                                                    <input type="radio" name="cookie_warning" value="0">
                                                    <label class="cursor-pointer">No</label>
                                                </div>
                                                @else
                                                <div class="col-sm-12 col-md-2">
                                                    <input type="radio" name="cookie_warning" value="1">
                                                    <label class="cursor-pointer">Yes</label>
                                                </div>
                                                <div class="col-sm-12 col-md-2">
                                                    <input type="radio" name="cookie_warning" value="0" checked>
                                                    <label class="cursor-pointer">No</label>
                                                </div>
                                                @endif
                                            @else
                                            <div class="col-sm-12 col-md-2">
                                                <input type="radio" name="cookie_warning" value="1" checked>
                                                <label class="cursor-pointer">Yes</label>
                                            </div>
                                            <div class="col-sm-12 col-md-2">
                                                <input type="radio" name="cookie_warning" value="0">
                                                <label class="cursor-pointer">No</label>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    {{-- Cookies Text Warning --}}
                                    <div class="col-12 mt-3">
                                        <label class="form-label">Cookie warning message</label>
                                        <textarea name="cookie_text" id="cookie_warning_message" class="form-control" placeholder="Show Cookies Warning" style="height:300px;">{{isset($generalSetting) ? $generalSetting->cookie_text : null}}</textarea>
                                    </div>
                                    {{-- Footer About Section description --}}
                                    <div class="col-12 mt-3">
                                        <label class="form-label">
                                            Footer About Section
                                        </label>
                                        <textarea type="text" class="form-control" name="footer_about_section" placeholder="Footer About Section" style="height:200px;">{{isset($generalSetting) ? $generalSetting->footer_about_section : null}}</textarea>
                                    </div>
                                    {{-- Post Optional URL Button Name --}}
                                    {{-- <div class="col-12 mt-3">
                                        <label class="form-label">
                                            Post Optional URL Button Name
                                        </label>
                                        <input type="text" class="form-control" name="post_url" value="{{isset($generalSetting) ? $generalSetting->post_url : null}}" placeholder="Post Optional URL Button Name">
                                    </div> --}}
                                    {{-- Copyright --}}
                                    <div class="col-12 mt-3">
                                        <label class="form-label">Copyright</label>
                                        <input type="text" name="copyright" class="form-control" value="{{isset($generalSetting) ? ucfirst($generalSetting->copyright) : null}}" placeholder="Copyright">
                                    </div>
                                    {{-- publish --}}
                                    <div class="col-12 mt-3 d-flex justify-content-end">
                                        <button type="submit" name="submit" class="btn btn-primary btn-sm">Save Changes</button>
                                    </div>
                                </form>
                            </div>

                            {{-- Contact Settings --}}
                            <div class="tab-pane fade" id="primarycontact" role="tabpanel">
                                <form action="{{ route('admin.settings.general.contact.store') }}" method="POST">
                                    @csrf
                                    {{-- Address --}}
                                    <div class="col-12 mt-3">
                                        <label class="form-label">Address</label>
                                        <input type="text" name="address" class="form-control" value="{{isset($contactSetting) ? ucwords($contactSetting->address) : null}}" placeholder="Address">
                                    </div>
                                    {{-- Email --}}
                                    <div class="col-12 mt-3">
                                        <label class="form-label">
                                            Email
                                        </label>
                                        <input type="email" class="form-control" name="email" value="{{isset($contactSetting) ? $contactSetting->email : null}}" placeholder="123@gmail.com">
                                    </div>
                                    {{-- Phone --}}
                                    <div class="col-12 mt-3">
                                        <label class="form-label">
                                            Phone
                                        </label>
                                        <input type="tel" class="form-control" name="phone" value="{{isset($contactSetting) ? $contactSetting->phone : null}}" placeholder="1234567890">
                                    </div>
                                    {{-- Contact Text --}}
                                    <div class="col-12 mt-3">
                                        <label class="form-label">
                                            Contact Text
                                        </label>
                                        <textarea name="contact_text" id="basic-example" cols="30" class="form-control" style="height: 200px;">
                                            {{isset($contactSetting) ? $contactSetting->contact_text : null}}
                                        </textarea>
                                    </div>
                                    {{-- publish --}}
                                    <div class="col-12 mt-3 d-flex justify-content-end">
                                        <button type="submit" name="submit" class="btn btn-primary btn-sm">Save Changes</button>
                                    </div>
                                </form>
                            </div>

                            {{-- Social Media Settings --}}
                            <div class="tab-pane fade" id="primarysocial" role="tabpanel">
                                <form action="{{ route('admin.settings.general.socialMedia.store') }}" method="POST">
                                    @csrf
                                    {{-- Facebook URL --}}
                                    <div class="col-12 mt-3">
                                        <label class="form-label">Facebook URL</label>
                                        <input type="text" name="facebook_url" value="{{isset($socialMediaSetting) ? $socialMediaSetting->facebook_url : null}}" class="form-control" placeholder="Facebook URL">
                                    </div>
                                    {{-- Twitter URL --}}
                                    <div class="col-12 mt-3">
                                        <label class="form-label">Twitter URL</label>
                                        <input type="text" name="twitter_url" value="{{isset($socialMediaSetting) ? $socialMediaSetting->twitter_url : null}}" class="form-control" placeholder="Twitter URL">
                                    </div>
                                    {{-- Instagram URL --}}
                                    <div class="col-12 mt-3">
                                        <label class="form-label">Instagram URL</label>
                                        <input type="text" name="instagram_url" value="{{isset($socialMediaSetting) ? $socialMediaSetting->instagram_url : null}}" class="form-control" placeholder="Instagram URL">
                                    </div>
                                    {{-- Pinterest URL --}}
                                    <div class="col-12 mt-3">
                                        <label class="form-label">Pinterest URL</label>
                                        <input type="text" name="pinterest_url" value="{{isset($socialMediaSetting) ? $socialMediaSetting->pinterest_url : null}}" class="form-control" placeholder="Pinterest URL">
                                    </div>
                                    {{-- LinkedIn URL --}}
                                    <div class="col-12 mt-3">
                                        <label class="form-label">LinkedIn URL</label>
                                        <input type="text" name="linkedIn_url" value="{{isset($socialMediaSetting) ? $socialMediaSetting->linkedIn_url : null}}" class="form-control" placeholder="LinkedIn URL">
                                    </div>
                                    {{-- VK URL --}}
                                    <div class="col-12 mt-3">
                                        <label class="form-label">VK URL</label>
                                        <input type="text" name="vk_url" value="{{isset($socialMediaSetting) ? $socialMediaSetting->vk_url : null}}" class="form-control" placeholder="VK URL">
                                    </div>
                                    {{-- Telegram URL --}}
                                    <div class="col-12 mt-3">
                                        <label class="form-label">Telegram URL</label>
                                        <input type="text" name="telegram_url" value="{{isset($socialMediaSetting) ? $socialMediaSetting->telegram_url : null}}" class="form-control" placeholder="Telegram URL">
                                    </div>
                                    {{-- Youtube URL --}}
                                    <div class="col-12 mt-3">
                                        <label class="form-label">Youtube URL</label>
                                        <input type="text" name="youtube_url" value="{{isset($socialMediaSetting) ? $socialMediaSetting->youtube_url : null}}" class="form-control" placeholder="Youtube URL">
                                    </div>
                                    {{-- publish --}}
                                    <div class="col-12 mt-3 d-flex justify-content-end">
                                        <button type="submit" name="submit" class="btn btn-primary btn-sm">Save Changes</button>
                                    </div>
                                </form>
                            </div>

                            {{-- Facebook Comments --}}
                            {{-- <div class="tab-pane fade" id="primaryfacebook" role="tabpanel">
                                <form action="{{ route('admin.settings.store.facebook.cps') }}"
                                    method="POST" class="row fw-bold">
                                    @csrf
                                    <div class="col-12 mt-3">
                                        <label class="form-label">Facebook Comments Plugin Code</label>

                                        <textarea name="facebook_comments" id="" class="form-control"
                                            placeholder="Facebook Comments Plugin Code" cols="30" rows="10" style="height:200px;"></textarea>
                                    </div>
                                    <div class="col-3 mt-3 float-end">
                                        <input type="submit" class="btn btn-sm btn-primary" value="Save Changes">
                                    </div>
                                </form>
                            </div> --}}
                            {{-- End Facebook Comments --}}

                            {{-- Custom CSS Codes --}}
                            {{-- <div class="tab-pane fade" id="primarycustom" role="tabpanel">
                                <form action="{{route('admin.settings.store.custom.css')}}" method="POST" class="row fw-bold">
                                    @csrf
                                    <div class="col-12 mt-3">
                                        <label class="form-label">Custom CSS Codes <small>(These codes will be added to the header of the site.)</small></label>
                                        <textarea name="custom_css" id="" class="form-control" placeholder="Custom CSS Codes" cols="30" rows="10" style="height:200px;"></textarea>
                                    </div>
                                    <div class="col-3 mt-3 float-end">
                                        <input type="submit" class="btn btn-sm btn-primary" value="Save Changes">
                                    </div>
                                </form>
                            </div> --}}
                            {{-- Custom CSS Codes --}}

                            {{-- Custom JavaScript Codes --}}
                            {{-- <div class="tab-pane fade" id="primarycustomjs" role="tabpanel">
                                <form action="{{ route('admin.settings.store.custom.js')}}" method="POST" class="row fw-bold">
                                    @csrf
                                    <div class="col-12 mt-3">
                                        <label class="form-label">Custom JavaScript Codes <small>(These codes will be added to the footer of the site.)<small></label>
                                        <textarea name="custom_js" id="" class="form-control" placeholder="Custom JavaScript Codes" cols="30" rows="10" style="height:200px;"></textarea>
                                    </div>
                                    <div class="col- mt-3 ">
                                        <input type="submit" class="btn btn-sm btn-primary" value="Save Changes">
                                    </div>
                                </form>
                            </div> --}}
                            {{-- End  Custom JavaScript Codes --}}
                        </div>
                    </x-slot>
                </x-bootstrap.card>
            </div>
            {{-- Google reCAPTCHA --}}
            <div class="col">
                <x-bootstrap.card>
                    <x-slot name="title">
                        <span>Google reCAPTCHA</span>
                    </x-slot>

                    <x-slot name="content">
                        <form action="{{route('admin.settings.general.GoogleReCAPTCHA.store')}}" method="POST">
                            @csrf
                        {{-- Site Key --}}
                        <div class="col-12 mt-3">
                            <label class="form-label">
                                Site Key
                            </label>
                            <input type="text" class="form-control" name="site_key" value="{{isset($google_reCAPTCHA) ? $google_reCAPTCHA->site_key : null}}" placeholder="Site Key" required>
                        </div>
                        {{-- Secret Key --}}
                        <div class="col-12 mt-3">
                            <label class="form-label">
                                Secret Key
                            </label>
                            <input type="text" class="form-control" name="secret_key" value="{{isset($google_reCAPTCHA) ? $google_reCAPTCHA->secret_key : null}}" placeholder="Secret Key" required>
                        </div>
                        {{-- Language --}}
                        {{-- <div class="col-12 mt-3">
                            <label class="form-label">
                                Language
                            </label>
                            <input type="text" class="form-control" name="language" placeholder="en" required>
                            <a href="https://developers.google.com/recaptcha/docs/language" class="nav-link">https://developers.google.com/recaptcha/docs/language</a>
                        </div> --}}
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