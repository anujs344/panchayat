@extends('layouts.guest')
@section('title', 'Post')

@section('content')
  <section class="card-sec">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-8 m-auto">
          <div class="card text-center  my-4 card-shadow">
            <h3 class="text-danger text-center my-3">Disruptor</h3>
            <div class="img">
                <img src="{{asset('assets/images/logo.png')}}" class="w-25 mx-auto">
            </div>
            <h3 class="my-3">&#8377; 300</h3>
            <div class="dropdown-1 w-100 mt-3">
              <div class="dropdown show">
                <a class="btn btn-white border text-dark mr-auto  dropdown-toggle w-75" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <input type="radio"  check>
                  Monthly
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item" href="#">Monthaly</a>
                  <a class="dropdown-item" href="#">Half Yearly</a>
                  <a class="dropdown-item" href="#">Annual</a>
                </div>
              </div>
            </div>
            <h6 class="text-danger mt-3 fw-bold">Enjoy These Perks</h6>
            <div class="details border-top border-dark mx-2 p-3">    
              <p align="justify">
                <i class="fas fa-check-circle text-success"></i>
                Access to all paywall stories: podcasts (NL Hafta and Let's Talk About), interviews, comics and deep-dive reports
              </p>
              <p align="justify">
                  <i class="fas fa-check-circle text-success"></i>
                  Access to all paywall stories: podcasts (NL Hafta and Let's Talk About), interviews, comics and deep-dive reports  
              </p>
              <p align="justify">
                  <i class="fas fa-check-circle text-success"></i>
                  Access to all paywall stories: podcasts (NL Hafta and Let's Talk About), interviews, comics and deep-dive reports
              </p>
            </div>
            <div class="button-sub">
              <button type="button" class="btn btn-danger w-75 my-3">Subscribe</button>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-8 m-auto">
          <div class="card text-center my-4 card-shadow">
              <h3 class="text-danger text-center my-3">Disruptor</h3>
            <div class="img">
                <img src="{{asset('assets/images/logo.png')}}" class="w-25 mx-auto">
            </div>
            <h3 class="my-3">&#8377; 300</h3>
            <div class="dropdown-1 w-100 mt-3">
              <div class="dropdown show">
                <a class="btn btn-white border text-dark mr-auto  dropdown-toggle w-75" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <input type="radio"  check>
                  Monthly
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item" href="#">Monthaly</a>
                  <a class="dropdown-item" href="#">Half Yearly</a>
                  <a class="dropdown-item" href="#">Annual</a>
                </div>
              </div>
            </div>
            <h6 class="text-danger mt-3 fw-bold">Enjoy These Perks</h6>
            <div class="details border-top border-dark mx-2 p-3">
              <p align="justify">
                  <i class="fas fa-check-circle text-success"></i>
                Access to all paywall stories: podcasts (NL Hafta and Let's Talk About), interviews, comics and deep-dive reports
                
              </p>
              <p align="justify">
                  <i class="fas fa-check-circle text-success"></i>
                  Access to all paywall stories: podcasts (NL Hafta and Let's Talk About), interviews, comics and deep-dive reports
                  
              </p>
              <p align="justify">
                  <i class="fas fa-check-circle text-success"></i>
                  Access to all paywall stories: podcasts (NL Hafta and Let's Talk About), interviews, comics and deep-dive reports
                  
              </p>
            </div>
            <div class="button-sub">
              <button type="button" class="btn btn-danger w-75 my-3">Subscribe</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection