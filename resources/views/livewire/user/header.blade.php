<div class="sticky-top">
    <section id="navbar">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid px-3 ps-lg-4">
                <a class="navbar-brand m-auto" href="{{route('home')}}">
                    <div class="logo d-flex align-items-center">
                        <img src="{{ isset($visualSetting) ? asset('storage/media/images/logo/' . $visualSetting->logo) : '' }}" alt="" class="me-2 logo-img">
                        <div class="logo-text">{{ config('app.name', '') }}</div>
                    </div>
                </a>
                <a class="nav-link btn btn-success btn-sm text-white" role="button" href="">Subscribe</a>
            </div>
        </nav>
        <nav class="navbar navbar-expand-lg navbar-dark nav2-bg">
            <div class="container-fluid px-3 ps-lg-4">
                <!--<a class="navbar-brand" href="{{route('home')}}">-->
                <!--    <div class="logo d-flex align-items-center">-->
                <!--        <img src="{{ isset($visualSetting) ? asset('storage/media/images/logo/' . $visualSetting->logo) : '' }}" alt="" class="me-2" style="width: 80px;height:80px;">-->
                <!--        <div class="logo-text">{{ config('app.name', '') }}</div>-->
                <!--    </div>-->
                <!--</a>-->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav m-auto mb-2 mb-lg-0">
                        {{-- home --}}
                        @if (isset($home))
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{route('home')}}">Home</a>
                        </li>
                        @endif
                        {{-- categories --}}
                        @foreach ($navigations->where('title', '!=', 'home') as $n)
                            @if ($n->category->child->count() > 0)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="stories" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ucfirst($n->category->name)}}
                                    
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="stories">
                                    @foreach ($n->category->child as $sub)
                                    <li class="nav-item ms-2">
                                        <a class="nav-link" href="{{route('subcategory.view', [$sub->slug])}}">
                                            <i class="fas fa-long-arrow-alt-right fa-sm d-lg-none pe-3"></i>
                                            {{ucfirst($sub->name)}}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('category.view', [$n->link])}}">{{ucfirst($n->category->name)}}</a>
                            </li>
                            @endif
                        @endforeach
                        {{-- subscribe button --}}
                        <!--<li class="nav-item">-->
                        <!--    <a class="nav-link btn btn-success btn-sm" role="button" href="">Subscribe</a>-->
                        <!--</li>-->
                    </ul>
                </div>
            </div>
        </nav>    
    </section>
    {{-- Search Modal --}}
    <div class="modal fade" id="search" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog p-0">
          <div class="modal-content p-0">
    
            <div class="modal-body p-0">
              <div class="input-group">
                  <input type="search" placeholder="Search for Blogs, News & more.." class="form-control">
                  <button class="btn btn-dark"><i class="fas fa-search"></i></button>
              </div>
            </div>
    
          </div>
        </div>
    </div>
</div>