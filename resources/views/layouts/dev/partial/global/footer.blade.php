<!-- footer -->
<footer>
    <div class="row">
        <div class="large-3 medium-6 columns">
            <div class="widgetBox">
                <div class="widgetTitle">
                    <h5>About</h5>
                </div>
                <div class="textwidget">
                    @foreach($company as $setting)
                        {!! str_limit($setting->about_body, $limit = 300, $end = ' '.'...') !!} </p>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="large-6 medium-6 columns">
            <div class="widgetBox">
                <div class="widgetTitle">
                    <h5>Tags</h5>
                </div>
                <div class="tagcloud">
                    <?php $count = 0;?>
                    @foreach(getAllVideoTags() as $systemTag)
                        @if($count == 20)  @break; @endif
                        <a href="{{ url('/tv/tag/' . $systemTag) }}">{{ $systemTag }}</a>
                        <?php $count++; ?>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="large-3 medium-6 columns">
            <div class="widgetBox">
                <div class="widgetTitle">
                    <h5>Subscribe Now</h5>
                </div>
                <div class="widgetContent">
                    <form data-abide novalidate action="{{ url('/register') }}" method="get">
                        <button class="button" type="submit" value="Submit">Sign up Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <a href="#" id="back-to-top" title="Back to top"><i class="fa fa-angle-double-up"></i></a>
</footer><!-- footer -->
<div id="footer-bottom" style="display: none;"></div>