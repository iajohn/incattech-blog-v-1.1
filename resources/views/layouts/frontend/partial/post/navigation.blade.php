<div class="row">
	<div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
	    @if($prev)
	        <div class="thumb">
	            <a href="{{ route('post.details', $prev->slug) }}" title="{{ $prev->title }}">
	                <!-- <img class="img-fluid" src="img/blog/prev.jpg" alt=""> -->
	                <img src="{{ asset('assets/uploads/post/thumb/'.$prev->featuredImg) }}" alt="{{ $prev->title }}" title="{{ $prev->title }}">
	            </a>
	        </div>
	        <div class="arrow">
	            <a href=""><span class="lnr text-white lnr-arrow-left"></span></a>
	        </div>
	        <div class="detials">
	            <p>Prev Post</p>
	            <a href="{{ route('post.details', $prev->slug) }}" title="{{ $prev->title }}">
	                <h4>{{ $prev->title }}</h4>
	            </a>
	        </div>
	    @endif
	</div>

	<div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
	    @if($next)
	        <div class="detials">
	            <p>Next Post</p>
	            <a href="{{ route('post.details', $next->slug) }}" title="{{ $next->title }}">
	                <h4>{{ $next->title }}</h4>
	            </a>
	        </div>
	        <div class="arrow">
	            <a href=""><span class="lnr text-white lnr-arrow-right"></span></a>
	        </div>
	        <div class="thumb">
	            <a href="{{ route('post.details', $next->slug) }}" title="{{ $next->title }}">
	                <img src="{{ asset('assets/uploads/post/thumb/'.$next->featuredImg) }}" alt="{{ $next->title }}" title="{{ $next->title }}">
	            </a>
	        </div>
	    @endif
	</div>
</div>