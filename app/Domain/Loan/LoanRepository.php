<?php

namespace App\Domain\Loan;

use App\Models\Loan;
use Illuminate\Database\Eloquent\Builder;

/**
* Class LoanRepository
* @package App\Domain\Loan
*/
class LoanRepository implements LoanRepositoryInterface
{
    /**
    * @param array $payload
    * @return Loan
    */
    public function createLoan(array $payload): Loan
    {
        return Loan::create($payload);
    }

    /**
    * @param array $payload
    * @param Loan $loanModel
    * @return bool
    */
    public function updateLoan(array $payload, Loan $loanModel): bool
    {
        return $loanModel->update($payload);
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
}
