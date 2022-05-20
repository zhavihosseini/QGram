<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Q Gram</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    {{--<link rel="manifest" href="">--}}
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-QN24LD3NGV"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-QN24LD3NGV');
    </script>
</head>
<style>
#select:focus{
    outline: none;
    border: 0px;
}
#select{
    padding: 8px 0 12px 25px;;
    font-family: "Open Sans", sans-serif;
    font-size: 14px;
}
    #op1{
        font-family: "Open Sans", sans-serif;
        font-size: 14px;
        width: 100%;
    }
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>
<style>
    .cs-loader {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        margin: 0;
        padding: 0;
    }
    .cs-loader-inner {
        transform: translateY(-50%);
        top: 50%;
        position: absolute;
        width:100%;
        color: cornflowerblue;
        padding: 0 100px;
        text-align: center;
    }
    .cs-loader-inner label {
        font-size: 20px;
        opacity: 0;
        display:inline-block;
    }
    @keyframes lol {
        0% {
            opacity: 0;
            transform: translateX(-300px);
        }
        33% {
            opacity: 1;
            transform: translateX(0px);
        }
        66% {
            opacity: 1;
            transform: translateX(0px);
        }
        100% {
            opacity: 0;
            transform: translateX(300px);
        }
    }

    @-webkit-keyframes lol {
        0% {
            opacity: 0;
            -webkit-transform: translateX(-300px);
        }
        33% {
            opacity: 1;
            -webkit-transform: translateX(0px);
        }
        66% {
            opacity: 1;
            -webkit-transform: translateX(0px);
        }
        100% {
            opacity: 0;
            -webkit-transform: translateX(300px);
        }
    }

    .cs-loader-inner label:nth-child(6) {
        -webkit-animation: lol 3s infinite ease-in-out;
        animation: lol 3s infinite ease-in-out;
    }

    .cs-loader-inner label:nth-child(5) {
        -webkit-animation: lol 3s 100ms infinite ease-in-out;
        animation: lol 3s 100ms infinite ease-in-out;
    }

    .cs-loader-inner label:nth-child(4) {
        -webkit-animation: lol 3s 200ms infinite ease-in-out;
        animation: lol 3s 200ms infinite ease-in-out;
    }

    .cs-loader-inner label:nth-child(3) {
        -webkit-animation: lol 3s 300ms infinite ease-in-out;
        animation: lol 3s 300ms infinite ease-in-out;
    }

    .cs-loader-inner label:nth-child(2) {
        -webkit-animation: lol 3s 400ms infinite ease-in-out;
        animation: lol 3s 400ms infinite ease-in-out;
    }

    .cs-loader-inner label:nth-child(1) {
        -webkit-animation: lol 3s 500ms infinite ease-in-out;
        animation: lol 3s 500ms infinite ease-in-out;
    }
</style>
<div class="cs-loader">
    <div class="cs-loader-inner">
        <label>●</label>
        <label>●</label>
        <label>●</label>
        <label>●</label>
        <label>●</label>
        <label>●</label>
        <p style="color: black;text-align: center;width: 100%"> Please Wait . . .</p>
    </div>
</div>
<body>
<!-- ======= Header ======= -->
<div class="container-fluid fixed-bottom" style="background-color: cornflowerblue;opacity: 0.9;color: black">
    @include('cookieConsent::index')
</div>
<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">
        <div class="logo mr-auto">
            <h1 class="text-light"><a href=""><img src="{{asset('qr-codes6.png')}}"></a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="dashboard.blade.php"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
        </div>
        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <li id="digit_clock_time"></li>
                @if (Route::has('login'))
                        @auth
                            <li><a href="{{ route('dashboard')}}" class="text-sm text-gray-700 underline" id="ahr">Dashboard</a></li>
                        @else
                            <li><a href="{{ route('login') }}" class="text-sm text-gray-700 underline" id="ahr">Login</a></li>
                            @if (Route::has('register'))
                                <li><a href="{{ route('register') }}" class="text-sm text-gray-700 underline" id="ahr">Register</a></li>
                            @endif
                        @endif
                @endif
                {{--<li class="active active"><a href="">{{__('index.homee')}}</a></li>--}}
{{--
                <button type="button" id="drpdwn" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">{{strtoupper(app()->getLocale())}}</button>
--}}
                {{--<div class="dropdown-menu" id="menuu">
                    @foreach(config('app.available_locales') as $index)
                    <a id="ahrf" class="dropdown-item" href="{{route(\Illuminate\Support\Facades\Route::currentRouteName(),$index) }}"@if (app()->getLocale() == $index) style="font-weight: bold; text-decoration: underline" @endif>{{ strtoupper($index)}}
                        @endforeach</a>
                </div>--}}
                <li><a href="#about">{{__('index.abouut')}}</a></li>
                <li><a href="#services">{{__('index.servicee')}}</a></li>
                <li><a href="#contact">{{__('index.contactt')}}</a></li>
                <li class="get-started"><a href="{{route('dashboard')}}">{{__('index.get')}}</a></li>
            </ul>
        </nav><!-- .nav-menu -->
    </div>
</header><!-- End Header -->
<!-- ======= Hero Section ======= -->
<br><br><br>
<ul class="circles">
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
</ul>
<section class="d-flex align-items-center area">
    <div class="container">
        <div class="row col-md-12 mh-100" style="margin-left: 0px">
            <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
               {{-- <h1 data-aos="fade-up">{{ __('index.title')}}</h1>
                <h2 data-aos="fade-up" data-aos-delay="400">{{__('index.content')}}</h2>
                <div data-aos="fade-up" data-aos-delay="800">
                    <a href="#about" class="btn-get-started scrollto">{{__('index.started')}}</a>
                </div>--}}
                <main class="tag-cloud" data-aos="fade-up">
                <form autocomplete="off" style="margin-bottom: 25px;">
                    <div class="row col-md-12" style="margin-left: 0px">
                    <div class="form-group col-md-6">
                        <label for="value" class="val">Value:</label>
                        <input type="text" class="form-control" name="value" value="Q Gram" id="value" spellcheck="false" aria-describedby="basic-addon1" required max="255">
                    </div>
                        <div class="form-group col-md-6">
                        <label for="size" class="val">Size:</label>
                        <input type="number" id="size" name="size" placeholder="100" min="100" max="300" value="250" class="form-control">
                    </div>
                        <br>
                        <div class="form-group col-md-6">
                            <label for="Padding" class="val">Padding:</label>
                            <input type="number" id="padding" name="padding" placeholder="Auto" min="0" max="100" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputGroupSelect01" class="val">Level:</label>
                            <select class="custom-select" id="inputGroupSelect01" name="level">
                                <option value="L">L - 7% damage</option>
                                <option value="M">M - 15% damage</option>
                                <option value="Q">Q - 25% damage</option>
                                <option value="H">H - 30% damage</option>
                            </select>
                        </div>
                        <br>
                        <div class="form-group col-md-6">
                            <label for="BackgroundColor" class="val">BackgroundColor:</label>
                            <input type="color" id="BackgroundColor" name="background" value="#ffffff" class="form-control" maxlength="1000">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="backgroundAlpha" class="val">BackgroundAlpha:</label>
                            <input type="number" id="backgroundAlpha" name="backgroundAlpha" placeholder="1" min="0" max="1" step="0.1" value="1" class="form-control">
                        </div>
                        <br>
                        <div class="form-group col-md-6">
                            <label for="foreground" class="val">Foreground:</label>
                            <input type="color" id="foreground" name="foreground" value="#000000" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="foregroundAlpha" class="val">ForegroundAlpha:</label>
                            <input type="number" id="foregroundAlpha" name="foregroundAlpha" placeholder="1" min="0" max="1" step="0.1" value="1" class="form-control">
                        </div>
                        <div class="form-group col-md-12">
                            <a class="btn btn-primary col-md-12" id="btn-download" onclick="dwn()" style="margin-bottom: 10px;">Download</a>
                        </div>
                    </div>
                </form>
                </main>
            </div>
            <div class="d1 col-lg-6 mh-100 d-inline-block order-1 order-lg-2 align-items-center align-self-center" data-aos="fade-left" data-aos-delay="200">
                {{--<img src="{{asset('19205.jpg')}}" class="img-fluid animated" alt="">--}}
                <img id="qrious" class="img-responsive hero-img center-block d-block mx-auto img-fluid animated">
            </div>
        </div>
    </div>
</section><!-- End Hero -->
<main id="main">
    <!-- ======= Clients Section ======= -->
    {{--<section id="clients" class="clients clients">
        <div class="container">
            <div class="row">
            </div>
        </div>
    </section>--}}<!-- End Clients Section -->
    <!-- ======= About Us Section ======= -->
    <div class="container" id="login">
    </div>
    <section id="about" class="about">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>{{__('index.about')}}</h2>
            </div>
            <div class="row content">
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="150">
                    <p>
                        {{__('index.about1')}}
                    </p>
                    <ul>
                        <li><i class="ri-check-double-line"></i> {{__('index.about2')}}</li>
                        <li><i class="ri-check-double-line"></i> {{__('index.about3')}}</li>
                    </ul>
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-up" data-aos-delay="300">
                    <p>
                        {{__('index.about4')}}
                    </p>
                    <a href="#" class="btn-learn-more">{{__('index.aboutbutton')}}</a>
                </div>
            </div>
        </div>
    </section><!-- End About Us Section -->
    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>{{__('index.service')}}</h2>
                <p>{{__('index.service1')}}</p>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                    <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                        <div class="icon"><i class="bx bxl-dribbble"></i></div>
                        <h4 class="title"><a href="">{{__('index.static')}}</a></h4>
                        <p class="description">{{__('index.dynamic')}}</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                    <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
                        <div class="icon"><i class="bx bx-wifi"></i></div>
                        <h4 class="title"><a href="">{{__('index.wifi')}}</a></h4>
                        <p class="description">{{__('index.wificontent')}}</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                    <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
                        <div class="icon"><i class="bx bx-bitcoin"></i></div>
                        <h4 class="title"><a href="">{{__('index.bitwallete')}}</a></h4>
                        <p class="description">{{__('index.bitcontent')}}</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                    <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
                        <div class="icon"><i class="bx bx-world"></i></div>
                        <h4 class="title"><a href="">{{__('index.geolocation')}}</a></h4>
                        <p class="description">{{__('index.geocontent')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Services Section -->
    <section id="features" class="features">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>{{__('index.emcanat')}}</h2>
                <p>{{__('index.emcanat-content')}}</p>
            </div>

            <div class="row" data-aos="fade-up" data-aos-delay="300">
                <div class="col-lg-3 col-md-4">
                    <div class="icon-box">
                        <i class="bx bx-money" style="color:green;"></i>
                        <h3><a href="">{{__('index.iranianpay')}}</a></h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                    <div class="icon-box">
                        <i class="ri-facebook-box-fill" style="color: #5578ff;"></i>
                        <h3><a href="">{{__('index.facebook')}}</a></h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                    <div class="icon-box">
                        <i class="ri-secure-payment-line" style="color: #e80368;"></i>
                        <h3><a href="">{{__('index.paywithdirect')}}</a></h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 mt-4 mt-lg-0">
                    <div class="icon-box">
                        <i class="ri-app-store-fill" style="color: #e361ff;"></i>
                        <h3><a href="">{{__('index.color')}}</a></h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======= Contact Section ======= -->
    <section id="features" class="features" style="padding: 0px;">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>{{__('index.news')}}</h2>
                <p>{{__('index.all')}}</p>
            </div>
        </div>
    </section>
    <section id="more-services" class="more-services" style="border-top: 0px;">
        <div class="container">
            <div class="row">
                @foreach($article as $item)
                    @php
                        $title = $item['title'];
                        $imgurl = $item['urltoimage'];
                        $url = $item['url'];
                        $description = $item['description'];
                    @endphp
                    <div class="col-md-6 d-flex align-items-stretch">
                        <div class="card" style='background-image:url("{{$imgurl}}");' data-aos="fade-up" data-aos-delay="100">
                            <div class="card-body">
                                <h5 class="card-title"><a href="{{$url}}" target="_blank">{{$title}}</a></h5>
                                <p class="card-text">{{\Illuminate\Support\Str::limit($description,130)}}</p>
                                <div class="read-more"><a href="{{$url}}" target="_blank"><i class="icofont-arrow-right"></i> Read More</a></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section id="contact" class="contact">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>{{__('index.contact')}}</h2>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="contact-about">
                        <h3>{{__('index.q')}}</h3>
                        <p>{{__('index.q-content')}}</p>
                        <div class="social-links">
                            <a href="#" class="instagram"><i class="icofont-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="200">
                    <div class="info">
                        <div>
                            <i class="ri-map-pin-line"></i>
                            <p>2261  Tyler Avenue street<br>CALIFORNIA</p>
                        </div>
                        <div>
                            <i class="ri-mail-send-line"></i>
                            <p>info@example.com</p>
                        </div>
                        <br>
                        <div>
                            <!-- BEGIN: TrustLock Badge --><a name="trustbadge" href="https://trustlock.co" ><img name="trustseal" alt="Trust Badges" style="border: 0;" src="https://trustlock.co/wp-content/uploads/2019/01/guaranteed-safe-checkout-15.png" width="171" height="75"></a><!-- End: TrustLock Badge -->
                        </div>
                        {{--<div>
                            <i class="ri-phone-line"></i>
                            <p>+1 5589 55488 55s</p>
                        </div>--}}
                    </div>
                </div>
                <div class="col-lg-5 col-md-12" data-aos="fade-up" data-aos-delay="300">
                    <form action="<?php echo route('contact')?>" method="post" role="form" class="php-email-form">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" id="name" placeholder="{{__('index.name')}}" data-rule="minlen:4" data-msg="Please enter at least 4 chars" required/>
                            <div class="validate"></div>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" id="email" placeholder="{{__('index.email')}}" data-rule="email" data-msg="Please enter a valid email" required/>
                            <div class="validate"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="{{__('index.subject')}}" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" required/>
                            <div class="validate"></div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="message" minlength="10" data-rule="required" data-msg="Please write something for us" placeholder="{{__('index.message')}}" required></textarea>
                        </div>
                        <div class="mb-3">
                            <div class="loading">{{__('index.loading')}}</div>
                            <div class="error-message"></div>
                            <div class="sent-message">{{__('index.your-mes')}}</div>
                        </div>
                        <div class="text-center"><button type="submit">{{__('index.sub')}}</button></div>
                    </form>
                </div>
            </div>
        </div>
        @if(session('success1'))
        <div class="modal fade bd-example-modal-sm" id="modall" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content" style="padding: 7px;color: white;background-color: green;border-radius: 0px;border: 0px;outline: 0px">
                        {{session('success1')}}
                </div>
            </div>
        </div>
        @endif

        @if(session('success2'))
            <div class="modal fade bd-example-modal-sm" id="modall" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content" style="padding: 7px;color: white;background-color: red;border-radius: 0px;border: 0px;outline: 0px">
                        {{session('success2')}}
                    </div>
                </div>
            </div>
        @endif
    </section><!-- End Contact Section -->
</main><!-- End #main -->
<!-- ======= Footer ======= -->
<br>
<footer id="footer">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-lg-6 text-lg-left text-center">
                <div class="copyright">
                   Copyright &copy; {{$year}} <strong>Q Gram<span style="color: lightgray;font-size: 12px;">v1.0.0</span></strong>, All Rights Reserved
                </div>
                <div class="credits">
                    Designed by <a href="">HOSSEINI</a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="footer-links text-lg-right text-center pt-2 pt-lg-0">
                    <a href="#about" class="scrollto">{{__('index.About')}}</a>
                    <a href="<?php echo route('privacy')?>">{{__('index.Privacy')}}</a>
                    <a href="<?php echo route('term')?>">{{__('index.Term')}}</a>
                </nav>
            </div>
        </div>
    </div>
</footer><!-- End Footer -->
<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
<!-- Vendor JS Files -->
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
{{--<script src="assets/vendor/php-email-form/validate.js"></script>--}}
<script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
<script src="assets/vendor/counterup/counterup.min.js"></script>
<script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/venobox/venobox.min.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="qrious.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
<script src="assets/js/qrcode.js"></script>
<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
    var x = document.getElementById("snackbar");
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
</script>
<script>
    $('#modall').modal('show');

    setTimeout(function() {
        $('#modall').modal('hide');
    }, 2000);
</script>
<script>
        document.onreadystatechange = function () {
            if (document.readyState !== "complete") {
                document.querySelector(
                    "body").style.visibility = "hidden";
                document.querySelector(
                    "body").style.overflow = "hidden";
                document.querySelector(
                    ".cs-loader").style.visibility = "visible";
            } else {
                document.querySelector(
                    ".cs-loader").style.display = "none";
                document.querySelector(
                    "body").style.overflow = "auto";
                document.querySelector(
                    "body").style.visibility = "visible";
            }
        };
</script>
<script src="https://www.gstatic.com/firebasejs/7.16.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.16.1/firebase-messaging.js"></script>
<script>
    MsgElem = document.getElementById("msg");
    TokenElem = document.getElementById("token");
    NotisElem = document.getElementById("notis");
    ErrElem = document.getElementById("err");
    var config = {
        apiKey: "AIzaSyB4xK8vkM9AWOpNBXPiFZS0jgLmoivIJxY",
        authDomain: "q-gram.firebaseapp.com",
        databaseURL: "https://q-gram-default-rtdb.firebaseio.com",
        projectId: "q-gram",
        storageBucket: "q-gram.appspot.com",
        messagingSenderId: "891606874351",
        appId: "1:891606874351:web:e846845ecba7bc57c4431a",
        measurementId: "G-RMLK0JB5E0"
    };
    firebase.initializeApp(config);

    const messaging = firebase.messaging();
    messaging
        .requestPermission()
        .then(function () {
            MsgElem.innerHTML = "Notification permission granted."
            console.log("Notification permission granted.");

            // get the token in the form of promise
            messaging.getToken({vapidKey:"BJ7DLqOgeUD7-Ccusw_c2bt9hhxP66IxvGNKMvYBO6CQE5ztQQWe_GACDFUBuYFieBCVmJEQNjgZhS9RDfPzeps"})
        })
        .then(function(token) {
            TokenElem.innerHTML = "token is : " + token
        })
        .catch(function (err) {
            ErrElem.innerHTML =  ErrElem.innerHTML + "; " + err
            console.log("Unable to get permission to notify.", err);
        });

    let enableForegroundNotification = true;
    messaging.onMessage(function(payload) {
        console.log("Message received. ", payload);
        NotisElem.innerHTML = NotisElem.innerHTML + JSON.stringify(payload);

        if(enableForegroundNotification) {
            const {title, ...options} = JSON.parse(payload.data.notification);
            navigator.serviceWorker.getRegistrations().then(registration => {
                registration[0].showNotification(title, options);
            });
        }
    });
</script>
</body>
</html>
