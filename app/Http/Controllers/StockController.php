<?php

namespace App\Http\Controllers;

use App\Services\StockMarketService;
use Illuminate\Http\Request;

class StockController extends Controller
{
    private StockMarketService $stockMarketService;

    public function __construct(StockMarketService $stockMarketService)
    {
        $this->stockMarketService = $stockMarketService;
    }

    public function store(Request $request)
    {
        $this->stockMarketService->execute($request);
    }
}
