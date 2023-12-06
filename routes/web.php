<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ReceiveChallanController;
use App\Http\Controllers\DeliveryChallanController;
use App\Http\Controllers\MovingChallanController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PartyPurchaseController;
use App\Http\Controllers\PettyPurchaseController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\WastageSaleController;
use App\Http\Controllers\CashSaleController;
use App\Http\Controllers\PartySaleController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:cache');
    Artisan::call('config:clear');
    Artisan::call('storage:link');
    echo '<script>alert("cache clear Success")</script>';
});

Route::get('/', function () {
    return view('login');
});

Auth::routes();
Route::get('/admin-logout',[LoginController::class,'user_logout'])->name('admin-logout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    /**
     * *********************
     * Bank Account
     * *********************
     */
    Route::get('bank_account/history/{account}',[BankAccountController::class,'history'])->name('bank_account.history');
    Route::resource('bank_account',BankAccountController::class);

    /**
     * *********************
     * Item
     * *********************
     */
    Route::get('item-variations/{itemId}', [ItemsController::class, 'getVariations'])->name('get.variations');
    Route::get('item/stock',[ItemsController::class, 'stock'])->name('item.stock');
    Route::resource('item', ItemsController::class);
    Route::resource('brand', BrandController::class);
    Route::get('unit/{unit}/get_related',[UnitController::class, 'get_related'])->name('unit.get_related');
    Route::resource('unit', UnitController::class);

    /**
     * *********************
     * Department
     * *********************
    */
    Route::resource('department', DepartmentController::class);
    Route::get('change-active-shop',[DepartmentController::class,'change_active'])->name('department.change_active');

    /**
     * *********************
     * Purchase
     * *********************
    */

    Route::resource('party-purchase', PartyPurchaseController::class)->except(['show']);
    Route::get('party-purchase/payment/list/{party_purchase}',[PartyPurchaseController::class,'payment_list'])->name('party-purchase.payment_list');
    Route::post('party-purchase/payment/by_invoice',[PartyPurchaseController::class,'by_invoice'])->name('party-purchase.invoice_payment');
    Route::get('party-purchase/{id}',[PartyPurchaseController::class,'get_purchase']);
    Route::get('challan-receive/{purchase}',[PartyPurchaseController::class,'challan_receive'])->name('challan.receive');
    Route::get('party/purchase/report',[PartyPurchaseController::class,'report'])->name('party-purchase.report');
    Route::get('party/purchase/invoice/{purchase_id}',[PartyPurchaseController::class,'invoice'])->name('party-purchase.invoice');

    Route::resource('petty-purchase', PettyPurchaseController::class)->except(['show']);
    Route::get('petty-purchase/payment/list/{party_purchase}',[PettyPurchaseController::class,'payment_list'])->name('petty-purchase.payment_list');
    Route::post('petty-purchase/payment/by_invoice',[PettyPurchaseController::class,'by_invoice'])->name('petty-purchase.invoice_payment');
    Route::get('petty/purchase/report',[PettyPurchaseController::class,'report'])->name('petty-purchase.report');
    Route::get('petty/purchase/invoice/{purchase_id}',[PettyPurchaseController::class,'invoice'])->name('petty-purchase.invoice');

    /**
     * *********************
     * Sale
     * *********************
    */

    Route::resource('party-sale', PartySaleController::class)->except(['show']);
    Route::get('party-sale/report',[PartySaleController::class,'report'])->name('party-sale.report');
    Route::get('party-sale/payment/list/{party_sale}',[PartySaleController::class,'payment_list'])->name('party-sale.payment_list');
    Route::post('party-sale/payment/by_invoice',[PartySaleController::class,'by_invoice'])->name('party-sale.invoice_payment');
    Route::get('party-sale/{id}',[PartySaleController::class,'get_sale']);
    Route::get('challan-delivery/{party_sale}',[PartySaleController::class,'challan_delivery'])->name('challan.delivery');
    Route::get('party-sale/invoice/{sale_id}',[PartySaleController::class,'invoice'])->name('party-sale.invoice');

    Route::resource('cash-sale', CashSaleController::class)->except(['show']);
    Route::get('cash-sale/report',[CashSaleController::class,'report'])->name('cash-sale.report');
    Route::get('cash-sale/invoice/{sale_id}',[CashSaleController::class,'invoice'])->name('cash-sale.invoice');

    Route::resource('wastage-sale', WastageSaleController::class)->except(['show']);
    Route::get('wastage-sale/report',[WastageSaleController::class,'report'])->name('wastage-sale.report');
    Route::get('wastage-sale/invoice/{sale_id}',[WastageSaleController::class,'invoice'])->name('wastage-sale.invoice');

    /**
     * *********************
     * Challan
     * *********************
    */
    Route::resource('receive-challan', ReceiveChallanController::class)->except(['show']);
    Route::get('receive-challan/report',[ReceiveChallanController::class, 'report'])->name('receive-challan.report');
    Route::get('receive-challan/invoice/{challan_id}',[ReceiveChallanController::class,'invoice'])->name('receive-challan.invoice');

    Route::resource('delivery-challan', DeliveryChallanController::class)->except(['show']);
    Route::get('delivery-challan/report',[DeliveryChallanController::class, 'report'])->name('delivery-challan.report');
    Route::get('delivery-challan/invoice/{challan_id}',[DeliveryChallanController::class,'invoice'])->name('delivery-challan.invoice');

    Route::resource('moving-challan', MovingChallanController::class)->except(['show']);
    Route::get('moving-challan/report',[MovingChallanController::class, 'report'])->name('moving-challan.report');
    
    /**
     * *********************
     * Payment
     * *********************
    */
    Route::resource('payment', PaymentController::class);
    /**
     * *********************
     * Reports
     * *********************
    */
    Route::get('top-sale/item/report',[ReportController::class, 'top_sale_item'])->name('top-sale-item.report');
    Route::get('top-purchase/item/report',[ReportController::class, 'top_purchase_item'])->name('top-purchase-item.report');
    Route::get('top-sale/party/report',[ReportController::class, 'top_sale_party'])->name('top-sale-party.report');
    Route::get('top-purchase/party/report',[ReportController::class, 'top_purchase_party'])->name('top-purchase-party.report');
    /**
     * *********************
     * People
     * *********************
    */
    Route::resource('party', PartyController::class);
    Route::resource('employee', EmployeeController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permission', PermissionController::class);
});
Route::get('/update-all', function () {
$allData = App\Models\items::all();
    foreach ($allData as $data){
        $data->update_calculated_data();
        $data->update();
    }
});