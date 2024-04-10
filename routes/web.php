<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\car\CarController;
use App\Http\Controllers\admin\item\ItemsController;
use App\Http\Controllers\admin\car\ManufactureController;
use App\Http\Controllers\admin\car\ModelController;
use App\Http\Controllers\admin\car\OperationController;
use App\Http\Controllers\admin\property\PropertyController;
use App\Http\Controllers\admin\car\TypeController;
use App\Http\Controllers\admin\item\TypeController as ItemTypeController;
use App\Http\Controllers\admin\notification\AllNotificationController;
use App\Http\Controllers\admin\notification\SingleNotificationController;
use App\Http\Controllers\admin\property\OperationController as PropertyOperationController;
use App\Http\Controllers\admin\property\RegistrationController;
use App\Http\Controllers\admin\property\TypeController as PropertyTypeController;
use App\Http\Controllers\admin\setting\CityController;
use App\Http\Controllers\admin\setting\CountryController;
use App\Http\Controllers\admin\setting\CurrencyController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });


Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('index');

/***************** ADMIN *****************/

Route::prefix('admins')->middleware('role:admin')->controller(AdminController::class)->group(function () {
    Route::get('/', 'index')->name('admin.admins.index');
    Route::get('/get', 'get_data')->name('admin.admins.get');
    Route::get('/add', 'add')->name('admin.admins.add');
    Route::get('/{id}/edit', 'edit')->name('admin.admins.edit');

    Route::post('/create', 'create')->name('admin.admins.create');
    Route::post('/update', 'update')->name('admin.admins.update');
    Route::post('/delete', 'delete')->name('admin.admins.delete');
});
/***************** END OF ADMIN *****************/

/***************** USER *****************/
Route::prefix('users')->middleware('role:admin')->controller(UserController::class)->group(function () {
    Route::get('/', 'index')->name('admin.users.index');
    Route::get('/get', 'get_data')->name('admin.users.get');
    Route::get('/add', 'add')->name('admin.users.add');
    Route::get('/{id}/edit', 'edit')->name('admin.users.edit');
    Route::get('/{id}/view', 'view')->name('admin.users.view');

    Route::post('/create', 'create')->name('admin.users.create');
    Route::post('/update', 'update')->name('admin.users.update');
    Route::post('/delete', 'delete')->name('admin.users.delete');
    Route::post('/active', 'active')->name('admin.users.active');

    Route::get('/{id}/add_post', 'add_post')->name('admin.post.index');
    Route::get('/post_form', 'post_form')->name('admin.post.form');
});

/***************** END OF USER *****************/

/***************** CAR *****************/
Route::prefix('cars')->middleware('role:admin')->controller(CarController::class)->group(function () {
    Route::get('/', 'index')->name('admin.cars.index');
    Route::get('/get', 'get_data')->name('admin.cars.get');

    Route::get('/add', 'add')->name('admin.cars.add');
    Route::get('/modelByManufacture{id}', 'modelByManufacture')->name('admin.cars.modelByManufacture');
    Route::get('/cityByCountry{id}', 'cityByCountry')->name('admin.cars.cityByCountry');

    Route::get('/{id}/edit', 'edit')->name('admin.cars.edit');
    Route::get('/{id}/view', 'view')->name('admin.cars.view');

    Route::post('/create', 'create')->name('admin.cars.create');
    Route::post('/update', 'update')->name('admin.cars.update');
    Route::post('/delete', 'delete')->name('admin.cars.delete');
    Route::post('/active', 'active')->name('admin.cars.active');
});

Route::prefix('cars/operation')->middleware('role:admin')->controller(OperationController::class)->group(function () {
    Route::get('/', 'index')->name('admin.cars.operation.index');
    Route::get('/get', 'get_data')->name('admin.cars.operation.get');

    // Route::get('/add', 'add')->name('admin.cars.operation.add');

    // Route::get('/{id}/edit', 'edit')->name('admin.cars.operation.edit');
    // Route::get('/{id}/view', 'view')->name('admin.cars.operation.view');

    Route::get('/{id}/getById', 'getById')->name('admin.cars.operation.getById');
    Route::post('/create', 'create')->name('admin.cars.operation.create');
    Route::post('/update', 'update')->name('admin.cars.operation.update');
    Route::post('/delete', 'delete')->name('admin.cars.operation.delete');
});

Route::prefix('cars/type')->middleware('role:admin')->controller(TypeController::class)->group(function () {
    Route::get('/', 'index')->name('admin.cars.type.index');
    Route::get('/get', 'get_data')->name('admin.cars.type.get');

    // Route::get('/add', 'add')->name('admin.cars.type.add');

    // Route::get('/{id}/edit', 'edit')->name('admin.cars.type.edit');
    // Route::get('/{id}/view', 'view')->name('admin.cars.type.view');

    Route::get('/{id}/getById', 'getById')->name('admin.cars.type.getById');
    Route::post('/create', 'create')->name('admin.cars.type.create');
    Route::post('/update', 'update')->name('admin.cars.type.update');
    Route::post('/delete', 'delete')->name('admin.cars.type.delete');
});



Route::prefix('cars/manufacture')->middleware('role:admin')->controller(ManufactureController::class)->group(function () {
    Route::get('/', 'index')->name('admin.cars.manufacture.index');
    Route::get('/get', 'get_data')->name('admin.cars.manufacture.get');

    // Route::get('/add', 'add')->name('admin.cars.manufacture.add');
    // Route::get('/{id}/edit', 'edit')->name('admin.cars.manufacture.edit');
    // Route::get('/{id}/view', 'view')->name('admin.cars.manufacture.view');

    Route::get('/{id}/getById', 'getById')->name('admin.cars.manufacture.getById');
    Route::post('/create', 'create')->name('admin.cars.manufacture.create');
    Route::post('/update', 'update')->name('admin.cars.manufacture.update');
    Route::post('/delete', 'delete')->name('admin.cars.manufacture.delete');
});

Route::prefix('cars/model')->middleware('role:admin')->controller(ModelController::class)->group(function () {
    Route::get('/', 'index')->name('admin.cars.model.index');
    Route::get('/get', 'get_data')->name('admin.cars.model.get');

    // Route::get('/add', 'add')->name('admin.cars.model.add');

    // Route::get('/{id}/edit', 'edit')->name('admin.cars.model.edit');
    // Route::get('/{id}/view', 'view')->name('admin.cars.model.view');

    Route::get('/{id}/getById', 'getById')->name('admin.cars.model.getById');
    Route::post('/create', 'create')->name('admin.cars.model.create');
    Route::post('/update', 'update')->name('admin.cars.model.update');
    Route::post('/delete', 'delete')->name('admin.cars.model.delete');
});
/***************** END OF CAR *****************/


/*****************  USED ITEM *****************/

Route::prefix('items')->middleware('role:admin')->controller(ItemsController::class)->group(function () {
    Route::get('/', 'index')->name('admin.items.index');
    Route::get('/get', 'get_data')->name('admin.items.get');

    Route::get('/add', 'add')->name('admin.items.add');
    Route::get('/modelByManufacture{id}', 'modelByManufacture')->name('admin.items.modelByManufacture');
    Route::get('/cityByCountry{id}', 'cityByCountry')->name('admin.items.cityByCountry');

    Route::get('/{id}/edit', 'edit')->name('admin.items.edit');
    Route::get('/{id}/view', 'view')->name('admin.items.view');

    Route::post('/create', 'create')->name('admin.items.create');
    Route::post('/update', 'update')->name('admin.items.update');
    Route::post('/delete', 'delete')->name('admin.items.delete');
    Route::post('/active', 'active')->name('admin.items.active');
});

Route::prefix('items/type')->middleware('role:admin')->controller(ItemTypeController::class)->group(function () {
    Route::get('/', 'index')->name('admin.items.type.index');
    Route::get('/get', 'get_data')->name('admin.items.type.get');

    // Route::get('/add', 'add')->name('admin.items.type.add');

    // Route::get('/{id}/edit', 'edit')->name('admin.items.type.edit');
    // Route::get('/{id}/view', 'view')->name('admin.items.type.view');

    Route::get('/{id}/getById', 'getById')->name('admin.items.type.getById');
    Route::post('/create', 'create')->name('admin.items.type.create');
    Route::post('/update', 'update')->name('admin.items.type.update');
    Route::post('/delete', 'delete')->name('admin.items.type.delete');
});
/***************** END OF USED ITEM *****************/

/***************** PROPERTY *****************/


Route::prefix('property')->middleware('role:admin')->controller(PropertyController::class)->group(function () {
    Route::get('/', 'index')->name('admin.property.index');
    Route::get('/get', 'get_data')->name('admin.property.get');

    Route::get('/add', 'add')->name('admin.property.add');



    Route::get('/{id}/edit', 'edit')->name('admin.property.edit');
    Route::get('/{id}/view', 'view')->name('admin.property.view');

    Route::post('/create', 'create')->name('admin.property.create');
    Route::post('/update', 'update')->name('admin.property.update');
    Route::post('/delete', 'delete')->name('admin.property.delete');
    Route::post('/active', 'active')->name('admin.property.active');
});

Route::prefix('property/operation')->middleware('role:admin')->controller(PropertyOperationController::class)->group(function () {
    Route::get('/', 'index')->name('admin.property.operation.index');
    Route::get('/get', 'get_data')->name('admin.property.operation.get');

    // Route::get('/add', 'add')->name('admin.property.operation.add');

    // Route::get('/{id}/edit', 'edit')->name('admin.property.operation.edit');
    // Route::get('/{id}/view', 'view')->name('admin.property.operation.view');

    Route::get('/{id}/getById', 'getById')->name('admin.property.operation.getById');
    Route::post('/create', 'create')->name('admin.property.operation.create');
    Route::post('/update', 'update')->name('admin.property.operation.update');
    Route::post('/delete', 'delete')->name('admin.property.operation.delete');
});

Route::prefix('property/type')->middleware('role:admin')->controller(PropertyTypeController::class)->group(function () {
    Route::get('/', 'index')->name('admin.property.type.index');
    Route::get('/get', 'get_data')->name('admin.property.type.get');

    // Route::get('/add', 'add')->name('admin.property.type.add');

    // Route::get('/{id}/edit', 'edit')->name('admin.property.type.edit');
    // Route::get('/{id}/view', 'view')->name('admin.property.type.view');

    Route::get('/{id}/getById', 'getById')->name('admin.property.type.getById');
    Route::post('/create', 'create')->name('admin.property.type.create');
    Route::post('/update', 'update')->name('admin.property.type.update');
    Route::post('/delete', 'delete')->name('admin.property.type.delete');
});

Route::prefix('property/registration')->middleware('role:admin')->controller(RegistrationController::class)->group(function () {
    Route::get('/', 'index')->name('admin.property.registration.index');
    Route::get('/get', 'get_data')->name('admin.property.registration.get');

    // Route::get('/add', 'add')->name('admin.property.registration.add');

    // Route::get('/{id}/edit', 'edit')->name('admin.property.registration.edit');
    // Route::get('/{id}/view', 'view')->name('admin.property.registration.view');

    Route::get('/{id}/getById', 'getById')->name('admin.property.registration.getById');
    Route::post('/create', 'create')->name('admin.property.registration.create');
    Route::post('/update', 'update')->name('admin.property.registration.update');
    Route::post('/delete', 'delete')->name('admin.property.registration.delete');
});
/***************** END OF USED ITEM *****************/

/***************** SETTINGS *****************/

Route::prefix('settings/country')->middleware('role:admin')->controller(CountryController::class)->group(function () {
    Route::get('/', 'index')->name('admin.settings.country.index');
    Route::get('/get', 'get_data')->name('admin.settings.country.get');

    // Route::get('/add', 'add')->name('admin.settings.country.add');

    // Route::get('/{id}/edit', 'edit')->name('admin.settings.country.edit');
    // Route::get('/{id}/view', 'view')->name('admin.settings.country.view');

    Route::get('/{id}/getById', 'getById')->name('admin.settings.country.getById');
    Route::post('/create', 'create')->name('admin.settings.country.create');
    Route::post('/update', 'update')->name('admin.settings.country.update');
    Route::post('/delete', 'delete')->name('admin.settings.country.delete');
});

Route::prefix('settings/city')->middleware('role:admin')->controller(CityController::class)->group(function () {
    Route::get('/', 'index')->name('admin.settings.city.index');
    Route::get('/get', 'get_data')->name('admin.settings.city.get');

    // Route::get('/add', 'add')->name('admin.settings.city.add');

    // Route::get('/{id}/edit', 'edit')->name('admin.settings.city.edit');
    // Route::get('/{id}/view', 'view')->name('admin.settings.city.view');

    Route::get('/{id}/getById', 'getById')->name('admin.settings.city.getById');
    Route::post('/create', 'create')->name('admin.settings.city.create');
    Route::post('/update', 'update')->name('admin.settings.city.update');
    Route::post('/delete', 'delete')->name('admin.settings.city.delete');
});
Route::prefix('settings/currency')->middleware('role:admin')->controller(CurrencyController::class)->group(function () {
    Route::get('/', 'index')->name('admin.settings.currency.index');
    Route::get('/get', 'get_data')->name('admin.settings.currency.get');

    // Route::get('/add', 'add')->name('admin.settings.currency.add');

    // Route::get('/{id}/edit', 'edit')->name('admin.settings.currency.edit');
    // Route::get('/{id}/view', 'view')->name('admin.settings.currency.view');

    Route::get('/{id}/getById', 'getById')->name('admin.settings.currency.getById');
    Route::post('/create', 'create')->name('admin.settings.currency.create');
    Route::post('/update', 'update')->name('admin.settings.currency.update');
    Route::post('/delete', 'delete')->name('admin.settings.currency.delete');
});
/***************** END OF SETTINGS *****************/

/***************** NOTIFICATIONS *****************/
Route::prefix('notification/all')->middleware('role:admin')->controller(AllNotificationController::class)->group(function () {
    Route::get('/', 'index')->name('admin.notification.all.index');
    Route::get('/get', 'get_data')->name('admin.notification.all.get');

    // Route::get('/add', 'add')->name('admin.notification.all.add');

    // Route::get('/{id}/edit', 'edit')->name('admin.notification.all.edit');
    // Route::get('/{id}/view', 'view')->name('admin.notification.all.view');

    Route::get('/{id}/getById', 'getById')->name('admin.notification.all.getById');
    Route::post('/create', 'create')->name('admin.notification.all.create');
    Route::post('/update', 'update')->name('admin.notification.all.update');
    Route::post('/delete', 'delete')->name('admin.notification.all.delete');
});
Route::prefix('notification/single')->middleware('role:admin')->controller(SingleNotificationController::class)->group(function () {
    Route::get('/', 'index')->name('admin.notification.single.index');
    Route::get('/get', 'get_data')->name('admin.notification.single.get');

    // Route::get('/add', 'add')->name('admin.notification.single.add');

    // Route::get('/{id}/edit', 'edit')->name('admin.notification.single.edit');
    // Route::get('/{id}/view', 'view')->name('admin.notification.single.view');

    Route::get('/{id}/getById', 'getById')->name('admin.notification.single.getById');
    Route::post('/create', 'create')->name('admin.notification.single.create');
    Route::post('/update', 'update')->name('admin.notification.single.update');
    Route::post('/delete', 'delete')->name('admin.notification.single.delete');
});
/***************** END OF NOTIFICATIONS *****************/
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
