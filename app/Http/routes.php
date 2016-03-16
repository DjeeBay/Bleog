<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
    //Route::auth();

	Route::get('/login', [
			'as' => 'login',
			'uses' => 'Auth\LoginController@getLogin'
	]);
	
	Route::post('/login', [
			'as' => 'login',
			'uses' => 'Auth\LoginController@postLogin'
	]);
	
	Route::get('/logout', [
    		'as' => 'logout',
    		'uses' => 'Auth\AuthController@logout'
    ]);
    
    Route::get('/', [
    		'as' => 'index',
    		'uses' => 'Index\IndexController@showIndex'
    ]);
    
    Route::post('/', [
    		'as' => 'newMail',
    		'uses' => 'Index\IndexController@postNewsletter'
    ]);
    
    // Add pages
    Route::get('/add/photo', [
    		'as' => 'addPhoto',
    		'uses' => 'Posts\ArticlesPhoto\ArticlePhotoController@getForm'
    ]);
    
    Route::post('/add/photo', [
    		'as' => 'addPhoto',
    		'uses' => 'Posts\ArticlesPhoto\ArticlePhotoController@postForm'
    ]);
    
    Route::get('/add/video', [
    		'as' => 'addVideo',
    		'uses' => 'Posts\ArticlesVideo\ArticleVideoController@getForm'
    ]);
    
    Route::post('/add/video', [
    		'as' => 'addVideo',
    		'uses' => 'Posts\ArticlesVideo\ArticleVideoController@postForm'
    ]);
    
    Route::get('/add/article', [
    		'as' => 'addArticle',
    		'uses' => 'Posts\Articles\ArticleController@getForm'
    ]);
    
    Route::post('/add/article', [
    		'as' => 'addArticle',
    		'uses' => 'Posts\Articles\ArticleController@postForm'
    ]);
    
    Route::get('add/article/gallery', [
    		'as' => 'getGallery',
    		'uses' => 'Posts\Articles\ArticleController@getGallery'
    ]);
    
    Route::post('add/article/gallery', [
    		'as' => 'getGallery',
    		'uses' => 'Posts\Articles\ArticleController@delGallery'
    ]);
    
    Route::post('add/article/gallery/pic', [
    		'as' => 'postGalleryPic',
    		'uses' => 'Posts\Articles\ArticleController@sendAGalleryPic'
    ]);
    
    Route::get('/newsletter', [
    		'as' => 'newsletter',
    		'uses' => 'Posts\Newsletter\NewsletterController@getForm'
    ]);
    
    Route::post('/newsletter', [
    		'as' => 'postNewsletter',
    		'uses' => 'Posts\Newsletter\NewsletterController@postForm'
    ]);
    
    // Displaying and modifying single post.
    Route::get('/photo/{id}', [
    		'as' => 'photosPage',
    		'uses' => 'GetPost\Photo\PhotoController@getPhoto'
    ]);
    
    Route::post('/photo/{id}', [
    		'as' => 'modifyPhoto',
    		'uses' => 'GetPost\Photo\PhotoController@modifyPhoto'
    ]);
    
    Route::get('/video/{id}', [
    		'as' => 'videosPage',
    		'uses' => 'GetPost\Video\VideoController@getVideo'
    ]);
    
    Route::post('/video/{id}', [
    		'as' => 'modifyVideo',
    		'uses' => 'GetPost\Video\VideoController@modifyVideo'
    ]);
    
    Route::get('/article/{id}', [
    		'as' => 'articlesPage',
    		'uses' => 'GetPost\Article\ArticleController@getArticle'
    ]);
    
    Route::post('/article/{id}', [
    		'as' => 'modifyArticle',
    		'uses' => 'GetPost\Article\ArticleController@modifyArticle'
    ]);
    
    Route::get('/article/{id}/edit', [
    		'as' => 'editArticle',
    		'uses' => 'GetPost\Article\ArticleController@getEditableArticle'
    ]);
    
    Route::post('/article/{id}/edit', [
    		'as' => 'editArticle',
    		'uses' => 'GetPost\Article\ArticleController@editArticle'
    ]);
    
    Route::get('/newsletter/subscribers', [
    		'as' => 'subscribers',
    		'uses' => 'Posts\Newsletter\SubscriberController@getList'
    ]);
    
    Route::post('/newsletter/subscribers', [
    		'as' => 'subscribers',
    		'uses' => 'Posts\Newsletter\SubscriberController@postDelAddress'
    ]);
    
    // Unsuscribe the newsletter
    Route::get('/newsletter/unsuscribe/{id}', [
    		'as' => 'unsusNewsletter',
    		'uses' => 'Posts\Newsletter\UnsuscribeController@getUnsus'
    ]);
    
    Route::post('/newsletter/unsuscribe/{id}', [
    		'as' => 'unsusNewsletter',
    		'uses' => 'Posts\Newsletter\UnsuscribeController@postUnsus'
    ]);
});
