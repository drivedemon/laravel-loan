<?php

namespace App\Domain\Loan;

use App\Models\Loan;
use Illuminate\Database\Eloquent\Builder;

class LoanService
{

    /**
    * @var LoanRepositoryInterface
    */
    private LoanRepositoryInterface $repository;


    /**
     * LoanService constructor.
     * @param LoanRepositoryInterface $repository
     */
    public function __construct(LoanRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $payload
     * @return Loan
     */
    public function createLoan(array $payload): Loan
    {
        return $this->repository->createLoan($payload);
    }

    /**
    * @return Builder
    */
    public function getLoans(): Builder
    {
        return $this->repository->getLoans();
    }

    /**
     * @return Builder
     */
    public function filterLoans(): Builder
    {
        // TODO: implement search filter
        return $this->repository->filterLoans();
    }

    /**
    * @param string $loanId
    * @return Loan
    */
    public function getLoanById(string $loanId): Loan
    {
        return $this->repository->getLoanById($loanId);
    }

    /**
     * @param array $payload
     * @param Loan $loanModel
     * @return bool
     */
    public function updateLoan(array $payload, Loan $loanModel): bool
    {
        return $this->repository->updateLoan($payload, $loanModel);
    }

    /**
     * @param string $loanId
     * @return bool
     */
    public function deleteLoan(string $loanId): bool
    {
        return $this->repository->deleteLoan($loanId);
    }

    /**
     * @param LoanDTO $loan
     * @return array
     */
    public function pmtCalculate(LoanDTO $loan): array
    {
        $schedulePayment = [];

        $months = self::getMonthScope();
        $amount = $loan->getAmount();
        $term = $loan->getTerm();
        $ratePercent = $loan->getRate() / 100;
        $startMonth = $loan->getStartMonth();
        $startYear = $loan->getStartYear();
        $termYear = $term * 12;

        $divideRate = $ratePercent / 12;
        $initAmount = $amount * $divideRate;
        $divideAmount = 1 - (1 + $divideRate) ** (-12 * $term);
        $paymentAmount = $initAmount / $divideAmount;

        for ($i = 1; $i <= $termYear; $i++) {
            $previousBalance = $currentBalance ?? $amount;
            $currentMonth = $months[$startMonth];
            $currentDate = "$currentMonth $startYear";
            $currentInterest = $divideRate * $previousBalance;
            $currentPrincipal = $paymentAmount - $currentInterest;
            $currentBalance = $previousBalance - $currentPrincipal;

            array_push($schedulePayment,
                [
                    'current_date' => $currentDate,
                    'payment_amount' => $paymentAmount,
                    'principal' => $currentPrincipal,
                    'interest' => $currentInterest,
                    'balance' => $currentBalance,

                ]
            );
            if ($startMonth == 12) {
                $startMonth = 1;
                $startYear++;
            } else {
                $startMonth++;
            }
        }
        $schedulePayment[count($schedulePayment) - 1]['balance'] = 0;

        return $schedulePayment;
    }

    /**
     * @return array
     */
    public function getMonthScope(): array
    {
        $months = [];
        foreach (range(1, 12) as $month) {
            $months[$month] = date('F',  mktime(0, 0, 0, $month, 1));
        }
        return $months;
    }

    /**
     * @return array
     */
    public function getYearScope(): array
    {
        return range(2017, 2050);
    }
}
