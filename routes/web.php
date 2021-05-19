<?php


use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\BasicAccountController;
use App\Http\Controllers\CreateInvestmentAccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogInController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\TransferContentController;
use App\Http\Controllers\TransferHistoryController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'show'])->name('home.show');

Route::get('/registrationForm', [RegistrationController::class, 'show'])->name('registrationForm.show');
Route::post('/register', [RegistrationController::class, 'validation'])->name('register.validation');
Route::get('/register',[RegistrationController::class,'create'])->name('register.create');

Route::post('/logIn', [LogInController::class, 'logIn'])->name('logIn.logIn');
Route::post('/logout', [LogoutController::class, 'execute'])->name('logout.execute');

Route::get('/authenticationForm/{id}', [AuthenticationController::class, 'show'])->name('authenticationForm.show');
Route::post('/authenticateUser/{id}', [AuthenticationController::class, 'verification'])->name('authenticateUser.verification');
Route::post('/refreshCode/{id}', [AuthenticationController::class, 'create'])->name('refreshCode.create');

Route::get('/basicAccount/{id}', [BasicAccountController::class, 'show'])->name('basicAccount.show');//->middleware('twoFactorAuthentication:id');

Route::get('/transactionForm/{id}', [TransferContentController::class, 'show'])->name('transactionForm.show');
Route::post('/transactionInfo/{id}', [TransferContentController::class, 'inform'])->name('transactionInfo.inform');
Route::post('/transfer/{id}', [TransferController::class, 'sendCode'])->name('transfer.sendCode');
Route::get('/transfer/{id}', [TransferController::class, 'execute'])->name('transfer.execute');
Route::get('/transferHistory/{id}', [TransferHistoryController::class, 'show'])->name('transferHistory.show');





Route::get('/investmentAccountForm/{id}', [CreateInvestmentAccountController::class, 'accountsForm'])
    ->name('investmentAccountForm.accountsForm');
Route::post('/investmentAccountForm/{id}', [CreateInvestmentAccountController::class, 'createAccount'])
    ->name('investmentAccountForm.createAccount');



