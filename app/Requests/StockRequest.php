<?php

namespace App\Requests;

class StockRequest
{
//    private int $investmentAccountId;
    private int $costs;
    private int $numberOf;
    private string $symbol;

    public function __construct(/*int $investmentAccountId,*/ int $costs, int $numberOf, string $symbol)
    {
//        $this->investmentAccountId = $investmentAccountId;
        $this->costs = $costs;
        $this->numberOf = $numberOf;
        $this->symbol = $symbol;
    }

//    public function accountId(): int
//    {
//        return $this->investmentAccountId;
//    }

    public function costs(): int
    {
        return $this->costs;
    }

    public function numberOf(): int
    {
        return $this->numberOf;
    }

    public function symbol(): string
    {
        return $this->symbol;
    }
}
