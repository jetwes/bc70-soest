<footer id="ritekhed-footer" class="ritekhed-footer-one">
    <!-- Footer Widget -->
    <div class="ritekhed-footer-widget">
        <div class="container">
            <div class="row">
                <!-- Widget Footer About -->
                <aside class="widget col-md-4 widget_footer_about">
                    <div class="footer-widget-title"> <h2>Postanschrift</h2> </div>
                    <ul class="ritekhed-social-network">
                        <li><a href="https://www.facebook.com/Bc70Soest" class="ritekhed-colorhover fab fa-facebook"></a></li>
                        <li><a href="https://twitter.com/bc70soest" class="ritekhed-colorhover fab fa-twitter-square"></a></li>
                    </ul>
                    <ul class="ritekhed-info-list">
                        <li><i class="fa fa-map-marker-alt"></i> <span>An der Landwehr 20</span></li>
                        <li><i class="fa fa-phone"></i> <span>59494 Soest</span></li>
                        <li><i class="far fa-envelope"></i> <span><a href="mailto:info@bc70-soest.de">info@bc70-soest.de</a></span></li>
                    </ul>
                    <div class="bg-white ritekhed-info-list" style="margin-top: 20px; padding: 10px;">
                        <h2 class="text-lg-left">Unterstütze den BC70 und setze den BC70 als Organisation bei amazon smile </h2>
                        <a href="https://smile.amazon.de/ch/343-584-61674"><img src="/images/Amazon-Smile-01.png" alt="Amazon Smile"></a>
                    </div>

                </aside>
                <!-- Widget Footer About -->
                <!-- Widget Featured News -->
                <aside class="widget col-md-4 widget_featured_news">
                    <div class="footer-widget-title"> <h2>Spielzeiten</h2> </div>
                    <ul>
                        <li>
                            <span>01</span>
                            <h6><a href="#">Senioren</a></h6>
                            <time datetime="">Samstags 17:30 und 19:30 Uhr</time>
                        </li>
                        <li>
                            <span>02</span>
                            <h6><a href="#">Junioren</a></h6>
                            <time datetime="">Sonntags 10-18 Uhr</time>
                        </li>
                    </ul>
                    <a href="{{ route('home') }}" class="footer-logo"><img  style="height: 150px;" src="/images/bc70-logo-trans.png" alt="BC70 Logo transparent"></a>

                </aside>
                <!-- Widget Featured News -->
                <!-- Widget Gallery -->
                <aside class="widget col-md-4 widget_gallery">
                    <div class="footer-widget-title"> <h2>Förderpreis</h2> </div>
                    <ul>
                        <li style="width: 100% !important;"><a data-fancybox-group="group" href="#" class="fancybox"><img src="/images/wbv_fp.jpg" alt=""></a></li>
                        <li style="width: 100% !important;"><a data-fancybox-group="group" href="#" class="fancybox"><img src="/images/einsatz_im_sport.jpg" alt=""></a></li>
                    </ul>
                </aside>
                <!-- Widget Gallery -->
            </div>
            <a href="#" class="ritekhed-back-top"><i class="fa fa-angle-up"></i></a>
        </div>
    </div>
    <!-- Footer Widget -->

    <!-- CopyRight -->
    <div class="ritekhed-copyright">
        <div class="container">
            <div class="row">
                <aside class="col-md-6"><p>© {{ \Carbon\Carbon::now()->year }}, Alle Rechte vorbehalten - <a href="https://www.star-media.biz">Jens Twesmann, Star Media GmbH</a></p></aside>
                <aside class="col-md-6">
                    <ul class="ritekhed-copyright-link">
                        <li><a href="{{ route('impress') }}">Impressum</a></li>
                        <li><a href="{{ route('privacy') }}">Datenschutz</a></li>
                    </ul>
                </aside>
            </div>
        </div>
    </div>
    <!-- CopyRight -->

</footer>
