<?php

namespace App\Domain\Loan;

use App\Domain\DTO;
use Carbon\Traits\Timestamp;
use Ramsey\Uuid\Type\Integer;

/**
 * Class LoanDTO
 * @package App\Domain\Loan
 */
class LoanDTO extends DTO
{
    /**
     * @var integer
     */
    protected Integer $id;
    /**
     * @var integer
     */
    protected Integer $userId;
    /**
     * @var integer
     */
    protected Integer $loanAmount;
    /**
     * @var integer
     */
    protected Integer $loanTerm;
    /**
     * @var float
     */
    protected float $interestRate;
    /**
     * @var integer
     */
    protected Integer $startMonth;
    /**
     * @var integer
     */
    protected Integer $startYear;
    /**
     * @var Timestamp
     */
    protected Timestamp $createdAt;

    /**
     * @return Integer
     */
    public function getId(): Integer
    {
        return $this->id;
    }

    /**
     * @return Integer
     */
    public function getUserId(): Integer
    {
        return $this->userId;
    }

    /**
     * @return Integer
     */
    public function getAmount(): Integer
    {
        return $this->loanAmount;
    }

    /**
     * @return Integer
     */
    public function getTerm(): Integer
    {
        return $this->loanTerm;
    }

    /**
     * @return float
     */
    public function getRate(): ?float
    {
        return $this->interestRate;
    }

    /**
     * @return Integer
     */
    public function getStartMonth(): Integer
    {
        return $this->startMonth;
    }

    /**
     * @return Integer
     */
    public function getStartYear(): Integer
    {
        return $this->startYear;
    }

    /**
     * @return Timestamp
     */
    public function getCreatedAt(): Timestamp
    {
        return $this->createdAt;
    }
}
