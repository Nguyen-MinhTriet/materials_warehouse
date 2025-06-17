<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardsController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ExportReceiptController;
use App\Http\Controllers\ExportReceiptDetailController;
use App\Http\Controllers\ImportReceiptController;
use App\Http\Controllers\ImportReceiptDetailController;
use App\Http\Controllers\KhoController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\SupplierController;
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
// Route::group(['prefix' => 'kho', 'as' => 'warehouses.'], function () {
    //     Route::get('/', [KhoController::class, 'index'])->name('index');
    //     Route::get('/create', [KhoController::class, 'create'])->name('create');
    //     Route::post('/warehouse', [KhoController::class, 'store'])->name('store');
    //     Route::delete('/destroy', [KhoController::class, 'destroy'])->name('destroy');
    //     //   Route::get('/edit/{warehouse}', [WarehouseController::class, 'edit'])->name('edit');
    //     //   Route::post('/update/{warehouse}', [WarehouseController::class, 'update'])->name('update');
    // });
    Route::resource('dashboards', DashboardsController::class)->except([
        'show',
    ]);
    Route::get('dashboards/api', [DashboardsController::class, 'api'])->name('dashboards.api');
    
    Route::resource('warehouses', WarehouseController::class)->except([
        'show',
    ]);
    Route::get('warehouse/api', [WarehouseController::class, 'api'])->name('warehouses.api');
    Route::get('warehouses/geojson', [WarehouseController::class, 'geojson'])->name('warehouses.geojson');

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

Route::resource('suppliers', SupplierController::class)->except([
    'show',
]);
Route::get('suppliers/api', [SupplierController::class, 'api'])->name('suppliers.api');

Route::resource('materials', MaterialController::class)->except([
    'show',
]);
Route::get('/get-material-price/{id}', [MaterialController::class, 'getPrice'])->name('get.material.price');

Route::get('materials/api', [MaterialController::class, 'api'])->name('materials.api');

Route::resource('export_receipts', ExportReceiptController::class)->except([
    'show',
]);
Route::get('/export_receipts/{id}/print', [ExportReceiptController::class, 'print'])->name('export_receipts.print');
Route::get('/export_receipts/print/{id}', [ExportReceiptController::class, 'print'])->name('export_receipts.print');

Route::get('export_receipts/api', [ExportReceiptController::class, 'api'])->name('export_receipt.api');

Route::resource('import_receipts', ImportReceiptController::class)->except([
    'show',
]);
Route::get('/import_receipts/{id}/print', [ImportReceiptController::class, 'print'])->name('import_receipts.print');
Route::get('/import_receipts/print/{id}', [ImportReceiptController::class, 'print'])->name('import_receipts.print');
Route::get('import_receipts/api', [ImportReceiptController::class, 'api'])->name('import_receipt.api');

Route::resource('export_receipt_detail', ExportReceiptDetailController::class)->except([
    'show',
]);
Route::get('export_receipt_details/api', [ExportReceiptDetailController::class, 'api'])->name('export_receipt_detail.api');

Route::resource('import_receipt_detail', ImportReceiptDetailController::class)->except([
    'show',
]);
Route::get('import_receipt_details/api', [ImportReceiptDetailController::class, 'api'])->name('import_receipt_detail.api');
Route::resource('batches', BatchController::class)->except([
    'show',
]);
Route::get('batches/api', [BatchController::class, 'api'])->name('batches.api');
