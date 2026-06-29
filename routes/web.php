<?php

use Illuminate\Support\Facades\Route;

// --- Import Controllers ---
use App\Http\Controllers\Admin\{DashboardController, SPHController, ServiceController, ProductController, GalleryController, PartnerController, JOCController, ReportController, CustomerController as AdminCustomerController};
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\{EncryptionController, AuthController, CartController};
use App\Http\Controllers\Customer\{HomeController, ProductLayananController, CalculatorController, ProfileController};
use App\Http\Controllers\Customer\OrderController as CustomerOrderController;


/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang-kami', [HomeController::class, 'about'])->name('about');
Route::get('/eo', [HomeController::class, 'showEOPage'])->name('eo.index');
Route::get('/produk_layanan', [ProductLayananController::class, 'index'])->name('produk.layanan');
Route::get('/produk/{id}', [ProductLayananController::class, 'show'])->name('produk.detail');
Route::get('/portfolio', [HomeController::class, 'portfolio'])->name('portfolio.index');

Route::get('/calculator', [CalculatorController::class, 'index'])->name('calculator.index');
Route::get('/calculator/get-products/{service_id}', [CalculatorController::class, 'getProducts'])->name('calculator.get-products');
Route::post('/calculator/calculate', [CalculatorController::class, 'calculate'])->name('calculator.calculate');

/*
|--------------------------------------------------------------------------
| AUTHENTICATION & CUSTOMER ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// FIX: Menambahkan rute 'admin.login' agar middleware Authenticate tidak error saat admin ter-logout
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login'); 

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('customer.register');
Route::post('/register', [AuthController::class, 'register'])->name('customer.register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth:customer'])->group(function () {
    Route::post('/calculator/add-to-cart', [CartController::class, 'addToCart'])->name('customer.calculator.add-to-cart');
    Route::get('/customer/keranjang', [CartController::class, 'index'])->name('customer.cart.index');
    Route::delete('/customer/keranjang/{id}', [CartController::class, 'remove'])->name('customer.cart.remove');
    Route::post('/customer/keranjang/clear', [CartController::class, 'clear'])->name('customer.cart.clear');

    Route::prefix('orders')->name('customer.orders.')->group(function () {
        Route::get('/', [CustomerOrderController::class, 'index'])->name('index');
        Route::get('/create', [CustomerOrderController::class, 'create'])->name('create');
        Route::post('/', [CustomerOrderController::class, 'store'])->name('store');
        Route::post('/{order}/upload-payment', [CustomerOrderController::class, 'uploadPayment'])->name('upload-payment');
        Route::post('/{order}/cancel', [CustomerOrderController::class, 'cancel'])->name('cancel');
        Route::get('/{order}', [CustomerOrderController::class, 'show'])->name('show');
    });
    
    // --- Route Profil ---
    Route::get('/profile', [ProfileController::class, 'show'])->name('customer.profile.show');
    
    // Route baru untuk upload foto profil
    Route::post('/profile/update-photo', [ProfileController::class, 'updatePhoto'])->name('profile.update.photo');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware(['auth:web'])->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin Orders
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [AdminOrderController::class, 'index'])->name('index');
        Route::get('/{order}', [AdminOrderController::class, 'show'])->name('show');
        Route::post('/{order}/verify', [AdminOrderController::class, 'verify'])->name('verify');
        Route::post('/{order}/update-status', [AdminOrderController::class, 'updateStatus'])->name('update-status');
        Route::post('/{order}/reject', [AdminOrderController::class, 'reject'])->name('reject');
        Route::get('/{order}/download-payment-proof', [AdminOrderController::class, 'downloadPaymentProof'])->name('download-payment');
        Route::get('/{order}/download-design', [AdminOrderController::class, 'downloadDesign'])->name('download-design');
        Route::get('/export', [AdminOrderController::class, 'export'])->name('export');
    });

    // Rute Pelanggan
    Route::get('/customers', [AdminCustomerController::class, 'index'])->name('customers.index');

    // SPH Routes
    Route::prefix('sph')->name('sph.')->group(function () {
        Route::get('/{id}/print', [SPHController::class, 'print'])->name('print');
        Route::get('/{id}/duplicate', [SPHController::class, 'duplicate'])->name('duplicate');
    });
    Route::resource('sph', SPHController::class);

    Route::resource('services', ServiceController::class);
    Route::resource('products', ProductController::class);
    Route::resource('gallery', GalleryController::class);
    Route::resource('partners', PartnerController::class);
    Route::resource('joc', JOCController::class);
    
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/export-excel', [ReportController::class, 'exportExcel'])->name('reports.export_excel');
    Route::get('/reports/export-pdf', [ReportController::class, 'exportPdf'])->name('reports.export_pdf');
});

Route::fallback(fn() => response()->view('errors.404', [], 404));