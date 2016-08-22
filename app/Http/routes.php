<?php

Route::group(
    ['namespace' => 'Api', 'prefix' => 'api', 'middleware' => 'cors'], function () {

    Route::post('api-token-auth', 'AuthenticationController@authorize');
    Route::post('api-token-refresh', [
        'middleware' => 'jwt.refresh',
        'uses' => 'AuthenticationController@refreshToken'
    ]);
    Route::post('api-token-invalidate', [
        'middleware' => 'jwt.invalidate',
        'uses' => 'AuthenticationController@invalidateToken'
    ]);

    Route::group(['middleware' => ['resource', 'format.json', 'APIJWT.auth']], function () {
        Route::resource('users', 'UsersController');
        Route::resource('roles', 'RolesController');
        Route::get('ministries/list', 'MinistriesController@asList');
        Route::resource('ministries', 'MinistriesController');
        Route::resource('denominations', 'DenominationsController', ['only' => ['index', 'store', 'show', 'update']]);
        Route::get('services/list', 'ServicesController@asList');
        Route::resource('services', 'ServicesController', ['only' => ['index', 'store', 'show', 'update']]);
        Route::resource('members', 'MembersController');
        Route::resource('funds', 'FundsController');
        Route::get('funds/{fundId}/items', 'FundsController@showItems');
        Route::resource('fund-items', 'FundItemsController', ['only' => ['store', 'update', 'show']]);
        /**
         * Income Services
         */
        Route::post(
            'income-services/{id}/member-fund/{member_id}/update/',
            'IncomeServiceMemberFundsController@updateMemberFund'
        );
        Route::delete(
            'income-services/{id}/member-fund/{member_id}',
            'IncomeServiceMemberFundsController@deleteMemberFund'
        );
        Route::get('income-services/total/{year}/{month?}', 'IncomeServicesController@getTotal');
        Route::get('income-services/list/{year}/{month}', 'IncomeServicesController@getAllServices');
        Route::post('income-services/{id}/denomination', 'IncomeServicesController@updateDenomination');
        Route::resource('income-services', 'IncomeServicesController');

        /**
         * Ministry Transactions
         */
        Route::get('ministry-transactions/{id}/cash-flow/{year}', 'MinistryTransactionsController@cashFlow');
        Route::get('ministry-transactions/running-balance', 'MinistryTransactionsController@currentBalance');
        Route::resource('ministry-transactions', 'MinistryTransactionsController');

    });
}
);
