@extends('layouts.frontend')

@section('meta')
    @include('meta::manager', [
        'robots'        => 'index',
        'title'         => $title,
        'description'   => 'Welcome to Incattech.com, the media arm of Incattech. Incattech is a Fashion Tech & Fashion Media Company based in Lagos Nigeria.',
        'image'         => 'https://incattech.com',
        'author'        => 'Incattech.com',
        'keywords'      => $title . ', ' . 'incattech, media, fashion, technology, tech, clothing, AR, VR, AI, retail, sustainability',
        'geo_region'    => 'Lagos Nigeria',
        'geo_position'  => '4.870467,6.993388',
    ])
@stop 

@section('styles')
    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
@stop

@section('content')        
    <section class="search">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <aside>
                        <h2 class="aside-title">{{ __('Search Results') }} | {{ $search }}</h2>
                        <div class="aside-body">
                            <p>Search with other keywords.</p>
                            <form method="GET" action="/results">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control" placeholder="Type something ..." value="{{ $search }}">
                                        <div class="input-group-btn">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="ion-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                        <!-- <div class="help-block">
                            <div>Popular:</div>
                            <ul>
                                <li><a href="#">HTML5</a></li>
                                <li><a href="#">CSS3</a></li>
                                <li><a href="#">Bootstrap 3</a></li>
                                <li><a href="#">jQuery</a></li>
                                <li><a href="#">AnguarJS</a></li>
                            </ul>
                        </div> -->
                    </aside>
                    
                    <!-- <aside>
                        <h2 class="aside-title">Filter</h2>
                        <div class="aside-body">
                            <form class="checkbox-group">
                                <div class="group-title">Date</div>
                                <div class="form-group">
                                    <label><input type="radio" name="date" checked> Anytime</label>
                                </div>
                                <div class="form-group">
                                    <label><input type="radio" name="date"> Today</label>
                                </div>
                                <div class="form-group">
                                    <label><input type="radio" name="date"> Last Week</label>
                                </div>
                                <div class="form-group">
                                    <label><input type="radio" name="date"> Last Month</label>
                                </div>
                                <br>
                                <div class="group-title">Categories</div>
                                <div class="form-group">
                                    <label><input type="checkbox" name="category" checked> All Categories</label>
                                </div>
                                <div class="form-group">
                                    <label><input type="checkbox" name="category"> Lifestyle</label>
                                </div>
                                <div class="form-group">
                                    <label><input type="checkbox" name="category"> Travel</label>
                                </div>
                                <div class="form-group">
                                    <label><input type="checkbox" name="category"> Computer</label>
                                </div>
                                <div class="form-group">
                                    <label><input type="checkbox" name="category"> Film</label>
                                </div>
                                <div class="form-group">
                                    <label><input type="checkbox" name="category"> Sport</label>
                                </div>
                            </form>
                        </div>
                    </aside> -->
                </div>
                
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <!-- <div class="nav-tabs-group">
                        <ul class="nav-tabs-list">
                            <li class="active">
                                <a href="#all" aria-controls="all" role="tab" data-toggle="tab">All</a>
                            </li>
                            <li class="">
                                <a href="#posts" aria-controls="posts" role="tab" data-toggle="tab">Post</a>
                            </li>

                            <li><a href="#">Latest</a></li>
                            <li><a href="#">Popular</a></li>
                            <li><a href="#">Trending</a></li>
                            <li><a href="#">Videos</a></li>
                        </ul>
                        <div class="nav-tabs-right">
                            <select class="form-control">
                                <option>Limit</option>
                                <option>10</option>
                                <option>20</option>
                                <option>50</option>
                                <option>100</option>
                            </select>
                        </div>
                    </div>-->

                    <div class="search-result">
                        Search results for keyword "{{ $search }}" found in {{ $posts->count() }} posts.
                    </div>
                    
                    <div class="row">
                        @if($posts->count() > 0)
                            @foreach($posts as $post)
                                <article class="col-md-12 article-list">
                                    <div class="inner">
                                        <figure>
                                            <a href="{{ route('post.single', [ 'slug' => $post->slug ]) }}">
                                                <img src="{{ $post->featured }}" alt="{{ $post->title }}">
                                            </a>
                                        </figure>
                                        <div class="details">
                                            <div class="detail">
                                                <div class="category">
                                                    <a href="{{ route('category.single', [ 'slug' => $post->category->slug ]) }}">{{ $post->category->name }}</a>
                                                </div>
                                                <time>{{ $post->created_at->toFormattedDateString() }}</time>
                                            </div>
                                            <h1>
                                                <a href="{{ route('post.single', [ 'slug' => $post->slug ]) }}">{{ $post->title }}</a>
                                            </h1>
                                                
                                                <!--{!! str_limit($post->content) !!}-->
                                                {!! str_limit($post->content, $limit = 250, $end = ' '.'...') !!} </p>
                                            <footer>
                                                <a class="btn btn-primary more" href="{{ route('post.single', [ 'slug' => $post->slug ]) }}">
                                                    <div>More</div>
                                                    <div><i class="ion-ios-arrow-thin-right"></i></div>
                                                </a>
                                            </footer>
                                        </div>
                                    </div>
                                </article>
                            @endforeach

                            @else
                                <div class="tect-center">
                                    <div class="alert alert-info text-center">
                                        {{ __('Sorry, No post found!') }}
                                    </div>                   
                                </div>
                        @endif


                       <!-- <div class="col-md-12 text-center category-links">
				            <ul class="pagination">
			          			
				              	<!-- <li class="prev"><a href="#"><i class="ion-ios-arrow-left"></i></a></li>
				              	<li class="active"><a href="#">1</a></li>
				              	<li><a href="#">2</a></li>
				              	<li><a href="#">3</a></li>
				              	<li><a href="#">...</a></li>
				              	<li><a href="#">97</a></li>
				              	<li class="next"><a href="#"><i class="ion-ios-arrow-right"></i></a></li> -->
				            </ul>
				            <!-- <div class="pagination-help-text">
				            	Showing 8 results of 776 &mdash; Page 1
				            </div> -->
			          	</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop

@section('scripts')

    <script src="{{ asset('themes/system-theme/js/toastr.min.js') }}"> </script>

    <script>
        @if(Session::has('subscribed'))
            
            toastr.success("{{ Session::get('subscribed') }}")
        
        @endif
    </script>
@stop