@extends('beautymail::templates.ark')

        
@section('content') 

    @include('beautymail::templates.ark.heading', [
		'heading' => 'Mail from justlaravel',
		'level' => 'h1'
	])

    @include('beautymail::templates.ark.contentStart')

        <h4 class="secondary"><strong>A test mail sent a part of explaining the demo of sending beautiful html mails using BeautyMail</strong></h4>
        <p>You can find the detailed post <a href="#">here</a></p>

    @include('beautymail::templates.ark.contentEnd')

    @include('beautymail::templates.ark.heading', [
		'heading' => 'Some of my posts',
		'level' => 'h2'
	])

    @include('beautymail::templates.ark.contentStart')

        <h4 class="secondary"><strong>Feel free to check any of these posts.</strong></h4>
        <table>
          	<tr>
	            <td><a href="http://justlaravel.com/posts-search-gallery-view-app-vuejs/" target="_blank">
	              <img src="https://i1.wp.com/justlaravel.com/wp-content/uploads/2017/05/Vue_Posts_WP_1038_576.png" width="200" height="200" >
	              Posts search and gallery view app in Vuejs</a>
	            </td>
	            
	            <td><a href="http://justlaravel.com/introduction-vue-js-in-laravel/" target="_blank">
	              <img src="https://i0.wp.com/justlaravel.com/wp-content/uploads/2017/02/introduction_vuejs_laravel_FEAT_WP_1038_576.png" width="200" height="200" >
	              Introduction to vue.js in Laravel</a>
	            </td>
	            
	            <td><a href="http://justlaravel.com/laravel-social-login-using-socialite/" target="_blank">
	              <img src="https://i1.wp.com/justlaravel.com/wp-content/uploads/2016/12/SocialLogin_justLaravel.png" width="200" height="200" >
	              Laravel Social Login using Socialite</a>
	            </td>
            
          	</tr>
        </table>

    @include('beautymail::templates.ark.contentEnd')

@stop