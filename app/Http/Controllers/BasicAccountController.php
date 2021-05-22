<?php

namespace App\Http\Controllers;

use App\Models\BasicAccount;
use Illuminate\Contracts\View\View;


class BasicAccountController extends Controller
{
    public function index(int $id): View
    {
        $user = BasicAccount::find($id);
        return view('basicAccount', ['account' => $user]);
    }
}
