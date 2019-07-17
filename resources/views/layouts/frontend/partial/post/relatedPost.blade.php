<section class="best-of-the-week">
    <!-- <div class="container"> -->
        <h1><div class="text">Related Post</div>
            <div class="carousel-nav" id="best-of-the-week-nav">
                <div class="prev">
                    <i class="ion-ios-arrow-left"></i>
                </div>
                <div class="next">
                    <i class="ion-ios-arrow-right"></i>
                </div>
            </div>
        </h1>
        
        <div class="owl-carousel owl-theme carousel-1">
            @foreach($post->category->posts()->orderBy('created_at', 'desc')->take(4)->get()  as $P)
                <article class="article thumb-article editor">
                    <div class="article-img">
                        <img src="{{ $P->featured }}" alt="{{ $P->title }}">
                    </div>
                    <div class="article-body">
                        <h2 class="article-title">
                            <a href="{{ route('post.single', [ 'slug' => $P->slug ]) }}">{{ $P->title }}</a>
                        </h2>
                        <div class="detail">
                            <div class="time" style="color: #fff;">{{ $P->created_at->toFormattedDateString() }}</div>
                            <div class="category">
                                <a href="{{ route('category.single', [ 'slug' => $P->category->slug ]) }}">
                                    {{ $P->category->name }}
                                </a>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    <!-- </div> -->
</section>