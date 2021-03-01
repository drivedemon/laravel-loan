<?php

namespace App\Domain\Loan;

use App\Domain\DTO;

/**
 * Class LoanDTO
 * @package App\Domain\Loan
 */
class LoanDTO extends DTO
{
    /**
     * @var integer|null
     */
    protected $userId;
    /**
     * @var integer|null
     */
    protected $loanAmount;
    /**
     * @var integer|null
     */
    protected $loanTerm;
    /**
     * @var float|null
     */
    protected $interestRate;
    /**
     * @var integer|null
     */
    protected $startMonth;
    /**
     * @var integer|null
     */
    protected $startYear;

    /**
     * @return integer|null
     */
    public function getUserId(): integer
    {
        return $this->userId;
    }

    /**
     * @return integer|null
     */
    public function getAmount(): integer
    {
        return $this->loanAmount;
    }

    /**
     * @return integer|null
     */
    public function getTerm(): integer
    {
        return $this->loanTerm;
    }

    /**
     * @return float|null
     */
    public function getRate(): ?float
    {
        return $this->interestRate;
    }

    /**
     * @return integer|null
     */
    public function getStartMonth(): integer
    {
        return $this->startMonth;
    }

    /**
     * @return integer|null
     */
    public function getStartYear(): integer
    {
        return $this->startYear;
    }
}
