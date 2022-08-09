@extends('layouts.admin.app')

@section('main')
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            {{-- categories list --}}
            <div class="col-12">
                <x-bootstrap.card>
                    <x-slot name="title">
                        <div>Newsletter View</div>
                    </x-slot>
                    <x-slot name="controls">
                        <a href="{{ route('admin.newsletter.view') }}" role="button" class="btn btn-primary btn-sm d-flex align-items-center">
                            <i class='bx bx-menu bx-xs me-1'></i>
                            Newsletters
                        </a>
                    </x-slot>
                    <x-slot name="content">
                        <hr>
                        <div class="mt-3">
                            <h5 class="fw-bold mb-0">
                                {{ucwords($newsletter->title)}}
                            </h5>
                            <small>{{$newsletter->created_at}}</small>
                            <div class="mt-3">
                                {!! $newsletter->content !!}
                            </div>
                        </div>
                    </x-slot>
                </x-bootstrap.card>
            </div>
        </div>
    </div>
</div>
@endsection