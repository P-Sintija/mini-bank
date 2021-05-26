<?php

namespace App\Requests;

class StockRequest
{
    private int $costs;
    private int $numberOf;
    private string $symbol;

    public function __construct(int $costs, int $numberOf, string $symbol)
    {
        $this->costs = $costs;
        $this->numberOf = $numberOf;
        $this->symbol = $symbol;
    }

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
