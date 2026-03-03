<!-- FOOTER -->
<footer>
    <div class="gallery-f-widget">
        <a href="#" class="follw-i-btn bb-btn main-color-bg center">
            <i class="fa fa-instagram"></i> INSTAGRAM
        </a>
        <div class="single-g-pic">
            <a href="#">
                <img src="img/fg-pic-1.jpg" alt="fgallery-pic-1">
            </a>
        </div>
        <div class="single-g-pic">
            <a href="#">
                <img src="img/fg-pic-2.jpg" alt="fgallery-pic-2">
            </a>
        </div>
        <div class="single-g-pic">
            <a href="#">
                <img src="img/fg-pic-3.jpg" alt="fgallery-pic-3">
            </a>
        </div>
        <div class="single-g-pic">
            <a href="#">
                <img src="img/fg-pic-4.jpg" alt="fgallery-pic-4">
            </a>
        </div>
        <div class="single-g-pic">
            <a href="#">
                <img src="img/fg-pic-5.jpg" alt="fgallery-pic-5">
            </a>
        </div>
        <div class="single-g-pic">
            <a href="#">
                <img src="img/fg-pic-6.jpg" alt="fgallery-pic-6">
            </a>
        </div>
    </div>

    <div class="text-f-widget">
        <div class="container">
            <div class="brand-header">
                <h1 class="site-title">
                    <a href="#">Velotemka</a>
                </h1>
            </div>
        </div>
    </div>

    <div class="copy-right-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-xs-12">
                    <p class="copyright-txt">© Copyright 2018. Powered by PhyDev.</p>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <ul class="footer-list">
                        <li class="main-color"><a href="#" class="effect">Travel</a></li>
                        <li class="main-color"><a href="#" class="effect">Fashion</a></li>
                        <li class="main-color"><a href="#" class="effect">Lifestyle</a></li>
                        <li class="main-color"><a href="#" class="effect">Tech</a></li>
                        <li class="main-color"><a href="#" class="effect">Music</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- / FOOTER -->
<!-- MODALS -->
<div class="modal" id="search-modal" tabindex="-1" role="dialog">
    <a href="#" class="modal-cls" class="close" data-dismiss="modal" aria-label="Close">
        <span></span>
        <span></span>
    </a>
    <div class="modal-content">
        <div class="search-widget center">
            <form class="search-form">
                <label class="sr-only" for="search-input">Поиск ...</label>
                <input type="text" name="search" id="search-input" placeholder="Поиск ...">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
    </div>
</div>
<!-- / MODALS -->
<a class="scroll-up" href="#top"><i class="fa fa-angle-up"></i></a>
<!-- SCRIPTS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="libs/bootstrap4/js/bootstrap.min.js"></script>
<script src="libs/owlcarousel2/dist/owl.carousel.min.js"></script>
<script src="libs/match-height/dist/jquery.matchHeight-min.js"></script>
<script src="libs/fancybox/dist/jquery.fancybox.min.js"></script>
<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $('.eqh').matchHeight();
        $("[data-fancybox]").fancybox();
        $(".mobile-button").click(function(e) {
            e.preventDefault();
            $('.mobile-nav').toggleClass("active");
        });
        $('.navbar-toggle').click(function(e){
            e.preventDefault();
            $(".mobile-menu").toggleClass('pushy-right');
        });
        $(".mobile-menu .close-btn").click(function(e){
            $(".mobile-menu").toggleClass('pushy-right');
        });
        $(function() {
            $(window).scroll(function() {
                if ($(this).scrollTop() != 0) {
                    if ($('.scroll-up').hasClass('show-up-btn')) {
                        // TODO: bang!
                    } else {
                        $('.scroll-up').addClass('show-up-btn');
                    }
                } else {
                    if ($('.scroll-up').hasClass('show-up-btn')) {
                        $('.scroll-up').removeClass('show-up-btn');
                    } else {
                        // TODO: bang!
                    }
                }
            });
            $('.scroll-up').click(function(e) {
                e.preventDefault();
                $('body,html').animate({
                    scrollTop: 0
                }, 800);
            });
        });
        $('.featured-carousel').owlCarousel({
            loop: false,
            items: 4,
            margin: 0,
            nav: true,
            dots: true,
            navText: ['<div class="f-slider-btn effect ver-center"><i class="fa fa-angle-left"></i></div>', '<div class="f-slider-btn effect ver-center"><i class="fa fa-angle-right"></i></div>'],
            responsive: {
                0: {
                    items: 1,
                    nav: false
                },
                600: {
                    items: 2,
                    nav: false
                },
                1000: {
                    items: 3,
                    nav: false
                },
                1200: {
                    items: 4,
                    nav: true
                }
            }
        });
    });
</script>
