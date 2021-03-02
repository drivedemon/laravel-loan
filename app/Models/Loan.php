<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    const USER_ID = 'user_id';
    const LOAN_AMOUNT = 'amount';
    const LOAN_TERM = 'term';
    const INTEREST_RATE = 'rate';
    const START_MONTH = 'start_month';
    const START_YEAR = 'start_year';

    /**
     * @var array
     */
    protected $fillable = [
        self::USER_ID,
        self::LOAN_AMOUNT,
        self::LOAN_TERM,
        self::INTEREST_RATE,
        self::START_MONTH,
        self::START_YEAR,
    ];
}
