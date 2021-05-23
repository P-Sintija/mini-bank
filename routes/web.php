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
    ->name('register.validation');/// ?????!!!!???? /// post->store put/patch->update
Route::get('/register',[RegistrationController::class,'create'])
    ->name('register.create');

Route::post('/logIn', [LogInController::class, 'logIn'])
    ->name('logIn.logIn');/// ?????!!!!???? /// post->store put/patch->update
Route::post('/logout', [LogoutController::class, 'execute'])
    ->name('logout.execute');

Route::get('/authenticationForm/{id}', [AuthenticationController::class, 'show'])
    ->name('authenticationForm.show');
Route::post('/authenticateUser/{id}', [AuthenticationController::class, 'verification'])
    ->name('authenticateUser.verification'); /// ?????!!!!???? /// post->store put/patch->update
Route::post('/refreshCode/{id}', [AuthenticationController::class, 'create'])
    ->name('refreshCode.create'); /// ?????!!!!???? /// CREATE GET

Route::get('/basicAccount/{id}', [BasicAccountController::class, 'index'])
    ->name('basicAccount.index');//->middleware('twoFactorAuthentication:id');

Route::get('/transactionForm/{id}', [TransferContentController::class, 'show'])
    ->name('transactionForm.show');
Route::post('/transactionInfo/{id}', [TransferContentController::class, 'inform'])
    ->name('transactionInfo.inform'); /// ?????!!!!???? /// post->store put/patch->update
Route::post('/transfer/{id}', [TransferController::class, 'sendCode'])
    ->name('transfer.sendCode'); /// ?????!!!!???? /// post->store put/patch->update
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
Route::post('/deposit/{id}', [InvestmentAccountController::class, 'deposit'])
    ->name('deposit.edit'); /// ?????!!!!???? /// post->store put/patch->update

Route::post('/withdrawal/{id}', [InvestmentAccountController::class, 'withdrawal'])
    ->name('withdrawal.edit'); /// ?????!!!!???? /// post->store put/patch->update


Route::get('/stock', [StockController::class,'index'])
    ->name('stock.index');
Route::post('/stock/buy', [StockController::class,'store'])
    ->name('stock.store');
Route::delete('/stock/sell/{id}', [StockController::class,'destroy'])
    ->name('stock.sell');

Route::get('/example',[\App\Http\Controllers\EXAMPLE::class, 'index']);
