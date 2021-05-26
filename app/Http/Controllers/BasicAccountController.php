<?php

namespace App\Http\Controllers;

use App\Services\AccountServices\BasicAccountServices\BasicAccountService;
use Illuminate\Contracts\View\View;

class BasicAccountController extends Controller
{
    private BasicAccountService $basicAccountService;

    public function __construct(BasicAccountService $basicAccountService)
    {
        $this->basicAccountService = $basicAccountService;
    }

    public function index(int $id): View
    {
        $user = $this->basicAccountService->handle($id);
        return view('basic-account.basicAccount', ['account' => $user]);
    }
}
