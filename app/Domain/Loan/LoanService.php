<?php

namespace App\Domain\Loan;

use App\Models\Loan;

class LoanService
{

    /**
    * @var LoanRepository
    */
    private LoanRepository $repository;

    public function __construct(LoanRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $loan
     * @return Loan
     */
    public function collectLoan(array $loan): array
    {
        return $this->repository->mapLoan($loan);
    }

    /**
     * @param array $loan
     * @return Loan
     */
    public function createLoan(array $loan): Loan
    {
        return $this->repository->createLoan($loan);
    }
}
