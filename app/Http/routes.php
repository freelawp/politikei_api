<?php

Route::get('/', function () {
    echo 'Politikei API';
});

Route::group(['prefix'=>'user'], function () {
    Route::post('new', 'UsersController@store');
});

Route::group(['prefix' => 'api/v1/'], function () {
	Route::group(['as' => 'api_auth'], function () {
		Route::post('auth', ['uses' => 'AuthController@authenticate']);
	    Route::post('auth/{provider}', ['uses' => 'AuthController@oAuth']);

	});

    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::get('authenticate/user', 'AuthController@getAuthenticatedUser');
        Route::get('users', 'UsersController@getIndex');
        
        Route::group(['prefix'=>'user'], function () {
            Route::get('new', 'UsersController@create');
            Route::post('new', 'UsersController@store');
        });

        Route::get('proposicoes/{user_id}', 'ProposicoesController@index');
        Route::post('proposicoes/votar/{id}', 'ProposicoesController@votar');
    });
});
