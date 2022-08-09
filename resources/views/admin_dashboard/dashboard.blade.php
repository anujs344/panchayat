@extends('layouts.admin.app')

@section('main')
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
    
        {{-- chartbox details --}}
        <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-4">
            <a href="" class="col cs-box-report">
                <div class="card radius-10 overflow-hidden bg-danger">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-white">Posts</p>
                                <h5 class="mb-0 text-white">{{count($posts)}}</h5>
                            </div>
                            <div class="ms-auto text-white">
                                <i class='bx bx-file-blank'></i>
                            </div>
                        </div>
                    </div>
                    <div class="" id="chart1"></div>
                </div>
            </a>
            <a href="" class="col cs-box-report">
                <div class="card radius-10 overflow-hidden bg-primary">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-white">Inactive Posts</p>
                                <h5 class="mb-0 text-white">{{count($posts->where('visibility',0))}}</h5>
                            </div>
                            <div class="ms-auto text-white">
                                <i class='bx bxs-low-vision' ></i>
                            </div>
                        </div>
                    </div>
                    <div class="" id="chart2"></div>
                </div>
            </a>
            <a href="" class="col cs-box-report">
                <div class="card radius-10 overflow-hidden bg-warning">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-dark">Draft</p>
                                <h5 class="mb-0 text-dark">{{count($posts->where('status',0))}}</h5>
                            </div>
                            <div class="ms-auto text-dark">
                                <i class='bx bx-file'></i>
                            </div>
                        </div>
                    </div>
                    <div class="" id="chart3"></div>
                </div>
            </a>
            <a href="" class="col cs-box-report">
                <div class="card radius-10 overflow-hidden bg-success">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-white">Scheduled Posts</p>
                                <h5 class="mb-0 text-white">{{count($posts->where('scheduled_post_date','!=', null))}}</h5>
                            </div>
                            <div class="ms-auto text-white">
                                <i class='bx bx-time'></i>
                            </div>
                        </div>
                    </div>
                    <div class="" id="chart4"></div>
                </div>
            </a>
        </div>
      
        {{-- pending comments & latest messages --}}
        <div class="row">
            {{-- pending comments --}}
            <div class="col-12 col-xl-6 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="d-flex flex-column">
                                <h5 class="mb-0">Pending Comments</h5>
                                <p class="small">Recently added unapproved comments</p>
                            </div>
                            <div class="font-22 ms-auto">
                                <i class='bx bx-dots-horizontal-rounded'></i>
                            </div>
                        </div>
                        <div class="table-responsive mt-3">
                            <table class="table align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Comment</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pendingComments as $list)
                                    <tr>
                                        <td>{{$list->id}}</td>
                                        <td>{{ucwords($list->user->name)}}</td>
                                        <td class=""><span class="badge bg-light-success text-success w-100">{{ucfirst($list->comment)}}</span></td>
                                        <td><small>{{ date('Y-m-d / H:i', strtotime($list->created_at)) }}</small></td>
                                    </tr>
                                    @empty
                                        <tr><td colspan="4">No pending comments..</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-2 text-end">
                            <a href="{{route('admin.comment.pending')}}" class="btn btn-primary btn-sm">View All</a>
                        </div>
                    </div>
                </div>
            </div>
            {{-- latest messages --}}
            <div class="col-12 col-xl-6 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="d-flex flex-column">
                                <h5 class="mb-0">Latest Contact Messages</h5>
                                <p class="small">Recently added contact messages</p>
                            </div>
                            <div class="font-22 ms-auto">
                                <i class='bx bx-dots-horizontal-rounded'></i>
                            </div>
                        </div>
                        <div class="table-responsive mt-3">
                            <table class="table align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Message</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($contactMessages as $list)
                                    <tr>
                                        <td>{{$list->id}}</td>
                                        <td>{{ucwords($list->user->name)}}</td>
                                        <td class=""><span class="badge bg-light-success text-success w-100">{{ucfirst($list->message)}}</span></td>
                                        <td><small>{{ date('Y-m-d / H:i', strtotime($list->created_at)) }}</small></td>
                                    </tr>
                                    @empty
                                        <tr><td colspan="4">No contact messages...</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-2 text-end">
                            <a href="{{route('admin.contactMessage.view')}}" class="btn btn-primary btn-sm">View All</a>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->

        {{-- latest users --}}
        <div class="row">
            {{-- latest users --}}
            <div class="col-12 col-xl-6 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="d-flex flex-column">
                                <h5 class="mb-0">Latest Users</h5>
                                <p class="small">Recently registered users</p>
                            </div>
                            <div class="font-22 ms-auto">
                                <i class='bx bx-dots-horizontal-rounded'></i>
                            </div>
                        </div>
                        {{-- user list --}}
                        <div class="d-flex flex-wrap">
                            @forelse ($users as $list)
                            <div class="d-flex flex-column">
                                <img src="{{ $list->profile_photo_path ? asset('storage/'.$list->profile_photo_path) : $list->profile_photo_url }}" class="msg-avatar" alt="user avatar">
                                <div class="user-name">{{ucwords($list->name)}}</div>
                                <div class="small user-creation">
                                    {{ date ('d-m-y', strtotime($list->created_at))}}
                                </div>
                            </div>
                            @empty
                                No new users...
                            @endforelse
                        </div><hr>
                        <div class="mt-2 text-end">
                            <a href="{{route('admin.user.view')}}" class="btn btn-primary btn-sm">View All</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    </div>
</div>
<!--end page wrapper -->
@endsection