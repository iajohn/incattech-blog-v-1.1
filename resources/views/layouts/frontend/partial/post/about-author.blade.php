<div class="row">
    <div class="col-md-12">
        <div class="heading">               
            {{ __('About Author') }}
        </div>
    </div>  
</div>

<div class="bio-info">
    <div class="row">
        <div class="col-lg-4 col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="bio-image">
                        <!-- <img src="{{ asset($post->user->profile->profile_pics) }}" alt="image" /> -->
                        @if($post->user->profile->profile_pics)
                            <img src="{{ asset($post->user->profile->profile_pics) }}" alt="{{ $post->user->username }}">
                            
                        @else
                            <span class="name"> {{ substr($post->user->username, 0, 1) }}</span>
                            
                        @endif
                    </div>          
                </div>
            </div>  
        </div>
        <div class="col-lg-8 col-md-8">
            <div class="bio-content">
                <h3>Hi there, I'm <a href="{{ route('author.profile',$post->user->username) }}">{{ $post->user->firstname }} {{ $post->user->lastname }}</a></h3>
                <small class="job">{{ $post->user->profile->occupation }}</small>
                <h6>
                    @if($post->user->profile->about)
                        {{ $post->user->profile->about }}
                        You can reach me on social media by following the links below.
                        @else
                            I am 
                            @if($post->user->profile->occupation )
                                {{ $post->user->profile->occupation }} 
                                @else 
                                lover of fashion and technology, 
                            @endif 
                            
                            @if($settings)
                                at {{ $settings->find(5)->val }},
                                @else 
                                and I'm skilled at writing blog contents and any forms of articles.
                            @endif 

                            I'm skilled at writing blog contents and any forms of articles. 
                            You can reach me on social media by following the links below. 
                    @endif
                </h6>
                <!-- <p>P.S I have no special talent, I'm just passionately curious ;)</p> -->
                <div class="middle-part d-flex mt-3">
                    <div class="conn mr-3">Social Media Link</div>
                    <span class="lnr lnr-arrow-down text-white"></span>
                </div>

                <div class="bottom-part">
                    <div class="col-lg-12 col-md-12 col-sm-6 social">
                        <a href="{{ $post->user->profile->facebook }}" target="_blank"><i class="fa fa-facebook"></i></a>
                        <a href="{{ $post->user->profile->instagram }}" target="_blank"><i class="fa fa-instagram"></i></a>
                        <a href="{{ $post->user->profile->twitter }}" target="_blank"><i class="fa fa-twitter"></i></a>
                        <a href="{{ $post->user->profile->youtube }}" target="_blank"><i class="fa fa-youtube-play"></i></a>
                        <a href="{{ $post->user->profile->whatsapp }}" target="_blank"><i class="fa fa-whatsapp"></i></a>
                        <!-- <a href="#"><i class="fa fa-rss"></i></a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>
