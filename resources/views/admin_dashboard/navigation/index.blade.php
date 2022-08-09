@extends('layouts.admin.app')

@section('main')
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">        
        {{-- navigation --}}
        <div class="row row-cols-1 row-cols-xl-2">
            {{-- navigation list --}}
            <div class="col d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="d-flex flex-column">
                                <h5 class="mb-0">Navigation</h5>
                                <p class="small">You can manage the navigation by dragging and dropping menu items.</p>
                            </div>
                        </div>
                        {{-- home navigation --}}
                        @foreach ($navigations->where('title', 'home') as $list)
                        <div class="card">
                            <div class="card-header border-bottom-0 bg-gradient-cosmic">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="text-white">{{ucfirst($list->title)}}</div>
                                    @if ($list->menu_status == 1)
                                    <a href="{{route('admin.navigation.status', [0, $list->id])}}" class="text-white bg-danger px-2 py-1 rounded">
                                        Hide
                                    </a>
                                    @else
                                    <a href="{{route('admin.navigation.status', [1, $list->id])}}" class="text-white bg-success px-2 py-1 rounded">
                                        Show
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                        {{-- other navigation --}}
                        <div id="accordion">
                            @foreach ($navigations->where('title', '!=', 'home') as $list)
                            <div class="card">
                                {{-- category --}}
                                <div class="card-header bg-gradient-moonlit" title="{{$list->menu_status == 1 ? 'Elabled on Navigation, ' : 'Disabled on Navigation, '}}{{$list->home_status == 1 ? 'Elabled on Homepage' : 'Disabled on Homepage'}}">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="text-light">
                                            {{ucwords($list->category->name)}}
                                            <span>( Category )</span>
                                        </div>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <a href="javascript:void(0)" onclick="deleteConfirm(event)" class="text-light bg-danger nav-action">
                                                <form action="{{route('admin.navigation.delete', [$list->id])}}" method="get" class="d-none"></form>
                                                <i class='bx bxs-trash bx-xs'></i>
                                            </a>
                                            <a href="{{route('admin.navigation.edit', ['category', $list->id])}}" class="text-light bg-primary nav-action mx-2">
                                                <i class='bx bxs-edit bx-xs'></i>
                                            </a>
                                            <a href="javascript:void(0)" onclick="navminmax(event)" class="card-link text-light action" data-bs-toggle="collapse" data-bs-target="{{'#id'.$list->id}}">
                                                <i class='bx bx-plus bx-xs'></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                {{-- subcategory --}}
                                <div id="{{'id'.$list->id}}" class="collapse" data-bs-parent="#accordion">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        @foreach ($list->category->child as $child)
                                        <div>
                                            {{ucwords($child->name)}}
                                        </div>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <a href="javascript:void(0)" onclick="deleteConfirm(event)" class="text-light bg-danger nav-action">
                                                <form action="{{route('admin.navigation.deleteSubcategory', [$child->id])}}" method="get" class="d-none"></form>
                                                <i class='bx bxs-trash bx-xs'></i>
                                            </a>
                                            <a href="{{route('admin.subcategory.edit', [$child->id])}}" class="text-light bg-primary nav-action ms-2">
                                                <i class='bx bxs-edit bx-xs'></i>
                                            </a>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            {{-- Update navigation --}}
            @if (isset($navigation))
            <div class="col d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="d-flex flex-column">
                                <h5 class="mb-3">Update Menu</h5>
                            </div>
                        </div>
                        {{-- Errors --}}
                        <x-jet-validation-errors class="mb-2 text-danger" />
                        <form action="{{route('admin.navigation.update', $navigation->id)}}" method="POST">
                            @csrf
                            {{-- menu name --}}
                            <div class="col-12 mt-3">
                                <label class="form-label">Menu Name</label>
                                <input type="text" class="form-control" value="{{ ucwords($navigation->category->name) }}">
                            </div>
                            {{-- menu order --}}
                            <div class="col-12 mt-3">
                              <label for="menu-order" class="form-label">Menu Order</label>
                              <input type="number" name="menu_order" class="form-control" id="menu-order" value="{{$navigation->menu_order ?? 1}}" min="1">
                            </div>
                            {{-- show on menu --}}
                            <div class="col-12 mt-3">
                                <div class="row g-sm-2">
                                    <div class="col-md-4 col-sm-12">
                                        <label class="fw-bold">Show on Menu</label>
                                    </div>
                                    @if ($navigation->menu_status == 1)
                                    <div class="col-lg-2 col-md-4 col-sm-12">
                                        <input type="radio" name="menu_status" value="1" checked>
                                        <label class="cursor-pointer">Yes</label>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-sm-12">
                                        <input type="radio" name="menu_status" value="0">
                                        <label class="cursor-pointer">No</label>
                                    </div>  
                                    @else
                                    <div class="col-lg-2 col-md-4 col-sm-12">
                                        <input type="radio" name="menu_status" value="1">
                                        <label class="cursor-pointer">Yes</label>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-sm-12">
                                        <input type="radio" name="menu_status" value="0" checked>
                                        <label class="cursor-pointer">No</label>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            {{-- show on homepage --}}
                            <div class="col-12 mt-3">
                                <div class="row g-sm-2">
                                    <div class="col-md-4 col-sm-12">
                                        <label class="fw-bold">Show on Homepage</label>
                                    </div>
                                    @if ($navigation->home_status == 1)
                                    <div class="col-lg-2 col-md-4 col-sm-12">
                                        <input type="radio" name="home_status" value="1" checked>
                                        <label class="cursor-pointer">Yes</label>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-sm-12">
                                        <input type="radio" name="home_status" value="0">
                                        <label class="cursor-pointer">No</label>
                                    </div>  
                                    @else
                                    <div class="col-lg-2 col-md-4 col-sm-12">
                                        <input type="radio" name="home_status" value="1">
                                        <label class="cursor-pointer">Yes</label>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-sm-12">
                                        <input type="radio" name="home_status" value="0" checked>
                                        <label class="cursor-pointer">No</label>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            {{-- show on footer --}}
                            <div class="col-12 mt-3">
                                <div class="row g-sm-2">
                                    <div class="col-md-4 col-sm-12">
                                        <label class="fw-bold">Show on Footer</label>
                                    </div>
                                    @if ($navigation->footer_status == 1)
                                    <div class="col-lg-2 col-md-4 col-sm-12">
                                        <input type="radio" name="footer_status" value="1" checked>
                                        <label class="cursor-pointer">Yes</label>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-sm-12">
                                        <input type="radio" name="footer_status" value="0">
                                        <label class="cursor-pointer">No</label>
                                    </div>  
                                    @else
                                    <div class="col-lg-2 col-md-4 col-sm-12">
                                        <input type="radio" name="footer_status" value="1">
                                        <label class="cursor-pointer">Yes</label>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-sm-12">
                                        <input type="radio" name="footer_status" value="0" checked>
                                        <label class="cursor-pointer">No</label>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 mt-4 d-flex justify-content-end">
                                <a href="{{route('admin.navigation.view')}}" role="button" class="btn btn-warning btn-sm me-2">Cancel</a>
                                <button type="submit" class="btn btn-primary btn-sm">Update Menu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif
            {{-- menu limit --}}
            <div class="col">
                <div class="card radius-10 w-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="d-flex flex-column">
                                <h5 class="mb-0">Menu Limit</h5>
                            </div>
                        </div>
                        <form action="{{route('admin.navigation.store')}}" method="POST">
                            @csrf
                            <div class="col-12 mt-3">
                              <label class="form-label">Menu Limit (The number of links that appear in the menu)</label>
                              <input type="number" name="menu_limit" class="form-control" value="{{isset($generalSetting) ? $generalSetting->menu_limit : 1}}" min="1">
                            </div>
                            <div class="col-12 mt-4 d-flex justify-content-end">
                              <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>

<!--end page wrapper -->
@endsection

@push('js')
    <script>
        function navminmax(event){
            event.preventDefault();     
            if (event.target.classList.contains("bx-plus")) {
                event.target.classList.remove('bx-plus');
                event.target.classList.add('bx-minus');
            } else if (event.target.classList.contains("bx-minus")) {
                event.target.classList.remove('bx-minus');
                event.target.classList.add('bx-plus');
            }
        }
        
    </script>
@endpush