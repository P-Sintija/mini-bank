<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'expires_at',
        'name',
        'surname',
        'SSN',
        'balance',
        'currency',
        'password'
    ];

    public function setTimeLimit(int $minutes): void
    {
        $this->expires_at = now()->addMinutes($minutes);
        $this->save();
    }


}
