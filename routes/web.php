<?php


use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\BasicAccountController;
use App\Http\Controllers\CreateInvestmentAccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvestmentAccountController;
use App\Http\Controllers\LogInController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\TransferContentController;
use App\Http\Controllers\TransferHistoryController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'show'])
    ->name('home.show');

Route::get('/registrationForm', [RegistrationController::class, 'show'])
    ->name('registrationForm.show');
Route::post('/register', [RegistrationController::class, 'validation'])
    ->name('register.validation');
Route::get('/register', [RegistrationController::class, 'create'])
    ->name('register.create');

Route::post('/logIn', [LogInController::class, 'logIn'])
    ->name('logIn.logIn');
Route::post('/logout', [LogoutController::class, 'execute'])
    ->name('logout.execute');

Route::get('/authenticationForm/{id}', [AuthenticationController::class, 'show'])
    ->name('authenticationForm.show');
Route::post('/authenticateUser/{id}', [AuthenticationController::class, 'verification'])
    ->name('authenticateUser.verification');
Route::put('/refreshCode/{id}', [AuthenticationController::class, 'update'])
    ->name('refreshCode.update');


Route::middleware(['twoFactorAuthentication:id'])->group(function () {
    Route::get('/basicAccount/{id}', [BasicAccountController::class, 'index'])
        ->name('basicAccount.index');

    Route::get('/transferForm/{id}', [TransferContentController::class, 'show'])
        ->name('transferForm.show');
    Route::post('/transferInfo/{id}', [TransferContentController::class, 'inform'])
        ->name('transferInfo.inform');
    Route::put('/sendCode/{id}', [TransferController::class, 'store'])
        ->name('sendCode.store');
    Route::get('/transfer/{id}', [TransferController::class, 'execute'])
        ->name('transfer.execute');
    Route::get('/transferHistory/{id}', [TransferHistoryController::class, 'show'])
        ->name('transferHistory.show');

    Route::get('/investmentAccountForm/{id}', [CreateInvestmentAccountController::class, 'show'])
        ->name('investmentAccountForm.show');
    Route::post('/investmentAccountForm/{id}', [CreateInvestmentAccountController::class, 'store'])
        ->name('investmentAccountForm.store');
    Route::get('/investmentAccount/{id}', [InvestmentAccountController::class, 'index'])
        ->name('investmentAccount.index');
    Route::put('/deposit/{id}', [InvestmentAccountController::class, 'deposit'])
        ->name('deposit.edit');
    Route::put('/withdrawal/{id}', [InvestmentAccountController::class, 'withdrawal'])
        ->name('withdrawal.edit');

    Route::get('/stock/{id}', [StockController::class, 'index'])
        ->name('stock.index');
    Route::post('/stock/buy/{id}', [StockController::class, 'store'])
        ->name('stock.store');
    Route::delete('/stock/sell/{id}', [StockController::class, 'destroy'])
        ->name('stock.sell');
});
