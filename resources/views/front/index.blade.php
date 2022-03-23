@extends("front.layouts.layout")

@section("css")

@endsection

@section("content")
    <div class="owl-carousel owl-carousel-light owl-carousel-light-init-fadeIn owl-theme manual dots-inside dots-horizontal-center show-dots-hover dots-light nav-style-1 nav-inside nav-inside-plus nav-dark nav-lg nav-font-size-lg show-nav-hover mb-0" data-plugin-options="{'autoplayTimeout': 7000}" style="height: calc(100vh - 155px);">
        <div class="owl-stage-outer">
            <div class="owl-stage">

                <!-- Carousel Slide 1 -->
                <div class="owl-item position-relative overlay overlay-show overlay-op-7" style="background-image: url(img/slides/slide-corporate-4-1.jpg); background-size: cover; background-position: center;">
                    <div class="container position-relative z-index-3 h-100">
                        <div class="row justify-content-center align-items-center h-100">
                            <div class="col-lg-7 text-center">
                                <div class="d-flex flex-column align-items-center justify-content-center h-100">
                                    <h3 class="position-relative text-color-light text-5 line-height-5 font-weight-medium ls-0 px-4 mb-2 appear-animation" data-appear-animation="fadeInDownShorterPlus" data-plugin-options="{'minWindowWidth': 0}">
                                                        <span class="position-absolute right-100pct top-50pct transform3dy-n50 opacity-7">
                                                            <img src="img/slides/slide-title-border-light.png" class="w-auto appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="250" data-plugin-options="{'minWindowWidth': 0}" alt="" />
                                                        </span>
                                        GET TO MEET SIMPLY
                                        <span class="position-absolute left-100pct top-50pct transform3dy-n50 opacity-7">
                                                            <img src="img/slides/slide-title-border-light.png" class="w-auto appear-animation" data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="250" data-plugin-options="{'minWindowWidth': 0}" alt="" />
                                                        </span>
                                    </h3>
                                    <h1 class="text-color-light font-weight-extra-bold text-12-5 line-height-3 mb-2 appear-animation" data-appear-animation="blurIn" data-appear-animation-delay="500" data-plugin-options="{'minWindowWidth': 0}">THE BEST HTML TEMPLATE</h1>
                                    <p class="text-4-5 text-color-light font-weight-light opacity-7 text-center mb-5 px-lg-5" data-plugin-animated-letters data-plugin-options="{'startDelay': 1000, 'minWindowWidth': 0, 'animationSpeed': 30}">Trusted by over <strong class="text-color-light">40,000</strong> satisfied users, Porto is a huge success in the one of largest world's MarketPlace</p>
                                    <a href="#" class="btn btn-light btn-outline btn-rounded text-color-light text-color-hover-dark font-weight-bold text-3 btn-px-5 py-3 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="2500" data-plugin-options="{'minWindowWidth': 0}">GEST STARTED NOW!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Carousel Slide 2 -->
                <div class="owl-item position-relative overlay overlay-show overlay-op-7" style="background-image: url(img/slides/slide-corporate-4-2.jpg); background-size: cover; background-position: center;">
                    <div class="container position-relative z-index-3 h-100">
                        <div class="row justify-content-center align-items-center h-100">
                            <div class="col-lg-7 text-center">
                                <div class="d-flex flex-column align-items-center justify-content-center h-100">
                                    <h3 class="position-relative text-color-light text-5 line-height-5 font-weight-medium ls-0 px-4 mb-2 appear-animation" data-appear-animation="fadeInDownShorterPlus" data-plugin-options="{'minWindowWidth': 0}">
                                                        <span class="position-absolute right-100pct top-50pct transform3dy-n50 opacity-7">
                                                            <img src="img/slides/slide-title-border-light.png" class="w-auto appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="250" data-plugin-options="{'minWindowWidth': 0}" alt="" />
                                                        </span>
                                        WE ARE DESIGN
                                        <span class="position-absolute left-100pct top-50pct transform3dy-n50 opacity-7">
                                                            <img src="img/slides/slide-title-border-light.png" class="w-auto appear-animation" data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="250" data-plugin-options="{'minWindowWidth': 0}" alt="" />
                                                        </span>
                                    </h3>
                                    <h1 class="text-color-light font-weight-extra-bold text-12-5 line-height-3 mb-2 appear-animation" data-appear-animation="blurIn" data-appear-animation-delay="500" data-plugin-options="{'minWindowWidth': 0}">SPECIALISTS</h1>
                                    <p class="text-4-5 text-color-light font-weight-light opacity-7 text-center mb-5 px-lg-5" data-plugin-animated-letters data-plugin-options="{'startDelay': 1000, 'minWindowWidth': 0, 'animationSpeed': 30}">Designers thinking outside the box, learn more about us.</p>
                                    <a href="#" class="btn btn-light btn-outline btn-rounded text-color-light text-color-hover-dark font-weight-bold text-3 btn-px-5 py-3 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="2500" data-plugin-options="{'minWindowWidth': 0}">GEST STARTED NOW!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="owl-dots mb-5">
            <button role="button" class="owl-dot active"><span></span></button>
            <button role="button" class="owl-dot"><span></span></button>
        </div>
    </div>

    <div class="container my-5 py-3" id="main">
        <div class="row pt-4">
            <div class="col-lg-4 appear-animation" data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="200">
                <div class="feature-box feature-box-style-2">
                    <div class="feature-box-icon">
                        <i class="icon-user-following icons"></i>
                    </div>
                    <div class="feature-box-info">
                        <h4 class="font-weight-bold mb-2">Customer Support</h4>
                        <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing metus elit. Quisque rutrum pellentesque imperdiet.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 appear-animation" data-appear-animation="fadeIn">
                <div class="feature-box feature-box-style-2">
                    <div class="feature-box-icon">
                        <i class="icon-layers icons"></i>
                    </div>
                    <div class="feature-box-info">
                        <h4 class="font-weight-bold mb-2">Sliders</h4>
                        <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rutrum pellentesque imperdiet. Nulla lacinia iaculis nulla.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="200">
                <div class="feature-box feature-box-style-2">
                    <div class="feature-box-icon">
                        <i class="icon-calculator icons"></i>
                    </div>
                    <div class="feature-box-info">
                        <h4 class="font-weight-bold mb-2">HTML5</h4>
                        <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rutrum pellentesque imperdiet. Nulla lacinia iaculis nulla.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-lg-3">
            <div class="col-lg-4">
                <div class="feature-box feature-box-style-2 appear-animation" data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="300">
                    <div class="feature-box-icon">
                        <i class="icon-star icons"></i>
                    </div>
                    <div class="feature-box-info">
                        <h4 class="font-weight-bold mb-2">Icons</h4>
                        <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing metus elit. Quisque rutrum pellentesque imperdiet.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="feature-box feature-box-style-2 appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="100">
                    <div class="feature-box-icon">
                        <i class="icon-drop icons"></i>
                    </div>
                    <div class="feature-box-info">
                        <h4 class="font-weight-bold mb-2">Colors</h4>
                        <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rutrum pellentesque imperdiet. Nulla lacinia iaculis nulla.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="300">
                <div class="feature-box feature-box-style-2">
                    <div class="feature-box-icon">
                        <i class="icon-mouse icons"></i>
                    </div>
                    <div class="feature-box-info">
                        <h4 class="font-weight-bold mb-2">Buttons</h4>
                        <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rutrum pellentesque imperdiet. Nulla lacinia iaculis nulla.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-lg-3">
            <div class="col-lg-4 appear-animation" data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="400">
                <div class="feature-box feature-box-style-2">
                    <div class="feature-box-icon">
                        <i class="icon-screen-desktop icons"></i>
                    </div>
                    <div class="feature-box-info">
                        <h4 class="font-weight-bold mb-2">Lightboxes</h4>
                        <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing metus elit. Quisque rutrum pellentesque imperdiet.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="200">
                <div class="feature-box feature-box-style-2">
                    <div class="feature-box-icon">
                        <i class="icon-energy icons"></i>
                    </div>
                    <div class="feature-box-info">
                        <h4 class="font-weight-bold mb-2">Elements</h4>
                        <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rutrum pellentesque imperdiet. Nulla lacinia iaculis nulla.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="400">
                <div class="feature-box feature-box-style-2">
                    <div class="feature-box-icon">
                        <i class="icon-social-youtube icons"></i>
                    </div>
                    <div class="feature-box-info">
                        <h4 class="font-weight-bold mb-2">Videos</h4>
                        <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rutrum pellentesque imperdiet. Nulla lacinia iaculis nulla.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="section section-height-3 bg-color-grey-scale-1 border-0 m-0 appear-animation" data-appear-animation="fadeIn">
        <div class="container">
            <div class="row">
                <div class="col appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="200">

                    <div class="owl-carousel owl-theme nav-bottom rounded-nav mb-0" data-plugin-options="{'items': 1, 'loop': false, 'autoHeight': true}">
                        <div>
                            <div class="testimonial testimonial-style-2 testimonial-with-quotes testimonial-quotes-dark mb-0">
                                <div class="testimonial-author">
                                    <img src="img/clients/client-1.jpg" class="img-fluid rounded-circle" alt="">
                                </div>
                                <blockquote>
                                    <p class="text-color-dark text-5 line-height-5 mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eget risus porta, tincidunt turpis at, interdum tortor. Suspendisse potenti. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Fusce ante tellus, convallis non consectetur sed, pharetra nec ex.</p>
                                </blockquote>
                                <div class="testimonial-author">
                                    <p><strong class="font-weight-extra-bold text-2">- John Smith. Okler</strong></p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="testimonial testimonial-style-2 testimonial-with-quotes testimonial-quotes-dark mb-0">
                                <div class="testimonial-author">
                                    <img src="img/clients/client-1.jpg" class="img-fluid rounded-circle" alt="">
                                </div>
                                <blockquote>
                                    <p class="text-color-dark text-5 line-height-5 mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eget risus porta, tincidunt turpis at, interdum tortor. Suspendisse potenti. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                </blockquote>
                                <div class="testimonial-author">
                                    <p><strong class="font-weight-extra-bold text-2">- John Smith. Okler</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-6 p-0">
                <section class="section section-height-3 section-primary h-100 m-0 border-0">
                    <div class="row justify-content-end m-0">
                        <div class="col-half-section col-half-section-right mb-5 appear-animation" data-appear-animation="fadeInRightShorter">
                            <h2 class="text-light text-7">Latest <strong>Posts</strong></h2>
                            <div class="row recent-posts">
                                <div class="col-md-6 mb-4 mb-md-0">
                                    <article>
                                        <div class="row">
                                            <div class="col-auto pe-0">
                                                <div class="date">
                                                    <span class="day bg-color-light text-color-dark font-weight-extra-bold">15</span>
                                                    <span class="month bg-color-light font-weight-semibold text-color-primary text-1">JAN</span>
                                                </div>
                                            </div>
                                            <div class="col ps-1">
                                                <h4 class="font-weight-normal line-height-3 text-4"><a href="blog-post.html" class="text-light">Lorem ipsum dolor sit amet, consectetur</a></h4>
                                                <p class="text-color-light line-height-5 opacity-6 pe-4 mb-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                <a href="/" class="read-more text-color-light font-weight-semibold text-2">read more <i class="fas fa-chevron-right text-1 ms-1"></i></a>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                <div class="col-md-6">
                                    <article>
                                        <div class="row">
                                            <div class="col-auto pe-0">
                                                <div class="date">
                                                    <span class="day bg-color-light text-color-dark font-weight-extra-bold">14</span>
                                                    <span class="month bg-color-light font-weight-semibold text-color-primary text-1">JAN</span>
                                                </div>
                                            </div>
                                            <div class="col ps-1">
                                                <h4 class="font-weight-normal line-height-3 text-4"><a href="blog-post.html" class="text-light">Lorem ipsum dolor sit amet, consectetur</a></h4>
                                                <p class="text-color-light line-height-5 opacity-6 pe-4 mb-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                <a href="/" class="read-more text-color-light font-weight-semibold text-2">read more <i class="fas fa-chevron-right text-1 ms-1"></i></a>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="col-lg-6 p-0">
                <section class="section section-height-3 section-secondary h-100 m-0 border-0">
                    <div class="row m-0 mt-lg-5 pt-lg-2">
                        <div class="col-half-section mb-5 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="400">
                            <div class="row counters counters-sm counters-text-light">
                                <div class="col-md-6 mb-5">
                                    <div class="counter">
                                        <strong class="font-weight-extra-bold" data-to="40000" data-append="+">0</strong>
                                        <label class="opacity-5 text-4 mt-1">Happy Clients</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-5">
                                    <div class="counter">
                                        <strong class="font-weight-extra-bold" data-to="3500" data-append="+">0</strong>
                                        <label class="opacity-5 text-4 mt-1">Answered Tickets</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-5 mb-md-0">
                                    <div class="counter">
                                        <strong class="font-weight-extra-bold" data-to="16">0</strong>
                                        <label class="opacity-5 text-4 mt-1">Pre-made Demos</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="counter">
                                        <strong class="font-weight-extra-bold" data-to="3000" data-append="+">0</strong>
                                        <label class="opacity-5 text-4 mt-1">Development Hours</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

        </div>
    </div>

    <div class="container">
        <div class="row py-5 my-5">
            <div class="col">

                <div class="owl-carousel owl-theme mb-0" data-plugin-options="{'responsive': {'0': {'items': 1}, '476': {'items': 1}, '768': {'items': 5}, '992': {'items': 7}, '1200': {'items': 7}}, 'autoplay': true, 'autoplayTimeout': 3000, 'dots': false}">
                    <div>
                        <img class="img-fluid opacity-2" src="img/logos/logo-1.png" alt="">
                    </div>
                    <div>
                        <img class="img-fluid opacity-2" src="img/logos/logo-2.png" alt="">
                    </div>
                    <div>
                        <img class="img-fluid opacity-2" src="img/logos/logo-3.png" alt="">
                    </div>
                    <div>
                        <img class="img-fluid opacity-2" src="img/logos/logo-4.png" alt="">
                    </div>
                    <div>
                        <img class="img-fluid opacity-2" src="img/logos/logo-5.png" alt="">
                    </div>
                    <div>
                        <img class="img-fluid opacity-2" src="img/logos/logo-6.png" alt="">
                    </div>
                    <div>
                        <img class="img-fluid opacity-2" src="img/logos/logo-4.png" alt="">
                    </div>
                    <div>
                        <img class="img-fluid opacity-2" src="img/logos/logo-2.png" alt="">
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section("script")

@endsection
