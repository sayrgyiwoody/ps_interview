<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Online Shop Home</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <link rel="stylesheet" href="{{asset('user/css/home.css')}}">

<!-- Google Web Fonts -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">



<!--Bootstrap 5.2-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

<!-- Customized Bootstrap Stylesheet -->
<link href="{{asset('user/css/style.css')}}" rel="stylesheet">

<!-- Add SweetAlert CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.min.js"></script>

<!-- Add SweetAlert styles -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.min.css">

 <!-- Link Swiper's CSS -->
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

 <!-- Load Leaflet CSS from CDN -->
 <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
 <!-- Load Leaflet JavaScript from CDN -->
 <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
            <div class="col-12 d-flex justify-content-between">
                <div class="">
                    <img src="{{asset('images/logo.png')}}" width="60" alt="logo">
                    <span class="fw-bold">My Shop</span>
                </div>
                <div class="dropdown">
                    <button class="btn dropdown-toggle d-flex align-items-center rounded" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="rounded-circle me-2" width="40" src="https://ui-avatars.com/api/?name={{Auth::user()->name}}" alt="">
                            <p class="my-0" class="mt-4 ms-2">{{Auth::user()->name}}</p><br>
                    </button>
                    <ul class="dropdown-menu">
                      <li>
                        <form action="{{route('logout')}}" method="post">
                            @csrf
                            <button type="submit" class="btn w-100"><i class="fa-solid fa-right-to-bracket me-2"></i>Logout</button>
                        </form>
                      </li>

                    </ul>
                  </div>

            </div>

        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">

            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <span class="h1 text-uppercase text-dark bg-light px-2">Multi</span>
                        <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="{{route('user.home')}}" class="nav-item nav-link active">Home</a>
                            <a href="cart.html" class="nav-item nav-link">My Cart</a>
                            <a href="contact.html" class="nav-item nav-link">Contact</a>
                        </div>
                        <div class="dropdown d-md-none mt-2">
                            <button class="btn dropdown-toggle d-flex align-items-center rounded" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img class="rounded-circle me-2" width="40" src="https://ui-avatars.com/api/?name={{Auth::user()->name}}" alt="">
                                    <p class="my-0" class="mt-4 ms-2">{{Auth::user()->name}}<i class="fa-solid fa-caret-down ms-2"></i></p><br>
                            </button>
                            <ul class="dropdown-menu">
                              <li>
                                <form action="{{route('logout')}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn w-100"><i class="fa-solid fa-right-to-bracket me-2"></i>Logout</button>
                                </form>
                              </li>

                            </ul>
                          </div>

                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                            <a href="" class="btn px-0">
                                <i class="fas fa-heart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">0</span>
                            </a>
                            <a href="" class="btn px-0 ml-3">
                                <i class="fas fa-shopping-cart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">0</span>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                    <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                    <div class="navbar-nav w-100">
                        @foreach ($category as $c )
                            <a href="{{route('user.categoryFilter',$c->id)}}" class="nav-item nav-link text-info border border-2">{{$c->name}}</a>
                        @endforeach

                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{route('user.home')}}">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shop List</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">



            <!-- Shop Product Start -->
            @yield('content')
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->





    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    {{-- Jquery cdn --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

     <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>


  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper(".mySwiper", {
      slidesPerView: 3,
      spaceBetween: 30,
      autoplay: {
        delay: 2000,
        disableOnInteraction: false,
      },
      freeMode: true,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
    });
  </script>
    @yield('scriptSource')


</body>

</html>
