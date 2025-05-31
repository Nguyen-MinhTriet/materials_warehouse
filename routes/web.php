<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\KhoController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\WarehouseController;
use Illuminate\Support\Facades\Route;



Route::redirect("/", 'login');

Route::view('login', 'auth.login')->name('login');
Route::post('login', [AuthController::class, 'processLogin'])->name('process_login');

Route::view('register', 'auth.register')->name('register');
Route::post('register', [AuthController::class, 'processRegister'])->name('process_register');

Route::resource('users', AuthController::class)->except([
    'show',
]);


Route::get('/layout', function () {
    return view('layout_admin.master');
});

route::get('test', function () {
    return view('layout.master');
});
// Route::get('warehoses/api', [KhoController::class, 'api'])->name('warehoses.api');// viết sau sẽ ghi đè lên thằng viết trước
// Route::get('warehouses/geojson', [KhoController::class, 'geojson'])->name('warehouses.geojson');
// Route::group(['prefix' => 'kho', 'as' => 'warehouses.'], function () {
//     Route::get('/', [KhoController::class, 'index'])->name('index');
//     Route::get('/create', [KhoController::class, 'create'])->name('create');
//     Route::post('/warehouse', [KhoController::class, 'store'])->name('store');
//     Route::delete('/destroy', [KhoController::class, 'destroy'])->name('destroy');
//     //   Route::get('/edit/{warehouse}', [WarehouseController::class, 'edit'])->name('edit');
//     //   Route::post('/update/{warehouse}', [WarehouseController::class, 'update'])->name('update');
// });

Route::resource('warehouses', WarehouseController::class)->except([
    'show',
]);
Route::get('warehouse/api', [WarehouseController::class, 'api'])->name('warehouses.api');

Route::resource('categorys', CategoryController::class)->except([
    'show',
]);
Route::get('category/api', [CategoryController::class, 'api'])->name('categorys.api');

Route::resource('units', UnitController::class)->except([
    'show',
]);
Route::get('unit/api', [UnitController::class, 'api'])->name('units.api');


Route::resource('payment_methods', PaymentMethodController::class)->except([
    'show',
]);
Route::get('payment_methods/api', [PaymentMethodController::class, 'api'])->name('payment_methods.api');


Route::resource('employees', EmployeeController::class)->except([
    'show',
]);
Route::get('employee/api', [EmployeeController::class, 'api'])->name('employees.api');

Route::resource('customers', CustomerController::class)->except([
    'show',
]);
Route::get('customers/api', [CustomerController::class, 'api'])->name('customers.api');
