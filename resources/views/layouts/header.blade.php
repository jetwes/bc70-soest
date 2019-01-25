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
                    <a href="{{ route('home') }}" class="ritekhed-logo"> <img src="/images/logo.png" alt=""> </a>
                    <div class="ritekhed-right-head">
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