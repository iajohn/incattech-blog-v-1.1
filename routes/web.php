<?php

// use Spatie\Sitemap\SitemapGenerator;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//=================================================================================
//                  Frontend Route
//=================================================================================
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('posts','PostController@index')->name('post.index');
    Route::get('post/{slug}','PostController@details')->name('post.details');
    Route::get('category/{slug}','PostController@postByCategory')->name('category.posts');
    Route::get('tag/{slug}','PostController@postByTag')->name('tag.posts');

    Route::get('author/{username}','AuthorController@profile')->name('author.profile');
    Route::get('authors','AuthorController@index')->name('all_author');

    Route::post('subscriber','SubscriberController@store')->name('subscriber.store');

    Route::get('search','SearchController@search')->name('search');

    Route::get('about',   'HomeController@about')->name('about');
    Route::get('contact', 'HomeController@contact')->name('contact');
    Route::post('contact','HomeController@postContact')->name('contact.store');
    Route::get('policy',  'HomeController@policy')->name('policy');
    Route::get('terms-of-use',  'HomeController@terms')->name('terms');
    Route::get('archives','HomeController@archives')->name('archives.index');
    Route::get('archive','HomeController@archive')->name('archive');

    Route::get('/sitemap.xml', 'SitemapController@index')->name('sitemap');
    Route::get('/sitemap.xml/articles', 'SitemapController@posts');
    Route::get('/sitemap.xml/categories', 'SitemapController@categories');
    Route::get('/sitemap.xml/tags', 'SitemapController@tags');
    Route::get('/sitemap.xml/videos', 'SitemapController@videos');
    Route::get('/sitemap.xml/channels', 'SitemapController@channels');
    Route::get('/sitemap.xml/videotags', 'SitemapController@videoTags');

    // Route::get('sitemap',  function() {
    //     SitemapGenerator::create('http://weblogs.com/')->writeToFile('sitemap.xml');

    //     return 'sitemap created';
    // })->name('sitemap');

    Route::get('tv','VidHomeController@index')->name('tv');
    Route::get('tv/{slug}','VideoController@details')->name('tv.details');
    Route::get('video/{id}/favorite', 'VideoController@favoriteVideo')->name('favorite.tv');
    Route::get('tv/{operation}/{value}', 'VideoController@getOperationVideo');
    
    // Route::get('/video/{operation}/{value}', [
    //     'uses' => 'VidHomeController@getOperationVideo',
    // ]);

Auth::routes(['verify']);

Route::group(['middleware'=>['auth']], function (){
   Route::post('favorite/{post}/add','FavoriteController@add')->name('post.favorite');
   Route::post('favorite/{video}/add','FavoriteController@add_tv')->name('tv.favorite');
   Route::post('comment/{post}','CommentController@store')->name('comment.store');
});


//=================================================================================
//                  Admin Group Route
//=================================================================================
    Route::group(['as'=>'admin.','prefix'=>'admin','namespace'=>'Admin','middleware'=>['auth','admin']], function (){
        Route::get('/dashboard','DashboardController@index')->name('dashboard');

        //----------------------------------------------------------------------\\
        //                             AUTHORS CRUDE                               \\  
        //----------------------------------------------------------------------\\

        Route::get('authors','AuthorController@index')->name('author.index');
        Route::get('authors-create','AuthorController@create')->name('author.create');
        Route::post('authors-store','AuthorController@store')->name('author.store');
        Route::get('authors-profile-{id}','AuthorController@profile')->name('author.profile');
        Route::get('authors/profile-edit-{id}','AuthorController@profile_edit')->name('author.profile.edit');
        Route::put('profile-update-{id}','AuthorController@update')->name('author.profile.update');
        Route::put('password-update-{id}','AuthorController@updatePassword')->name('author.password.update');
        Route::delete('authors/{id}','AuthorController@destroy')->name('author.destroy');

        Route::get('authors-delete-{id}','AuthorController@delete')->name('author.delete');
        Route::get('authors-trashed','AuthorController@trashed')->name('author.trashed');
        Route::get('authors-restore-{id}','AuthorController@restore')->name('author.restore');
        Route::get('authors-destroy-{id}','AuthorController@destroy')->name('author.destroy');

        // Route::get('authors','AuthorController@index')->name('author.index');

        //----------------------------------------------------------------------\\
        //                           REGULAR USER CRUDE                         \\  
        //----------------------------------------------------------------------\\

        Route::get('users','RegularController@index')->name('user.index');
        Route::get('users-create','RegularController@create')->name('user.create');
        Route::post('users-store','RegularController@store')->name('user.store');
        Route::get('users-profile-{id}','RegularController@profile')->name('user.profile');
        Route::get('users/profile-edit-{id}','RegularController@profile_edit')->name('user.profile.edit');
        Route::put('user-update-{id}','RegularController@update')->name('user.profile.update');
        Route::put('user-password-update-{id}','RegularController@updatePassword')->name('user.password.update');

        Route::get('users-delete-{id}','RegularController@delete')->name('user.delete');
        Route::get('users-trashed','RegularController@trashed')->name('user.trashed');
        Route::get('users-restore-{id}','RegularController@restore')->name('user.restore');
        Route::get('users-destroy-{id}','RegularController@destroy')->name('user.destroy');

        //----------------------------------------------------------------------\\
        //                             PROFILE                                  \\  
        //----------------------------------------------------------------------\\

        Route::get('profile','ProfileController@index')->name('profile.index');
        Route::get('profile-edit','ProfileController@edit')->name('profile.edit');
        Route::put('profile-update','ProfileController@update')->name('profile.update');
        Route::put('password-update','ProfileController@updatePassword')->name('password.update');

        //----------------------------------------------------------------------\\
        //                             APP SETTINGS                             \\  
        //----------------------------------------------------------------------\\

        Route::get('company-settings','CompanyDetailsController@index')->name('company-settings');
        Route::put('company-settings-update', 'CompanyDetailsController@update')->name('company-settings.update');

        Route::get('company-about', 'CompanyDetailsController@about')->name('company.about');
        Route::post('company-about-update', 'CompanyDetailsController@about_update')->name('company-about.update');

        Route::get('company-policy', 'CompanyDetailsController@policy')->name('company.policy');
        Route::post('company-policy-update', 'CompanyDetailsController@policy_update')->name('company-policy.update');

        Route::get('company-terms', 'CompanyDetailsController@terms')->name('company.terms');
        Route::post('company-terms-update', 'CompanyDetailsController@terms_update')->name('company-terms.update');

        Route::get('settings','SettingsController@index')->name('settings');
        Route::post('settings', 'SettingsController@store')->name('settings.store');
        Route::post('settings', 'SettingsController@update')->name('settings.update');

        //----------------------------------------------------------------------\\
        //                TAGS, CATEGORIES, POST, COMMENTS, CRUDE               \\  
        //----------------------------------------------------------------------\\

        Route::resource('category','CategoryController');        
        Route::resource('tag','TagController');
        Route::resource('post','PostController');

        Route::get('pending/post','PostController@pending')->name('post.pending');
        Route::put('post/{id}/approve','PostController@approval')->name('post.approve');
        Route::get('post/{id}/editors', 'PostController@editors')->name('post.editors');
        Route::get('post/{id}/not-editors','PostController@not_editors')->name('post.not.editors');
        Route::get('post/{id}/delete','PostController@delete')->name('post.delete');
        Route::get('post/{id}/destroy','PostController@destroy')->name('post.destroy');
        Route::get('posts/trashed','PostController@trashed')->name('post.trashed');
        Route::get('post/{id}/restore', 'PostController@restore')->name('post.restore');

        Route::get('/favorite','FavoriteController@index')->name('favorite.index');

        
        Route::get('comments','CommentController@index')->name('comment.index');
        Route::delete('comments/{id}','CommentController@destroy')->name('comment.destroy');

        Route::get('/subscriber','SubscriberController@index')->name('subscriber.index');
        Route::delete('/subscriber/{subscriber}','SubscriberController@destroy')->name('subscriber.destroy');

        //----------------------------------------------------------------------\\
        //                                 VIDEOS                               \\  
        //----------------------------------------------------------------------\\
        Route::get('/tv-channel', 'ChannelController@index')->name('tv-channel.index');
        Route::post('tv-channel/store', 'ChannelController@store')->name('tv-channel.store');
        Route::get('tv-channel/edit/{id}', 'ChannelController@edit')->name('tv-channel.edit');
        Route::put('tv-channel/update', 'ChannelController@update')->name('tv-channel.update');;
        Route::get('tv-channel/delete/{id}', 'ChannelController@update')->name('tv-channel.delete');

        Route::get('tv-channel/order', 'ChannelController@order')->name('channel.order');       
        Route::resource('tv-tag', 'VtagController');
        Route::resource('tv', 'VideoController');


        Route::post('tv/upload', 'VideoController@uploadFiles');
        Route::get('pending/tv',         'VideoController@pending')->name('tv.pending');
        Route::put('tv/{id}/approve',    'VideoController@approval')->name('tv.approve');
        Route::get('tv/{id}/editors',    'VideoController@editors')->name('tv.editors');
        Route::get('tv/{id}/not-editors','VideoController@not_editors')->name('tv.not.editors');
        Route::get('tv/{id}/delete',     'VideoController@delete')->name('tv.delete');
        Route::get('tv/{id}/destroy',    'VideoController@destroy')->name('tv.destroy');
        Route::get('tvs/trashed',        'VideoController@trashed')->name('tv.trashed');
        Route::get('tv/{id}/restore',    'VideoController@restore')->name('tv.restore');

        Route::get('/favorite-tv','FavoriteController@tv')->name('favorite.tv');

        //----------------------------------------------------------------------\\
        //                             VIDEO PLAYLIST                           \\  
        //----------------------------------------------------------------------\\
        Route::resource('playlist', 'PlaylistController');
        // Route::get('playlist', 'PlaylistController@index')->name('playlist.index');

        Route::get('playlist/{id}/delete','PlaylistController@delete')->name('playlist.delete');
        Route::get('playlist/{id}/destroy','PlaylistController@destroy')->name('playlist.destroy');
        Route::get('playlists/trashed','PlaylistController@trashed')->name('playlist.trashed');
        Route::get('playlist/{id}/restore', 'PlaylistController@restore')->name('playlist.restore');

        //----------------------------------------------------------------------\\
        //                        USER'S SUBSCRIPTION                           \\  
        //----------------------------------------------------------------------\\

        Route::get('user/subscription', 'SubscribeController@getAdminSubscriptionForm')
             ->name('subscription.form');

        Route::post('user/subscription/store', 'SubscribeController@addManuelSubscription')
             ->name('subscription.store');

        Route::get('user/subscription/index', 'SubscribeController@getSubscriptionHistory')
             ->name('subscription.index');

        Route::get('/user/subscription/{tranzid}', 'SubscribeController@showSubscription')
             ->name('subscription.show');
    });

//=================================================================================
//                  Author Group Route
//=================================================================================
    Route::group(['as'=>'author.','prefix'=>'backend/author','namespace'=>'Author','middleware'=>['auth','author']], function (){
        Route::get('dashboard','DashboardController@index')->name('dashboard');

        Route::get('comments','CommentController@index')->name('comment.index');
        Route::delete('comments/{id}','CommentController@destroy')->name('comment.destroy');

        Route::get('settings','SettingsController@index')->name('settings');

        //----------------------------------------------------------------------\\
        //                             PROFILE                                  \\  
        //----------------------------------------------------------------------\\

        Route::get('profile','ProfileController@index')->name('profile.index');
        Route::get('profile-edit','ProfileController@edit')->name('profile.edit');
        Route::put('profile-update','ProfileController@update')->name('profile.update');
        Route::put('password-update','ProfileController@updatePassword')->name('password.update');

        Route::resource('post','PostController');
        Route::get('/favorite','FavoriteController@index')->name('favorite.index');
    });

//=================================================================================
//                  Regular User Group Routes
//=================================================================================
    Route::group(['as'=>'user.','prefix'=>'user','namespace'=>'User','middleware'=>['auth','user']], function (){

        Route::get('profile', 'AccountController@index')->name('account.user');

        Route::get('profile-edit', 'AccountController@edit')->name('account.edit');

        Route::put('profile-update', 'AccountController@update')->name('account.update');

        Route::put('password-update', 'AccountController@updatePassword')->name('accountpassword.update');

        Route::get('subscribe', 'SubscriptionController@index')->name('subscribe.user');

        Route::post('process/card', 'SubscriptionController@paySubscription')->name('subscribe.pay');
    });

//=================================================================================
//                  Global Composer View Render
//=================================================================================
        
    //  HEADER

        // frontend
        View::composer('layouts.frontend.partial.global.front_header',function ($view) {
            $categories = App\Category::all();
            $view->with('categories',$categories);
        });

        // backend
        View::composer('layouts.backend.partial.topbar',function ($view) {
            $company = App\Company::first()->get();
            $view->with('company',$company);
        });

        // dev
        View::composer('layouts.dev.partial.global.header',function ($view) {
            $company = App\Company::first()->get();
            $view->with('company',$company);
        });

        View::composer('layouts.backend.partial.global.header',function ($view) {
            $company = App\Company::first()->get();
            $view->with('company',$company);
        });

        View::composer('layouts.backend.partial.global.canvas',function ($view) {
            $company = App\Company::first()->get();
            $view->with('company',$company);
        });


    //  FOOTER

        // frontend
        View::composer('layouts.frontend.partial.global.front_footer',function ($view) {
            $company = App\Company::first()->get();
            $view->with('company',$company);
        });

        View::composer('layouts.frontend.partial.global.front_footer',function ($view) {
            $tags = App\Tag::first()->get();
            $view->with('tags',$tags);
        });

        View::composer('layouts.frontend.partial.global.front_footer',function ($view) {
            $settings = App\Setting::getAllSettings();
            $view->with('settings',$settings);
        });

        // dev
        View::composer('layouts.dev.partial.global.footer',function ($view) {
            $company = App\Company::first()->get();
            $view->with('company',$company);
        });