<div class="row">
    <div class="col-lg-3 col-md-3">
        <p>
            @guest
                <a href="javascript:void(0);" onclick="toastr.info('To add favorite list. You need to login first.','Info',{
                            closeButton: true,
                            progressBar: true,
                        })"><span class="lnr lnr-heart" id="heart"></span>{{ $post->favorite_to_users->count() }} People Heart</a>
            @else
                <a href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{ $post->id }}').submit();"
                   class="{{ !Auth::user()->favorite_posts->where('pivot.post_id',$post->id)->count()  == 0 ? 'favorite_posts' : ''}}">
                   <span class="lnr lnr-heart" id="heart"></span>{{ $post->favorite_to_users->count() }}
                </a> <span class="text ml-2"> People Heart</span>

                <form id="favorite-form-{{ $post->id }}" method="POST" action="{{ route('post.favorite',$post->id) }}" style="display: none;">
                    @csrf
                </form>
            @endguest
        </p>
    </div>
    
    <div class="col-lg-3 col-md-3">
        <p>
            <a href="">
                <span class="lnr lnr-eye" id="eye"></span>
                {{ $post->view_count }} <span class="text ml-2"> People Viewed</span>
            </a>
        </p>
    </div>

    <div class="col-lg-6 col-md-6 text-right">
        <div class="sharing">
            <div class="title">
                <span class="lnr lnr-location mr-5"></span> Sharing is caring
            </div>
            <div class="article-share social">
                <a class="addthis_inline_share_toolbox"></a>
            </div>
        </div>
    </div>
</div>