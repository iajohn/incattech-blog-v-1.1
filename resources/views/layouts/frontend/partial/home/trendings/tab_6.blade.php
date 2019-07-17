<div id="tab-{{ $_6post->slug }}" class="tab-pane fade">
    <div class="row">                           
        @if($_6post->posts()->count() > 0)
            @foreach($_6post->posts()->withCount('favorite_to_users')
            ->orderBy('view_count','desc')
            ->orderBy('favorite_to_users_count','desc')
            ->get();  as $P1)
                <!-- <div class=""> -->
                    <div class="col-lg-4 col-md-6 col-sm-12 single-post single-int post-body lsm mb-20">
                        <!-- <div class="col-lg-6 col-md-6 col-sm-12 text-left">
                            <div class="d-flex justify-content-start a-avt">
                                <div class="mr-15">
                                    <a class="avatar" href="{{ route('author.profile',$P1->user->username) }}">
                                        <img src="{{ asset( $P1->user->profile->profile_pics ) }}" alt="Superadmin" class="img-fluid img-circle">
                                    </a>
                                </div>
                                <div class="pt-2">
                                    <a class="" href="{{ route('author.profile',$P1->user->username) }}">
                                        <h5 class="text-dark">
                                            {{ $P1->user->username }}
                                        </h5>
                                        <div class="">
                                            @guest
                                                <a href="javascript:void(0);" onclick="toastr.info('To add favorite list. You need to login first.','Info',{
                                                    closeButton: true,
                                                    progressBar: true,
                                                })">
                                                    <span class="lnr lnr-heart"></span> {{ $P1->favorite_to_users->count() }}
                                                </a>
                                            @else
                                                <a  href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{ $P1->id }}').submit();"
                                                    class="{{ !Auth::user()->favorite_posts->where('pivot.post_id',$P1->id)->count()  == 0 ? 'favorite_posts' : ''}}">
                                                    <span class="lnr lnr-heart"></span> {{ $P1->favorite_to_users->count() }}
                                                </a>

                                                <form id="favorite-form-{{ $P1->id }}" method="POST" action="{{ route('post.favorite',$P1->id) }}" style="display: none;">
                                                    @csrf
                                                </form>
                                            @endguest
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div> -->

                        <div class="thumb medium">
                            <div class="relative">
                                <a href="{{ route('post.details', [ 'slug' => $P1->slug ]) }}">
                                    <img class="f-img w-100 img-fluid mx-auto" src="{{ asset('assets/uploads/post/thumb/'.$P1->featuredImg ) }}" alt="">
                                </a>
                                <div class="overlay overlay-bg"></div>
                            </div>  
                        </div>

                        <ul class="">
                            <li class="date-info-type l-top pull-right">
                                <small> 
                                    <!-- <i class="ion-clock"></i>  -->
                                    {{ $P1->created_at->toFormattedDateString() }} 
                                </small>
                            </li>
                        </ul>

                        <div class="details e-pick">
                            <a href="{{ route('post.details', [ 'slug' => $P1->slug ]) }}" title="{{ $P1->title }}">
                                <h4>{{ $P1->title }}</h4>
                            </a>
                        </div>
                    </div>
                <!-- </div> -->
            @endforeach
            @else
            	<div class="col-lg-12 col-md-12 col-sm-12">
	                <div class="">
	                    <div class="e-pick-alert">
	                        <div class="alert alert-info text-center">
	                            {{ __("There are no Trending posts in") }} "{{ $_6post->name }}" {{ ("category at the moment check later!") }}
	                        </div>                   
	                    </div>
	                </div>
	            </div>
        @endif
    </div>  
</div>