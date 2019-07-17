<!-- <div class="col-lg-3 col-md-3 col-sm-12"> -->
<div class="col-lg-4 col-md-12 col-sm-12">
    <div class="row">
        <aside>
            <ul class="nav nav-tabs nav-justified" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#for-you" data-toggle="tab">
                        <i class="ion-android-star-outline"></i> 
                        {{ __('Recomended') }}
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="#top-post" data-toggle="tab">
                        <i class="ion-ios-chatboxes-outline"></i> 
                        {{ __('Top Post') }}
                    </a>
                </li>
            </ul>
            
            <div class="tab-content">
                <div class="tab-pane active" id="for-you">
                    @if($recomended->count() > 0)
                        @foreach ($recomended as $posts)
                            <!-- <div class="single-post post-body">
                                <article class="article">
                                    <div class="article-img thumb small">
                                        <div class="relative">
                                            <a href="">
                                                <img src="{{ asset('assets/uploads/post/thumb/'.$posts->featuredImg) }}" alt="">
                                            </a>
                                            <div class="overlay overlay-bg"></div>
                                        </div>
                                    </div>
                                    <div class="details article-body">
                                        <h4 class="article-title">
                                            <a href="{{ route('post.details',$posts->slug) }}" title="{{ $posts->title }}">
                                                {{ $posts->title }}
                                            </a>
                                        </h4>
                                    </div>

                                    <ul class="article-info pl-2 pr-2">
                                        <ul class="article-meta">
                                            <li>
                                                <small>
                                                    posted on {{ $posts->created_at->toFormattedDateString() }}
                                                </small>
                                            </li>

                                            <li>
                                                @guest
                                                    <a href="javascript:void(0);" onclick="toastr.info('To add favorite list. You need to login first.','Info',{
                                                        closeButton: true,
                                                        progressBar: true,
                                                    })">
                                                        <span class="lnr lnr-heart"></span> {{ $posts->favorite_to_users->count() }}
                                                    </a>
                                                @else
                                                    <a  href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{ $posts->id }}').submit();"
                                                        class="{{ !Auth::user()->favorite_posts->where('pivot.post_id',$posts->id)->count()  == 0 ? 'favorite_posts' : ''}}">
                                                        <span class="lnr lnr-heart"></span> {{ $posts->favorite_to_users->count() }}
                                                    </a>

                                                    <form id="favorite-form-{{ $posts->id }}" method="POST" action="{{ route('post.favorite',$posts->id) }}" style="display: none;">
                                                        @csrf
                                                    </form>
                                                @endguest
                                            </li>
                                        </ul>
                                        
                                        <span class="fa fa-folder ml-0 mr-0 article-type"></span>
                                        
                                        <li class="ml-0">
                                            @foreach($posts->categories as $cat)
                                                <a href="{{ route('category.posts',$cat->slug) }}" class="pl-1 pr-1">
                                                    {{ $cat->name }}
                                                </a> 
                                            @endforeach
                                        </li>
                                    </ul>
                                </article>
                            </div> -->

                            <div class="single-post post-body">
                                <article class="article-mini article">
                                    <div class="inner">
                                        <figure class="article-img">
                                            <a href="{{ route('post.details', $posts->slug) }}" title="{{ $posts->title }}">
                                                <img src="{{ asset('assets/uploads/post/thumb/'.$posts->featuredImg) }}" alt="{{ $posts->title }}">
                                            </a>
                                        </figure>

                                        <div class="padding">
                                            <h1 title="{{ $posts->title }}">
                                                <a href="{{ route('post.details', $posts->slug ) }}" title="{{ $posts->title }}">
                                                    <p>{!! str_limit($posts->title, $limit = 40, $end = ' '.'...') !!}</p>
                                                </a>
                                            </h1>
                                            <!-- <div class="detail">
                                                <div class="time mr-2">{{ $posts->created_at->toFormattedDateString() }}</div>
                                                <div class="category">
                                                    @foreach($posts->categories as $cat)
                                                        <a href="{{ route('category.posts',$cat->slug) }}" class="pl-1 pr-1">
                                                            {{ $cat->name }}
                                                        </a> 
                                                    @endforeach
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                        @else
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-info text-center">
                                        <p>{{ __('Sorry, there are no recomended posts at the moment!') }}</p>
                                    </div>                   
                                </div>
                            </div>
                    @endif
                    
                    <div class="line"></div>

                    @foreach($moreRecomended as $lmr)
                        <div class="single-post post-body">
                            <article class="article-mini article">
                                <div class="inner">
                                    <figure class="article-img">
                                        <a href="{{ route('post.details', $lmr->slug) }}" title="{{ $lmr->title }}">
                                            <img src="{{ asset('assets/uploads/post/thumb/'.$lmr->featuredImg) }}" alt="{{ $lmr->title }}">
                                        </a>
                                    </figure>

                                    <div class="padding">
                                        <h1 title="{{ $lmr->title }}">
                                            <a href="{{ route('post.details', $lmr->slug ) }}" title="{{ $lmr->title }}">
                                                {!! str_limit($lmr->title, $limit = 40, $end = ' '.'...') !!} </p>
                                            </a>
                                        </h1>
                                        <!-- <div class="detail">
                                            <div class="time mr-2">{{ $lmr->created_at->toFormattedDateString() }}</div>
                                            <div class="category">
                                                @foreach($posts->categories as $cat)
                                                    <a href="{{ route('category.posts',$cat->slug) }}" class="pl-1 pr-1">
                                                        {{ $cat->name }}
                                                    </a> 
                                                @endforeach
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </article>
                        </div>
                    @endforeach
                    

                </div>
                
                <div class="tab-pane fade" id="top-post">
                    @if($mostRead->count() > 0)
                            @foreach ($mostRead as $posts)
                                <div class="single-post post-body">
                                    <article class="article single-post">
                                        <div class="article-img thumb small">
                                            <div class="relative">
                                                <a href="">
                                                    <img src="{{ asset('assets/uploads/post/thumb/'.$posts->featuredImg) }}" alt="">
                                                </a>
                                                <div class="overlay overlay-bg"></div>
                                            </div>
                                        </div>
                                        <div class="details article-body">
                                            <h4 class="article-title">
                                                <a href="{{ route('post.details',$posts->slug) }}">{{ $posts->title }}</a>
                                            </h4>
                                        </div>

                                        <ul class="article-info pl-2 pr-2">
                                            <ul class="article-meta">
                                                <li>
                                                    <small>
                                                        posted on {{ $posts->created_at->toFormattedDateString() }}
                                                    </small>
                                                </li>

                                                <li>
                                                    @guest
                                                        <a href="javascript:void(0);" onclick="toastr.info('To add favorite list. You need to login first.','Info',{
                                                            closeButton: true,
                                                            progressBar: true,
                                                        })">
                                                            <span class="lnr lnr-heart"></span> {{ $posts->favorite_to_users->count() }}
                                                        </a>
                                                    @else
                                                        <a  href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{ $posts->id }}').submit();"
                                                            class="{{ !Auth::user()->favorite_posts->where('pivot.post_id',$posts->id)->count()  == 0 ? 'favorite_posts' : ''}}">
                                                            <span class="lnr lnr-heart"></span> {{ $posts->favorite_to_users->count() }}
                                                        </a>

                                                        <form id="favorite-form-{{ $posts->id }}" method="POST" action="{{ route('post.favorite',$posts->id) }}" style="display: none;">
                                                            @csrf
                                                        </form>
                                                    @endguest
                                                </li>
                                            </ul>
                                            
                                            <span class="fa fa-folder ml-0 mr-0 article-type"></span>
                                            
                                            <li class="ml-0">
                                                @foreach($posts->categories as $cat)
                                                    <a href="{{ route('category.posts',$cat->slug) }}" class="pl-1 pr-1">
                                                        {{ $cat->name }}
                                                    </a> 
                                                @endforeach
                                            </li>
                                        </ul>
                                    </article>
                                </div>
                            @endforeach
                        @else
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-info text-center">
                                        <p>{{ __('Sorry, there are no top posts at the moment!') }}</p>
                                    </div>                   
                                </div>
                            </div>
                    @endif

                    <div class="line"></div>

                    @foreach($lessMostRead as $lmr)
                        <div class="single-post post-body">
                            <article class="article-mini article mt-4">
                                <div class="inner">
                                    <figure class="article-img">
                                        <a href="{{ route('post.details', $lmr->slug) }}" title="{{ $lmr->title }}">
                                            <img src="{{ asset('assets/uploads/post/thumb/'.$lmr->featuredImg) }}" alt="{{ $lmr->title }}">
                                        </a>
                                    </figure>

                                    <div class="padding">
                                        <h1 title="{{ $lmr->title }}">
                                            <a href="{{ route('post.details', $lmr->slug ) }}" title="{{ $lmr->title }}">
                                                {!! str_limit($lmr->title, $limit = 40, $end = ' '.'...') !!} </p>
                                            </a>
                                        </h1>
                                        <!-- <div class="detail">
                                            <ul class="article-info pl-2 pr-2">
                                                <ul class="article-meta">
                                                    <li>
                                                        <small>
                                                            posted on {{ $posts->created_at->toFormattedDateString() }}
                                                        </small>
                                                    </li>

                                                    <li>
                                                        @guest
                                                            <a href="javascript:void(0);" onclick="toastr.info('To add favorite list. You need to login first.','Info',{
                                                                closeButton: true,
                                                                progressBar: true,
                                                            })">
                                                                <span class="lnr lnr-heart"></span> {{ $posts->favorite_to_users->count() }}
                                                            </a>
                                                        @else
                                                            <a  href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{ $posts->id }}').submit();"
                                                                class="{{ !Auth::user()->favorite_posts->where('pivot.post_id',$posts->id)->count()  == 0 ? 'favorite_posts' : ''}}">
                                                                <span class="lnr lnr-heart"></span> {{ $posts->favorite_to_users->count() }}
                                                            </a>

                                                            <form id="favorite-form-{{ $posts->id }}" method="POST" action="{{ route('post.favorite',$posts->id) }}" style="display: none;">
                                                                @csrf
                                                            </form>
                                                        @endguest
                                                    </li>
                                                </ul>
                                                
                                                <li class="ml-0">
                                                    <span class="fa fa-folder ml-0 mr-0 article-type"></span>
                                                    @foreach($posts->categories as $cat)
                                                        <a href="{{ route('category.posts',$cat->slug) }}" class="pl-1 pr-1">
                                                            {{ $cat->name }}
                                                        </a> 
                                                    @endforeach
                                                </li>
                                            </ul>
                                        </div> -->
                                    </div>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>
        </aside>
        
        <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
            <div class="single-post">
                <div class="thumb">
                    <div class="relative">
                        <img class="f-img img-fluid w-100" src="{{ asset('assets/frontend/themes/img/c2.jpg') }}" alt="">
                        <div class="overlay overlay-bg"></div>
                    </div>
                </div>
                <div class="details">
                    <div class="bottom d-flex justify-content-between">
                        <div>
                            <h4 class="mt-0">Archived Posts</h4>
                            <p>Selected by techmania</p>
                        </div>
                        <div>
                            <span class="lnr lnr-arrow-down text-white"></span>
                        </div>
                    </div>
                    <ul class="list">
                    	@foreach($archives as $stats)
	                        <li>
	                            <a href="/?month=$stats['month']year=$stats['year']">
	                                {{ $stats['month'] .' ' . $stats['year'] }}
	                            </a>
	                        </li>
	                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>