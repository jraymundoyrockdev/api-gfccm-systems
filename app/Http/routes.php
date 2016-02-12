<?php

Route::group(
    ['namespace' => 'Api', 'prefix' => 'api', 'middleware' => 'cors'], function () {

    Route::post('api-token-auth', 'AuthenticationController@authorize');
    Route::post('api-token-refresh', [
        'middleware' => 'jwt.refresh',
        'uses' => 'AuthenticationController@refreshToken'
    ]);

    Route::group(['middleware' => ['resource', 'APIJWT.auth']], function () {
        Route::resource('users', 'UsersController');
        Route::resource('roles', 'RolesController');
        Route::get('ministry/list', 'MinistryController@asList');
        Route::resource('ministry', 'MinistryController');
        Route::resource('denominations', 'DenominationsController');
        Route::get('services/list', 'ServicesController@asList');
        Route::resource('services', 'ServicesController');
        Route::resource('members', 'MembersController');
        Route::resource('funds', 'FundsController');
        Route::get('funds/{fundId}/items', 'FundsController@showItems');
        Route::resource('fund-items', 'FundItemsController', ['only' => ['store', 'update', 'show']]);
        Route::get('funds/{fundId}/items', 'FundsController@showItems');

        /**
         * Income Services
         */
        Route::post('income-services/{id}/member-fund/{member_id}/update',
            'IncomeServiceMemberFundsController@updateMemberFund');
        Route::delete('income-services/{id}/member-fund/{member_id}',
            'IncomeServiceMemberFundsController@deleteMemberFund');
        Route::get('income-services/total/{year}/{month?}', 'IncomeServicesController@getTotal');
        Route::get('income-services/list/{year}/{month}', 'IncomeServicesController@getAllServices');
        Route::post('income-services/{id}/denomination', 'IncomeServicesController@updateDenomination');
        Route::resource('income-services', 'IncomeServicesController');


    });
}
);
