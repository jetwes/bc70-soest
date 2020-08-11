<!-- Header -->
<div id="ritekhed-header" class="ritekhed-header-one">

    <!-- Top Strip -->
    <div class="ritekhed-top-strip ritekhed-bgcolor-two">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="ritekhed-top-strip-social">
                        <li><a href="https://www.facebook.com/Bc70Soest" class="fab fa-facebook-f"></a></li>
                        <li><a href="https://www.twitter.com/bc70soest" class="fab fa-twitter"></a></li>
                    </ul>
                    {!! $header_menu !!}
                </div>
            </div>
        </div>
    </div>
    <!-- Top Strip -->

    <!-- Main Header -->
    <div class="ritekhed-main-header ritekhed-border-color">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('home') }}" class="ritekhed-logo d-none d-sm-block"> <img src="/images/logo.png" alt="BC70 Soest Logo"> </a>
                    <a href="{{ route('home') }}" class="d-block d-sm-none"> <img src="/images/logo.png" alt="BC70 Soest Logo" width="60%" style="float: left; margin-top: 5px;"> </a>
                    <a href="https://www.umzug-hitzke.de" class="hidden-xs hidden-sm d-none d-sm-block" title="Hauptsponsor Umzug Hitzke" style="color: #fff; float: right; margin-top: 27px;"> Hauptsponsor <br><img src="/images/Hitzke_Logo_quer.jpg" alt="Umzug Hitzke" width="200px"></a>
                    <a href="https://www.umzug-hitzke.de" class="hidden-xs hidden-sm d-block d-sm-none"  title="Hauptsponsor Umzug Hitzke" style="color: #fff; float: right; margin-top: 5px;">Hauptsponsor <br> <img src="/images/Hitzke_Logo_quer.jpg" alt="Umzug Hitzke" width="80px"> </a>
                    <div class="ritekhed-right-head d-block d-sm-none" style="position: absolute !important; right: 5px; top: 40px;">
                                <span class="ritekhed-menu-link">
                                    <span class="menu-bar"></span>
                                    <span class="menu-bar"></span>
                                    <span class="menu-bar"></span>
                                </span>
                        <nav id="main-nav">
                            {!! $menu !!}
                        </nav>
                    </div>
                    <div class="ritekhed-right-head d-none d-sm-block">
                                <span class="ritekhed-menu-link">
                                    <span class="menu-bar"></span>
                                    <span class="menu-bar"></span>
                                    <span class="menu-bar"></span>
                                </span>
                        <nav id="main-nav">
                            {!! $menu !!}
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Main Header -->

</div>
<!-- Header -->
