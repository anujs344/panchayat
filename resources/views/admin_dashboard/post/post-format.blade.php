@extends('layouts.admin.app')

@section('main')
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h5 class="mb-0">Post Format</h5>
            <a href="{{ route('admin.post.view') }}" role="button" class="btn btn-primary btn-sm d-flex align-items-center">
                <i class='bx bx-menu me-1'></i>
                Posts
            </a>
        </div>
        <hr>

        {{-- post format --}}
        <div class="row row-cols-1 row-cols-md-3">
            {{-- article --}}
            <div class="col d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-body my-3">
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <div class="bg-light rounded-circle">
                                <i class="bx bx-file bx-lg px-3 py-2 text-success"></i>
                            </div>
                            <p class="fw-bold pt-3 fs-5">Article</p>
                            <p class="text-muted">An article with images and embed videos</p>
                        </div>
                        <a href="{{ route('admin.post.create', ['type'=>'article']) }}" class="stretched-link"></a>
                    </div>
                </div>
            </div>
            {{-- gallery --}}
            {{-- <div class="col d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-body my-3">
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <div class="bg-light rounded-circle">
                                <i class="bx bx-images bx-lg px-3 py-2 text-success"></i>
                            </div>
                            <p class="fw-bold pt-3 fs-5">Gallery</p>
                            <p class="text-muted">A collection of images</p>
                        </div>
                        <a href="" class="stretched-link"></a>
                    </div>
                </div>
            </div> --}}
            {{-- shorted list --}}
            {{-- <div class="col d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-body my-3">
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <div class="bg-light rounded-circle">
                                <i class="bx bx-list-ol bx-lg px-3 py-2 text-success"></i>
                            </div>
                            <p class="fw-bold pt-3 fs-5">Shorted List</p>
                            <p class="text-muted">A list based article</p>
                        </div>
                        <a href="" class="stretched-link"></a>
                    </div>
                </div>
            </div> --}}
            {{-- trivia quiz --}}
            {{-- <div class="col d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-body my-3">
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <div class="bg-light rounded-circle">
                                <i class="bx bx-list-check bx-lg px-3 py-2 text-success"></i>
                            </div>
                            <p class="fw-bold pt-3 fs-5">Trivia Quiz</p>
                            <p class="text-muted">Quizzes with right and wrong answers</p>
                        </div>
                        <a href="" class="stretched-link"></a>
                    </div>
                </div>
            </div> --}}
            {{-- personality quiz --}}
            {{-- <div class="col d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-body my-3">
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <div class="bg-light rounded-circle">
                                <i class="bx bx-shape-circle bx-lg px-3 py-2 text-success"></i>
                            </div>
                            <p class="fw-bold pt-3 fs-5">Personality Quiz</p>
                            <p class="text-muted">Quizzes with custom results</p>
                        </div>
                        <a href="" class="stretched-link"></a>
                    </div>
                </div>
            </div> --}}
            {{-- video --}}
            <div class="col d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-body my-3">
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <div class="bg-light rounded-circle">
                                <i class="bx bx-video bx-lg px-3 py-2 text-success"></i>
                            </div>
                            <p class="fw-bold pt-3 fs-5">Video</p>
                            <p class="text-muted">Upload or embed videos</p>
                        </div>
                        <a href="{{ route('admin.post.create', ['type'=>'video']) }}" class="stretched-link"></a>
                    </div>
                </div>
            </div>
            {{-- Audio --}}
            {{-- <div class="col d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-body my-3">
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <div class="bg-light rounded-circle">
                                <i class="bx bxl-audible bx-lg px-3 py-2 text-success"></i>
                            </div>
                            <p class="fw-bold pt-3 fs-5">Audio</p>
                            <p class="text-muted">Upload audios and create playlist</p>
                        </div>
                        <a href="{{ route('admin.post.create', ['type'=>'audio']) }}" class="stretched-link"></a>
                    </div>
                </div>
            </div> --}}
        </div>
    
    </div>
</div>
<!--end page wrapper -->
@endsection