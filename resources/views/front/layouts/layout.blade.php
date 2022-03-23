<!DOCTYPE html>
<html>
<head>

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>{{ config("app.name") }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Web Fonts  -->
    <link id="googleFonts" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800%7CShadows+Into+Light&display=swap" rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="/front/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/front/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/front/vendor/animate/animate.compat.css">
    <link rel="stylesheet" href="/front/vendor/simple-line-icons/css/simple-line-icons.min.css">
    <link rel="stylesheet" href="/front/vendor/owl.carousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="/front/vendor/owl.carousel/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="/front/vendor/magnific-popup/magnific-popup.min.css">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="/front/css/theme.css">
    <link rel="stylesheet" href="/front/css/theme-elements.css">
    <link rel="stylesheet" href="/front/css/theme-blog.css">
    <link rel="stylesheet" href="/front/css/theme-shop.css">

    <!-- Skin CSS -->
    <link id="skinCSS" rel="stylesheet" href="/front/css/skins/skin-corporate-4.css">

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="/front/css/custom.css">
    @yield("css")

    <!-- Head Libs -->
    <script src="/front/vendor/modernizr/modernizr.min.js"></script>

</head>
<body class="loading-overlay-showing" data-loading-overlay data-plugin-options="{'hideDelay': 500, 'effect': 'cubes'}">
    <div class="loading-overlay">
        <div class="bounce-loader">
            <div class="cssload-thecube">
                <div class="cssload-cube cssload-c1"></div>
                <div class="cssload-cube cssload-c2"></div>
                <div class="cssload-cube cssload-c4"></div>
                <div class="cssload-cube cssload-c3"></div>
            </div>
        </div>
    </div>
    <div class="body">
        @include("front.layouts.includes.header")
        <div role="main" class="main">
            @yield("content")
        </div>

        <footer id="footer" class="mt-0">
            <div class="container my-4">
                <div class="row py-5">
                    <div class="col-md-6 col-lg-3 mb-5 mb-lg-0">
                        <h5 class="text-5 text-transform-none font-weight-semibold text-color-light mb-4">Contact Details</h5>
                        <p class="text-4 mb-0">123 Porto Blvd, Suite 100</p>
                        <p class="text-4 mb-0">New York, NY</p>
                        <p class="text-4 mb-0">Phone: <a href="tel:0123456789" class="text-decoration-none">(800) 123 4567</a></p>
                        <p class="text-4 mb-0">Email: <a href="mailto:mail@example.com" class="text-color-primary text-color-hover-light">mail@example.com</a></p>
                    </div>
                    <div class="col-6 col-lg-2 mb-5 mb-lg-0">
                        <h5 class="text-5 text-transform-none font-weight-semibold text-color-light mb-4">Pages</h5>
                        <ul class="list list-icons list-icons-sm">
                            <li><i class="fas fa-angle-right"></i><a href="page-services.html" class="link-hover-style-1 ms-1"> Our Services</a></li>
                            <li><i class="fas fa-angle-right"></i><a href="about-us.html" class="link-hover-style-1 ms-1"> About Us</a></li>
                            <li><i class="fas fa-angle-right"></i><a href="contact-us.html" class="link-hover-style-1 ms-1"> Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-lg-2 mb-5 mb-lg-0">
                        <h5 class="text-5 text-transform-none font-weight-semibold text-color-light mb-4">Links</h5>
                        <ul class="list list-icons list-icons-sm">
                            <li><i class="fas fa-angle-right"></i><a href="page-faq.html" class="link-hover-style-1 ms-1"> FAQ's</a></li>
                            <li><i class="fas fa-angle-right"></i><a href="sitemap.html" class="link-hover-style-1 ms-1"> Sitemap</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-lg-5">
                        <h5 class="text-5 text-transform-none font-weight-semibold text-color-light mb-4">Latest Tweet</h5>
                        <div id="tweet" class="twitter" data-plugin-tweets data-plugin-options="{'username': 'oklerthemes', 'count': 1}">
                            <p>Please wait...</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-copyright footer-copyright-style-2">
                <div class="container py-2">
                    <div class="row py-4">
                        <div class="col mb-4 mb-lg-0">
                            <p>© Copyright 2021. All Rights Reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

<!-- Vendor -->
<script src="/front/vendor/jquery/jquery.min.js"></script>
<script src="/front/vendor/jquery.appear/jquery.appear.min.js"></script>
<script src="/front/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="/front/vendor/jquery.cookie/jquery.cookie.min.js"></script>
<script src="/front/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/front/vendor/jquery.validation/jquery.validate.min.js"></script>
<script src="/front/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
<script src="/front/vendor/jquery.gmap/jquery.gmap.min.js"></script>
<script src="/front/vendor/lazysizes/lazysizes.min.js"></script>
<script src="/front/vendor/isotope/jquery.isotope.min.js"></script>
<script src="/front/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="/front/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="/front/vendor/vide/jquery.vide.min.js"></script>
<script src="/front/vendor/vivus/vivus.min.js"></script>

<!-- Theme Base, Components and Settings -->
<script src="/front/js/theme.js"></script>

<!-- Theme Custom -->
<script src="/front/js/custom.js"></script>

<!-- Theme Initialization Files -->
<script src="/front/js/theme.init.js"></script>

@yield("script")

</body>
</html>
