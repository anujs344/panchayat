<footer class="p-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                <a href=""><p><strong>About Us</strong></p></a>
                <a href=""><p>Contact Us</p></a>
                @auth
                <a href="{{route('profile.show')}}"><p>My Profile</p></a>
                @else
                <a href="{{route('register')}}"><p>Join Us</p></a>
                @endauth
                <a href=""><p>Privacy Policy</p></a>
                <a href=""><p>Terms of Service</p></a>
            </div>
            <div class="col-lg-3">
                <a href=""><p>Newsletter </p></a>
                <a href=""><p>Blog</p></a>
                <div class="social-links mb-3">
                    <a href=""><p><strong>Social Links</strong></p></a>
                    <a href="{{isset($socialMediaLink) ? $socialMediaLink->facebook_url : ''}}"><i class="fab fa-facebook fa-lg me-2 text-white"></i></a>
                    <a href="{{isset($socialMediaLink) ? $socialMediaLink->twitter_url : ''}}"><i class="fab fa-twitter fa-lg me-2 text-white"></i></a>
                    <a href="{{isset($socialMediaLink) ? $socialMediaLink->instagram_url : ''}}"><i class="fab fa-instagram fa-lg me-2 text-white"></i></a>
                    <a href="{{isset($socialMediaLink) ? $socialMediaLink->youtube_url : ''}}"><i class="fab fa-youtube fa-lg me-2 text-white"></i></a>
                </div>
            </div>
            <div class="col-lg-3">
                <p class="text-warning"><strong>Quick Links</strong></p>
                {{-- home --}}
                @if (isset($home))
                    <a aria-current="page" href="{{route('home')}}"><p>Home</p></a>
                @endif
                {{-- categories --}}
                @foreach ($navigations->where('title', '!=', 'home')->where('footer_status',1) as $n)
                    <a href="{{route('category.view', [$n->link])}}"><p>{{ucfirst($n->category->name)}}</p></a>
                @endforeach                
            </div>
            <div class="col-lg-3 border-0">
                <p><strong class="text-warning">Recieve Our News & Updates</strong></p>
                <form action="{{route('newsletterSubscribe')}}" method="POST">
                    @csrf
                    <input type="email" name="email" placeholder="Enter Email" class="form-control form-control-sm">
                    <button type="submit" class="btn btn-sm btn-primary w-100 my-3">Subscribe Now</button>
                </form>
            </div>
        </div>
    </div>
</footer>