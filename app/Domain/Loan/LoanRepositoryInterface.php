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
    * @param array $loan
    * @return Loan
    */
    public function createLoan(array $loan): Loan;

    /**
    * @param array $loan
    * @param Loan $loanModel
    * @return bool
    */
    public function updateLoan(array $loan, Loan $loanModel): bool;

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

    /**
    * @param array $loan
    * @return Loan
    */
    public function mapLoan(array $loan): array;
}
