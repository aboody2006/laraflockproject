<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/**
 * Authentication
 */
$this->app['router']->group(['prefix' => 'auth', 'as' => 'auth.', 'namespace' => 'Laraflock\Dashboard\Controllers'],
    function () {
        $this->app['router']->get('login', ['as' => 'login', 'uses' => 'AuthController@login']);
        $this->app['router']->post('login', ['uses' => 'AuthController@authentication']);
        $this->app['router']->get('logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);
        $this->app['router']->get('reset', ['as' => 'reset', 'uses' => 'AuthController@reset']);
        $this->app['router']->post('reset', ['uses' => 'AuthController@resetPassword']);
        $this->app['router']->get('register', ['as' => 'register', 'uses' => 'AuthController@register']);
        $this->app['router']->post('register', ['uses' => 'AuthController@registration']);
        $this->app['router']->get('activate', ['as' => 'activate', 'uses' => 'AuthController@activate']);
        $this->app['router']->post('activate', ['uses' => 'AuthController@activation']);
        $this->app['router']->get('unauthorized', ['as' => 'unauthorized', 'uses' => 'AuthController@unauthorized']);
    });
/**
 * Dashboard Index
 */
$this->app['router']->get('dashboard', [
    'as'         => 'dashboard.index',
    'uses'       => 'Laraflock\Dashboard\Controllers\DashboardController@dashboard',
    'middleware' => ['user', 'roles:administrator']
]);
/**
 * Account management.
 */
$this->app['router']->group([
    'prefix'     => 'dashboard/account',
    'as'         => 'account.',
    'namespace'  => 'Laraflock\Dashboard\Controllers',
    'middleware' => 'user'
], function () {
    $this->app['router']->get('/', ['as' => 'edit', 'uses' => 'AccountController@edit']);
    $this->app['router']->post('/{id}', ['as' => 'update', 'uses' => 'AccountController@update']);
});

/**
 * Roles management.
 */
$this->app['router']->group([
    'prefix'     => 'dashboard/roles',
    'as'         => 'roles.',
    'namespace'  => 'Laraflock\Dashboard\Controllers',
    'middleware' => ['user', 'roles:administrator']
], function () {
    $this->app['router']->get('/', ['as' => 'index', 'uses' => 'RolesController@index']);
    $this->app['router']->get('create', ['as' => 'create', 'uses' => 'RolesController@create']);
    $this->app['router']->post('/', ['uses' => 'RolesController@store']);
    $this->app['router']->get('{id}/edit', ['as' => 'edit', 'uses' => 'RolesController@edit']);
    $this->app['router']->post('{id}/edit', 'RolesController@update');
    $this->app['router']->delete('{id}/delete', ['as' => 'delete', 'uses' => 'RolesController@delete']);
});
/**
 * Users management.
 */
$this->app['router']->group([
    'prefix'     => 'dashboard/users',
    'as'         => 'users.',
    'namespace'  => 'Laraflock\Dashboard\Controllers',
    'middleware' => ['user', 'roles:administrator']
], function () {
    $this->app['router']->get('/', ['as' => 'index', 'uses' => 'UsersController@index']);
    $this->app['router']->get('create', ['as' => 'create', 'uses' => 'UsersController@create']);
    $this->app['router']->post('/', ['uses' => 'UsersController@store']);
    $this->app['router']->get('{id}/edit', ['as' => 'edit', 'uses' => 'UsersController@edit']);
    $this->app['router']->post('{id}/edit', 'UsersController@update');
    $this->app['router']->delete('{id}/delete', ['as' => 'delete', 'uses' => 'UsersController@delete']);
});
/**
 * Permissions management.
 */
$this->app['router']->group([
    'prefix'     => 'dashboard/permissions',
    'as'         => 'permissions.',
    'namespace'  => 'Laraflock\Dashboard\Controllers',
    'middleware' => ['user', 'roles:administrator']
], function () {
    $this->app['router']->get('/', ['as' => 'index', 'uses' => 'PermissionsController@index']);
    $this->app['router']->get('create', ['as' => 'create', 'uses' => 'PermissionsController@create']);
    $this->app['router']->post('/', ['uses' => 'PermissionsController@store']);
    $this->app['router']->get('{id}/edit', ['as' => 'edit', 'uses' => 'PermissionsController@edit']);
    $this->app['router']->post('{id}/edit', 'PermissionsController@update');
    $this->app['router']->delete('{id}/delete', ['as' => 'delete', 'uses' => 'PermissionsController@delete']);
});

/**
 * Categories Master
 */

$this->app['router']->group([
    'prefix'     => 'categories',
    'as'         => 'categories.',
    'namespace'  => 'App\Http\Controllers\Masters',
    'middleware' => ['user', 'roles:administrator']
], function () {
    $this->app['router']->get('/',
        ['as' => 'index', 'uses' => 'CategoriesController@index', 'middleware' => ['masters:view,categories']]);
    $this->app['router']->get('{id}/show',
        ['as' => 'show', 'uses' => 'CategoriesController@show', 'middleware' => ['masters:view,categories']]);
    $this->app['router']->get('create',
        ['as' => 'create', 'uses' => 'CategoriesController@create', 'middleware' => ['masters:create,categories']]);
    $this->app['router']->post('/',
        ['uses' => 'CategoriesController@store', 'middleware' => ['masters:create,categories']]);
    $this->app['router']->get('{id}/edit',
        ['as' => 'edit', 'uses' => 'CategoriesController@edit', 'middleware' => ['masters:edit,categories']]);
    $this->app['router']->post('{id}/edit',
        ['uses' => 'CategoriesController@update', 'middleware' => ['masters:edit,categories']]);
    $this->app['router']->delete('{id}/delete',
        ['as' => 'delete', 'uses' => 'CategoriesController@delete', 'middleware' => ['masters:delete,categories']]);
    $this->app['router']->get('export', [
        'as'         => 'export',
        'uses'       => 'CategoriesController@exportCategories',
        'middleware' => ['masters:export,categories']
    ]);
    $this->app['router']->get('import',
        [
            'as'         => 'import',
            'uses'       => 'CategoriesController@importCategories',
            'middleware' => ['masters:import,categories']
        ]);
    $this->app['router']->put('import',
        [
            'as'         => 'import',
            'uses'       => 'CategoriesController@importCategoriesPost',
            'middleware' => ['masters:import,categories']
        ]);
});

/**
 * Sections Master
 */

$this->app['router']->group([
    'prefix'     => 'sections',
    'as'         => 'sections.',
    'namespace'  => 'App\Http\Controllers\Masters',
    'middleware' => ['user', 'roles:administrator']
], function () {
    $this->app['router']->get('/',
        ['as' => 'index', 'uses' => 'SectionsController@index', 'middleware' => ['masters:view,sections']]);
    $this->app['router']->get('{id}/show',
        ['as' => 'show', 'uses' => 'SectionsController@show', 'middleware' => ['masters:view,sections']]);
    $this->app['router']->get('create',
        ['as' => 'create', 'uses' => 'SectionsController@create', 'middleware' => ['masters:create,sections']]);
    $this->app['router']->post('/',
        ['uses' => 'SectionsController@store', 'middleware' => ['masters:create,sections']]);
    $this->app['router']->get('{id}/edit',
        ['as' => 'edit', 'uses' => 'SectionsController@edit', 'middleware' => ['masters:edit,sections']]);
    $this->app['router']->post('{id}/edit',
        ["uses" => 'SectionsController@update', 'middleware' => ['masters:edit,sections']]);
    $this->app['router']->delete('{id}/delete',
        ['as' => 'delete', 'uses' => 'SectionsController@delete', 'middleware' => ['masters:delete,sections']]);
    $this->app['router']->get('export',
        ['as' => 'export', 'uses' => 'SectionsController@exportSections', 'middleware' => ['masters:export,sections']]);
    $this->app['router']->get('import',
        ['as' => 'import', 'uses' => 'SectionsController@importSections', 'middleware' => ['masters:import,sections']]);
    $this->app['router']->put('import',
        [
            'as'         => 'import',
            'uses'       => 'SectionsController@importSectionsPost',
            'middleware' => ['masters:import,sections']
        ]);

});

/**
 * Products Master
 */

$this->app['router']->group([
    'prefix'     => 'products',
    'as'         => 'products.',
    'namespace'  => 'App\Http\Controllers\Masters',
    'middleware' => ['user', 'roles:administrator']
], function () {
    $this->app['router']->get('/',
        ['as' => 'index', 'uses' => 'ProductsController@index', 'middleware' => ['masters:view,products']]);
    $this->app['router']->get('{id}/show',
        ['as' => 'show', 'uses' => 'ProductsController@show', 'middleware' => ['masters:view,products']]);
    $this->app['router']->get('create',
        ['as' => 'create', 'uses' => 'ProductsController@create', 'middleware' => ['masters:create,products']]);
    $this->app['router']->post('/',
        ['uses' => 'ProductsController@store', 'middleware' => ['masters:create,products']]);
    $this->app['router']->get('{id}/edit',
        ['as' => 'edit', 'uses' => 'ProductsController@edit', 'middleware' => ['masters:edit,products']]);
    $this->app['router']->post('{id}/edit',
        ['uses' => 'ProductsController@update', 'middleware' => ['masters:edit,products']]);
    $this->app['router']->get('export',
        ['as' => 'export', 'uses' => 'ProductsController@exportProducts', 'middleware' => ['masters:export,products']]);
    $this->app['router']->delete('{id}/delete',
        ['as' => 'delete', 'uses' => 'ProductsController@delete', 'middleware' => ['masters:delete,products']]);
    $this->app['router']->post('ajax/search', ['as' => 'ajax.search', 'uses' => 'ProductsController@ajaxSearch']);
    $this->app['router']->get('import',
        ['as' => 'import', 'uses' => 'ProductsController@importProducts', 'middleware' => ['masters:import,products']]);
    $this->app['router']->put('import',
        [
            'as'         => 'import',
            'uses'       => 'ProductsController@importProductsPost',
            'middleware' => ['masters:import,products']
        ]);

});

/**
 * Units Master
 */

$this->app['router']->group([
    'prefix'     => 'units',
    'as'         => 'units.',
    'namespace'  => 'App\Http\Controllers\Masters',
    'middleware' => ['user', 'roles:administrator']
], function () {
    $this->app['router']->get('/',
        ['as' => 'index', 'uses' => 'UnitsController@index', 'middleware' => ['masters:view,units']]);
    $this->app['router']->get('{id}/show',
        ['as' => 'show', 'uses' => 'UnitsController@show', 'middleware' => ['masters:view,units']]);
    $this->app['router']->get('create',
        ['as' => 'create', 'uses' => 'UnitsController@create', 'middleware' => ['masters:create,units']]);
    $this->app['router']->post('/', ['uses' => 'UnitsController@store', 'middleware' => ['masters:create,units']]);
    $this->app['router']->get('{id}/edit',
        ['as' => 'edit', 'uses' => 'UnitsController@edit', 'middleware' => ['masters:edit,units']]);
    $this->app['router']->post('{id}/edit',
        ['uses' => 'UnitsController@update', 'middleware' => ['masters:edit,units']]);
    $this->app['router']->delete('{id}/delete',
        ['as' => 'delete', 'uses' => 'UnitsController@delete', 'middleware' => ['masters:delete,units']]);
    $this->app['router']->get('export',
        ['as' => 'export', 'uses' => 'UnitsController@exportUnits', 'middleware' => ['masters:export,units']]);
    $this->app['router']->get('import',
        ['as' => 'import', 'uses' => 'UnitsController@importUnits', 'middleware' => ['masters:import,units']]);
    $this->app['router']->put('import',
        ['as' => 'import', 'uses' => 'UnitsController@importUnitsPost', 'middleware' => ['masters:import,units']]);

});

/**
 * Weight Characteristics Master
 */

$this->app['router']->group([
    'prefix'     => 'weights',
    'as'         => 'weights.',
    'namespace'  => 'App\Http\Controllers\Masters',
    'middleware' => ['user', 'roles:administrator']
], function () {
    $this->app['router']->get('/', ['as' => 'index', 'uses' => 'WeightsController@index','middleware' => ['masters:view,weights']]);
    $this->app['router']->get('{id}/show', ['as' => 'show', 'uses' => 'WeightsController@show','middleware' => ['masters:view,weights']]);
    $this->app['router']->get('create', ['as' => 'create', 'uses' => 'WeightsController@create','middleware' => ['masters:create,weights']]);
    $this->app['router']->post('/', ['uses' => 'WeightsController@store','middleware' => ['masters:create,weights']]);
    $this->app['router']->get('{id}/edit', ['as' => 'edit', 'uses' => 'WeightsController@edit','middleware' => ['masters:edit,weights']]);
    $this->app['router']->post('{id}/edit', ['uses'=>'WeightsController@update','middleware' => ['masters:edit,weights']]);
    $this->app['router']->delete('{id}/delete', ['as' => 'delete', 'uses' => 'WeightsController@delete','middleware' => ['masters:delete,weights']]);
    $this->app['router']->post('ajax/products_search',
        ['as' => 'ajax.products', 'uses' => 'WeightsController@productSearch']);
    $this->app['router']->get('export', ['as' => 'export', 'uses' => 'WeightsController@exportWeights','middleware' => ['masters:export,weights']]);
    $this->app['router']->get('import',
        ['as' => 'import', 'uses' => 'WeightsController@importWeights','middleware' => ['masters:import,weights']]);
    $this->app['router']->put('import',
        ['as' => 'import', 'uses' => 'WeightsController@importWeightsPost','middleware' => ['masters:import,weights']]);

});

/**
 * Technical Characteristics Master
 */

$this->app['router']->group([
    'prefix'     => 'characteristics',
    'as'         => 'characteristics.',
    'namespace'  => 'App\Http\Controllers\Masters',
    'middleware' => ['user', 'roles:administrator']
], function () {
    $this->app['router']->get('/', ['as' => 'index', 'uses' => 'CharacteristicsController@index','middleware' => ['masters:view,characteristics']]);
    $this->app['router']->get('{id}/show', ['as' => 'show', 'uses' => 'CharacteristicsController@show','middleware' => ['masters:view,characteristics']]);
    $this->app['router']->get('create', ['as' => 'create', 'uses' => 'CharacteristicsController@create','middleware' => ['masters:create,characteristics']]);
    $this->app['router']->post('/', ['uses' => 'CharacteristicsController@store','middleware' => ['masters:create,characteristics']]);
    $this->app['router']->get('{id}/edit',
        ['as' => 'edit', 'uses' => 'CharacteristicsController@edit', 'middleware' => ['masters:edit,characteristics']]);
    $this->app['router']->post('{id}/edit',
        ["uses" => 'CharacteristicsController@update', 'middleware' => ['masters:edit,characteristics']]);
    $this->app['router']->delete('{id}/delete', [
        'as'         => 'delete',
        'uses'       => 'CharacteristicsController@delete',
        'middleware' => ['masters:delete,characteristics']
    ]);
    $this->app['router']->post('ajax/products_search',
        ['as' => 'ajax.products', 'uses' => 'CharacteristicsController@productSearch']);
    $this->app['router']->get('export',
        [
            'as'         => 'export',
            'uses'       => 'CharacteristicsController@exportCharacteristics',
            'middleware' => ['masters:export,characteristics']
        ]);
    $this->app['router']->get('import',
        [
            'as'         => 'import',
            'uses'       => 'CharacteristicsController@importCharacteristics',
            'middleware' => ['masters:import,characteristics']
        ]);
    $this->app['router']->put('import',
        [
            'as'         => 'import',
            'uses'       => 'CharacteristicsController@inportCharacteristicsPost',
            'middleware' => ['masters:import,characteristics']
        ]);
});

/**
 * Customers Master
 */

$this->app['router']->group([
    'prefix'     => 'customers',
    'as'         => 'customers.',
    'namespace'  => 'App\Http\Controllers\Masters',
    'middleware' => ['user', 'roles:administrator']
], function () {
    $this->app['router']->get('/',
        ['as' => 'index', 'uses' => 'CustomersController@index', 'middleware' => ['masters:view,customers']]);
    $this->app['router']->get('{id}/show',
        ['as' => 'show', 'uses' => 'CustomersController@show', 'middleware' => ['masters:view,customers']]);
    $this->app['router']->get('create',
        ['as' => 'create', 'uses' => 'CustomersController@create', 'middleware' => ['masters:create,customers']]);
    $this->app['router']->post('/',
        ['uses' => 'CustomersController@store', 'middleware' => ['masters:create,customers']]);
    $this->app['router']->get('{id}/edit',
        ['as' => 'edit', 'uses' => 'CustomersController@edit', 'middleware' => ['masters:edit,customers']]);
    $this->app['router']->post('{id}/edit',
        ['uses' => 'CustomersController@update', 'middleware' => ['masters:edit,customers']]);
    $this->app['router']->delete('{id}/delete',
        ['as' => 'delete', 'uses' => 'CustomersController@delete', 'middleware' => ['masters:delete,customers']]);
    $this->app['router']->get('export', [
        'as'         => 'export',
        'uses'       => 'CustomersController@exportCustomers',
        'middleware' => ['masters:export,customers']
    ]);
    $this->app['router']->get('import',
        [
            'as'         => 'import',
            'uses'       => 'CustomersController@importCustomers',
            'middleware' => ['masters:import,customers']
        ]);
    $this->app['router']->put('import',
        [
            'as'         => 'import',
            'uses'       => 'CustomersController@importCustomersPost',
            'middleware' => ['masters:import,customers']
        ]);

});

/**
 * Godowns Master
 */

$this->app['router']->group([
    'prefix'     => 'godowns',
    'as'         => 'godowns.',
    'namespace'  => 'App\Http\Controllers\Masters',
    'middleware' => ['user', 'roles:administrator']
], function () {
    $this->app['router']->get('/',
        ['as' => 'index', 'uses' => 'GodownsController@index', 'middleware' => ['masters:view,godowns']]);
    $this->app['router']->get('{id}/show',
        ['as' => 'show', 'uses' => 'GodownsController@show', 'middleware' => ['masters:view,godowns']]);
    $this->app['router']->get('create',
        ['as' => 'create', 'uses' => 'GodownsController@create', 'middleware' => ['masters:create,godowns']]);
    $this->app['router']->post('/', ['uses' => 'GodownsController@store', 'middleware' => ['masters:create,godowns']]);
    $this->app['router']->get('{id}/edit',
        ['as' => 'edit', 'uses' => 'GodownsController@edit', 'middleware' => ['masters:edit,godowns']]);
    $this->app['router']->post('{id}/edit',
        ['uses', 'GodownsController@update', 'middleware' => ['masters:edit,godowns']]);
    $this->app['router']->delete('{id}/delete',
        ['as' => 'delete', 'uses' => 'GodownsController@delete', 'middleware' => ['masters:delete,godowns']]);
    $this->app['router']->get('export',
        ['as' => 'export', 'uses' => 'GodownsController@exportGodowns', 'middleware' => ['masters:export,godowns']]);
    $this->app['router']->get('import',
        ['as' => 'import', 'uses' => 'GodownsController@importGodowns', 'middleware' => ['masters:import,godowns']]);
    $this->app['router']->put('import',
        [
            'as'         => 'import',
            'uses'       => 'GodownsController@importGodownsPost',
            'middleware' => ['masters:import,godowns']
        ]);

});

Route::group(['prefix' => 'dashboard', 'middleware' => ['user', 'roles:administrator']], function () {
    /**
     * Transaction Master
     */
    Route::group([
        'prefix'    => '/transactions',
        'as'        => 'transactions.',
        'namespace' => 'App\Http\Controllers\Transactions'
    ], function () {
        Route::get('', function () {
            return redirect()->route('transactions.orders.completed.index');
        });

        Route::group(['prefix' => '/orders', 'as' => 'orders.'], function () {
            Route::get('', function () {
                return redirect()->route('transactions.orders.create.index');
            });

            Route::group(['prefix' => '/create', 'as' => 'create.'], function () {
                Route::get('', ['as' => 'index', 'uses' => 'OrdersController@createOrder']);
                Route::get('/select-product/{orderId}',
                    ['as' => 'select.product', 'uses' => 'OrdersController@selectProduct']);
                Route::post('', 'OrdersController@setCustomerToNewOrder');
                Route::post('/save/{orderId}', ['as' => 'save', 'uses' => 'OrdersController@saveOrder']);
            });

            Route::group(['prefix' => '/completed', 'as' => 'completed.'], function () {
                Route::get('', ['as' => 'index', 'uses' => 'OrdersController@index']);
                Route::get('/show/{id}', ['as' => 'show', 'uses' => 'OrdersController@showOrder']);
            });

            Route::group(['prefix' => '/pending', 'as' => 'pending.'], function () {
                Route::get('', ['as' => 'index', 'uses' => 'OrdersController@pendingOrders']);
                Route::get('/show/{id}', ['as' => 'show', 'uses' => 'OrdersController@showOrder']);
                Route::get('/edit/{id}', ['as' => 'edit', 'uses' => 'OrdersController@editPendingOrder']);
            });
        });

        Route::group(['prefix' => '/packing', 'as' => 'packing.'], function () {
            Route::get('', ['as' => 'index', 'uses' => 'PackingController@index']);
            Route::get('/create', ['as' => 'create', 'uses' => 'PackingController@createPackingSlip']);
            Route::post('', 'PackingController@savePackingSlip');
        });
    });

    /**
     * SMS
     */
    Route::group(['prefix' => '/sms', 'as' => 'sms.', 'namespace' => 'App\Http\Controllers\Sms'], function () {
        Route::get('', function () {
            return redirect()->route('sms.sent.index');
        });

        Route::group(['prefix' => '/sent', 'as' => 'sent.'], function () {
            Route::get('', ['as' => 'index', 'uses' => 'SmsSentController@index']);
            Route::get('/{id}/show', ['as' => 'show', 'uses' => 'SmsSentController@showSms']);
            Route::delete('/{id}/delete', ['as' => 'delete', 'uses' => 'SmsSentController@deleteSms']);
        });

        Route::group(['prefix' => '/send', 'as' => 'send.'], function () {
            Route::get('', ['as' => 'index', 'uses' => 'SmsController@createSms']);
            Route::post('', 'SmsController@sendSms');
        });

        Route::group(['prefix' => '/templates', 'as' => 'templates.'], function () {
            Route::get('', ['as' => 'index', 'uses' => 'SmsTemplatesController@index']);
            Route::get('/create', ['as' => 'create', 'uses' => 'SmsTemplatesController@createTemplate']);
            Route::get('/{id}/edit', ['as' => 'edit', 'uses' => 'SmsTemplatesController@editTemplate']);
            Route::get('/{id}/show', ['as' => 'show', 'uses' => 'SmsTemplatesController@showTemplate']);
            Route::post('', 'SmsTemplatesController@saveTemplate');
            Route::post('/{id}/edit', 'SmsTemplatesController@updateTemplate');
            Route::delete('/{id}/delete', ['as' => 'delete', 'uses' => 'SmsTemplatesController@deleteTemplate']);
        });

        Route::group(['prefix' => '/settings', 'as' => 'settings.'], function () {
            Route::get('', ['as' => 'index', 'uses' => 'SmsSettingsController@index']);
            Route::get('/create', ['as' => 'create', 'uses' => 'SmsSettingsController@createSetting']);
            Route::get('/{id}/edit', ['as' => 'edit', 'uses' => 'SmsSettingsController@editSetting']);
            Route::get('/{id}/show', ['as' => 'show', 'uses' => 'SmsSettingsController@showSetting']);
            Route::post('', 'SmsSettingsController@saveSetting');
            Route::post('/{id}/edit', 'SmsSettingsController@updateSetting');
            Route::delete('/{id}/delete', ['as' => 'delete', 'uses' => 'SmsSettingsController@deleteSetting']);
        });
    });
});

Route::get('/', function () {
    return view('welcome');
});
