<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="apple-mobile-web-app-status-bar-style" content="#4b0082" />
        <meta name="apple-mobile-web-app-title" content="Tiểu Thuyết" />
        <link rel="shortcut icon" type="image/x-icon" href="https://tieuthuyet.vn/favicon.ico" />
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="https://tieuthuyet.vn/fav/apple-touch-icon-144x144.png" />
        <link rel="icon" type="image/png" href="https://tieuthuyet.vn/fav/favicon-196x196.png" sizes="196x196" />
        <link rel="icon" type="image/png" href="https://tieuthuyet.vn/fav/favicon-96x96.png" sizes="96x96" />
        <link rel="icon" type="image/png" href="https://tieuthuyet.vn/fav/favicon-32x32.png" sizes="32x32" />
        <link rel="icon" type="image/png" href="https://tieuthuyet.vn/fav/favicon-16x16.png" sizes="16x16" />
        <meta name="msapplication-TileColor" content="#FFFFFF" />
        <meta name="msapplication-TileImage" content="fav/apple-touch-icon-144x144.png" />
        <meta name = "theme-color" content = "#4b0082" />
        <title>@yield('title')</title>
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
        @yield('seo')
        {!! \App\Option::getvalue('pageheader') !!}
        <meta name="google-site-verification" content="{!! \App\Option::getvalue('google_veri') !!}" />
        <meta name="facebook-domain-verification" content="8c3c33i5c2r48f3pwjr48uv7wd5ty7" />
        <meta property="fb:admins" content="{{\App\Option::getvalue('fb_admin_id')}}" />
        <meta property="fb:app_id" content="{{\App\Option::getvalue('fb_app')}}" />
        <!-- Google Tag Manager -->
        <!-- <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-5MPR87P');</script> -->
        <!-- End Google Tag Manager -->
        <script src="https://apis.google.com/js/platform.js" async defer>
        {lang: 'vi'}
        </script>
        <script data-ad-client="ca-pub-6827872033566527" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-192250782-1"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-192250782-1');
        </script>

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-D9D7J5E3QJ"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-D9D7J5E3QJ');
        </script>
    </head>
    <body>
        <!-- Google Tag Manager (noscript) -->
        <!-- <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5MPR87P"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> -->
        <!-- End Google Tag Manager (noscript) -->
        {{--Facebook--}}
        <div id="fb-root"></div>

        <div class="wrapper" id="backOnTop">
        @include('partials.navibar')

        <div class="ads container">
            {!! \App\Option::getvalue('ads_header') !!}
        </div>

        @yield('content')

            <!-- Footer -->
            <div class="clearfix"></div>
            <div class="ads container">
                {!! \App\Option::getvalue('ads_footer') !!}
                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <ins class="adsbygoogle"
                    style="display:block"
                    data-ad-format="fluid"
                    data-ad-layout-key="-gv-4+19-50+7o"
                    data-ad-client="ca-pub-6827872033566527"
                    data-ad-slot="7723761327"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>

            <div class="footer">
                <div class="container">
                    <div class="hidden-xs col-sm-5">
                        {!! \App\Option::getvalue('copyright') !!}
                    </div>
                    <ul class="col-xs-12 col-sm-7 list-unstyled">
                        <li class="text-right pull-right">
                            <a href="{{url('contact')}}" title="Liên hệ">Liên hệ</a> - <a href="{{url('tos')}}" title="Terms of Service">Điều khoản</a> <a class="backtop" href="#backOnTop" rel="nofollow"><span class="glyphicon glyphicon-upload"></span></a>
                        </li>
                        <li class="hidden-xs tag-list"></li>
                    </ul>
                </div>
            </div>
        </div> <!-- #Wrapper -->

        <!-- Jquery -->
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <!-- bootstrap -->
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <!-- My Script -->
        <script src="{{ asset('assets/js/dinhquochan.js') }}"></script>
        <div class="container">
            {!! \App\Option::getvalue('pagefooter') !!}
        </div>
    </body>
</html>