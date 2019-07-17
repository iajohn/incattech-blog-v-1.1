<footer class="footer-area section-gap-top">
    <div class="container">
        <div class="row pb-10">
            <div class="col-lg-3 col-md-6">
                <div class="single-footer-widget">
                    <div class="mb-40 footer-brand">
                        <img src="{{ asset('assets/frontend/themes/img/incattech/logo.png') }}" alt="">
                    </div>
                    <p style="text-align: justify;">
                        @foreach($company as $setting)
                            {!! str_limit($setting->about_body, $limit = 300, $end = ' '.'...') !!} </p>
                        @endforeach
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="single-footer-widget">
                    <h6 class="heading">Quick Links</h6>
                    <div class="row">
                        <ul class="col footer-nav">
                            <li><a href="{{ route('sitemap') }}" target="_blank">Sitemaps</a></li>
                            <li><a href="{{ route('post.index') }}" target="_blank">Posts</a></li>
                            <li><a href="{{ route('tv') }}" target="_blank">Tv</a></li>
                            <li><a href="{{ route('archives.index') }}" target="_blank">Archives</a></li>
                            <!-- <li><a href="#" target="_blank">Advertise</a></li>
                            <li><a href="#" target="_blank">Ad Choice</a></li> -->
                        </ul>
                        <ul class="col footer-nav">
                            <li><a href="{{ route('about') }}" target="_blank">About Us</a></li>
                            <li><a href="{{ route('contact') }}" target="_blank">Contact Us</a></li>
                            <li><a href="{{ route('policy') }}" target="_blank">Privacy Policy</a></li>
                            <li><a href="{{ route('terms') }}" target="_blank">Terms of Use</a></li>
                            <!-- <li><a href="#" target="_blank">Newsletters</a></li> -->
                        </ul>
                    </div>
                </div>
            </div> 

            <div class="col-lg-3 col-md-6">
                <div class="single-footer-widget mail-chimp">
                    <h6 class="heading">Popular Tags</h6>
                    <div class="block-body">
                        <ul class="tags">
                            <?php $count = 0;?>
                            @foreach($tags as $systemTag)
                                @if($count == 10)  @break; @endif
                                    <li>
                                        <a href="{{ route('tag.posts', $systemTag->slug) }}" class="btn primary-btn">
                                            {{ $systemTag->name }}
                                        </a>
                                    </li>
                                <?php $count++; ?>
                            @endforeach
                        </ul>
                        <a href="{{ route('archives.index') }}" class="btn primary-btn btn-sm">view all</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="single-footer-widget mail-chimp">
                    <h6 class="heading">Recent Tweets</h6>
                    <div class="footer-news">
                        <div class="single-news d-flex">
                            <a class="twitter-timeline" data-width="" data-height="350" data-theme="dark"
                               data-link-color="#E95F28" href="https://twitter.com/incattech?ref_src=twsrc%5Etfw">{{ __('Tweets by incattech')}}
                            </a>
                            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="copyright-text">
        <div class="container">
            <div class="row footer-bottom d-flex justify-content-between">
                <p class="col-lg-8 col-sm-6 footer-text m-0 text-white"><!-- Link back to Colorlib can't    be removed. Template is licensed under CC BY 3.0. -->

                    COPYRIGHT &copy; @foreach($company as $setting) {{ $setting->name }} @endforeach <script>document.write(new Date().getFullYear());</script> 
                    All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by 
                    <a href="https://colorlib.com" target="_blank">Colorlib</a> Designed by @foreach($company as $setting) {{ $setting->name }} @endforeach.
                </p>
                @foreach($company as $company)
                    <div class="col-lg-4 col-sm-6 footer-social">
                        <a href="{{ $company->facebook }}" target="_blank" title="visit {{ $company->name }} Facebook Page">
                            <i class="fa fa-facebook"></i>
                        </a>

                        <a href="{{ $company->instagram }}" target="_blank" title="visit {{ $company->name }} Instagram Account">
                            <i class="fa fa-instagram"></i>
                        </a>

                        <a href="{{ $company->twitter }}" target="_blank" title="visit {{ $company->name }} Twitter Account">
                            <i class="fa fa-twitter"></i>
                        </a>

                        <a href="{{ $company->youtube }}" target="_blank" title="Visit {{ $company->name }} YouTube Channel">
                            <i class="fa fa-youtube-play"></i>
                        </a>

                        <a href="{{ $company->whatsapp }}" target="_blank" title="visit {{ $company->name }}'s WhatsApp">
                            <i class="fa fa-whatsapp"></i>
                        </a>
                    </div>
                @endforeach
                <!-- <div class="col-lg-4 col-sm-6 footer-social">
                    <a href="{{ $settings->find(9)->val }}" target="_blank"><i class="fa fa-facebook"></i></a>
                    <a href="{{ $settings->find(10)->val }}" target="_blank"><i class="fa fa-instagram"></i></a>
                    <a href="{{ $settings->find(11)->val }}" target="_blank"><i class="fa fa-twitter"></i></a>
                    <a href="{{ $settings->find(12)->val }}" target="_blank"><i class="fa fa-youtube-play"></i></a>
                    <a href="{{ $settings->find(13)->val }}" target="_blank"><i class="fa fa-whatsapp"></i></a>
                </div> -->
            </div>
        </div>
    </div>
</footer>