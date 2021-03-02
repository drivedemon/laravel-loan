<?php

namespace App\Domain\Loan;

use App\Models\Loan;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

/**
* Class LoanRepository
* @package App\Domain\Loan
*/
class LoanRepository implements LoanRepositoryInterface
{
    /**
    * @param array $loan
    * @return Loan
    */
    public function createLoan(array $loan): Loan
    {
        return Loan::create($loan);
    }

    /**
    * @param array $loan
    * @param Loan $loanModel
    * @return bool
    */
    public function updateLoan(array $loan, Loan $loanModel): bool
    {
        return $loanModel->update($loan);
    }

    /**
    * @param string $loanId
    * @return bool
    */
    public function deleteLoan(string $loanId): bool
    {
        return Loan::destroy($loanId);
    }

    /**
    * @return Builder
    */
    public function getLoans(): Builder
    {
        return Loan::whereNotNull(Loan::USER_ID);
    }

    /**
    * @return Builder
    */
    public function filterLoans(): Builder
    {
        // TODO: implement search filter
    }

    /**
    * @param string $loanId
    * @return Loan
    */
    public function getLoanById(string $loanId): Loan
    {
        return Loan::find($loanId);
    }

    /**
    * @param array $loan
    * @return Loan
    */
    public function mapLoan(array $loan): array
    {
        return [
            Loan::USER_ID => $loan['user_id'],
            Loan::LOAN_AMOUNT => $loan['loan_amount'],
            Loan::LOAN_TERM => $loan['loan_term'],
            Loan::INTEREST_RATE => $loan['interest_rate'],
            Loan::START_MONTH => $loan['start_month'],
            Loan::START_YEAR => $loan['start_year'],
        ];
    }
}
