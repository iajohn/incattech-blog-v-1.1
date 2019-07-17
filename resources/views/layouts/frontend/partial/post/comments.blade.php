<div class="comments-area">
    <h4><b>{{ $post->comments()->count() }} Comments</b></h4>
    @if($post->comments->count() > 0)
        @foreach($post->comments as $comment)
            <div class="comment-list">
                <div class="single-comment justify-content-between d-flex">
                    <div class="user justify-content-between d-flex">
                        <div class="thumb">
                            <a class="avatar" href="{{ route('author.profile',$comment->user->username) }}">
                                <img src="{{ asset($comment->user->profile->profile_pics) }}" alt="Profile Image">
                            </a>
                        </div>

                        <div class="desc">
                            <h5>
                                <a href="{{ route('author.profile',$comment->user->username) }}">
                                    {{$comment->user->firstname}} {{$comment->user->lastname}}
                                </a>
                            </h5>
                            <p class="date">on {{ $comment->created_at->diffForHumans()}}</p>
                            <p class="comment">
                                {{ $comment->comment }}
                            </p>
                        </div>
                    </div>
                    <div class="reply-btn">
                        <a href="" class="btn-reply">reply</a>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="comment-list">
            <div class="comment">
                <p>No Comment yet. Be the first :)</p>
            </div>
        </div>
    @endif
</div>

<div class="comment-form">
    <div class="section-title">
        <h4><b>Leave a Reply</b></h4>
    </div>
    @guest
        <p>For post a new comment. You need to login first. <a href="{{ route('login') }}">Login</a></p>
    @else
        <form method="post" action="{{ route('comment.store',$post->id) }}">
            @csrf
            <div class="form-group">
                <textarea class="form-control mb-10" rows="5" name="message" placeholder="Messege" onfocus="this.placeholder = ''"
                 onblur="this.placeholder = 'Messege'" aria-required="true" aria-invalid="false"></textarea>
            </div>
            <button type="submit" id="form-submit" class="primary-btn fill">Post Comment</button>
        </form>
    @endguest
</div>