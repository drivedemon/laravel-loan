<?php

namespace App\Domain\Loan;

use App\Models\Loan;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

/**
* Interface LoanRepositoryInterface
* @package App\Domain\Loan
*/
interface LoanRepositoryInterface
{
    /**
     * @param array $payload
     * @return Loan
     */
    public function createLoan(array $payload): Loan;

    /**
     * @param array $payload
     * @param Loan $loanModel
     * @return bool
     */
    public function updateLoan(array $payload, Loan $loanModel): bool;

    /**
    * @param string $loanId
    * @return bool
    */
    public function deleteLoan(string $loanId): bool;

    /**
    * @return Builder
    */
    public function getLoans(): Builder;

    /**
    * @return Builder
    */
    public function filterLoans(): Builder;

    /**
    * @param string $loanId
    * @return Loan
    */
    public function getLoanById(string $loanId): Loan;
}
