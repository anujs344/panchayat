@extends('layouts.admin.app')

@section('main')
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <div class="d-flex justify-content-between align-items-end mb-2">
            <h5 class="mb-0">Social Login Configuration</h5>
        </div><hr>
        {{-- validation --}}
        <x-jet-validation-errors class="mb-2 text-danger" />
        <div class="row row-cols-1 row-cols-xl-2">
            <div class="col">
                {{-- facebook --}}
                <x-bootstrap.card>
                    <x-slot name="title">
                        <span>Facebook</span>
                    </x-slot>
                    <x-slot name="content">
                        <form action="{{route('admin.settings.socialLogin.store', ['facebook'])}}" method="POST">
                        @csrf
                        {{-- App ID --}}
                        <div class="col-12 mt-3">
                            <label class="form-label">
                                App Id
                            </label>
                            <input type="text" class="form-control" name="facebook_id" placeholder="App Id" value="{{isset($socialLogin) ? ucwords($socialLogin->facebook_id) : null}}" required>
                        </div>
                        {{-- App Secret --}}
                        <div class="col-12 mt-3">
                            <label class="form-label">App Secret</label>
                            <input type="text" name="facebook_secret" class="form-control" value="{{isset($socialLogin) ? $socialLogin->facebook_secret : null}}" placeholder="App Secret" required>
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
                {{-- google --}}
                <x-bootstrap.card>
                    <x-slot name="title">
                        <span>Google</span>
                    </x-slot>
                    <x-slot name="content">
                        <form action="{{route('admin.settings.socialLogin.store', ['google'])}}" method="POST">
                        @csrf
                        {{-- Client ID --}}
                        <div class="col-12 mt-3">
                            <label class="form-label">
                                Client Id
                            </label>
                            <input type="text" class="form-control" name="google_id" placeholder="Client Id" value="{{isset($socialLogin) ? ucwords($socialLogin->google_id) : null}}" required>
                        </div>
                        {{-- Client Secret --}}
                        <div class="col-12 mt-3">
                            <label class="form-label">Client Secret</label>
                            <input type="text" name="google_secret" class="form-control" value="{{isset($socialLogin) ? $socialLogin->google_secret : null}}" placeholder="Client Secret" required>
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