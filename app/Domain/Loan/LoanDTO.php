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
     * @var int
     */
    protected $id;
    /**
     * @var int
     */
    protected $userId;
    /**
     * @var int
     */
    protected $amount;
    /**
     * @var int
     */
    protected $term;
    /**
     * @var float
     */
    protected $rate;
    /**
     * @var int
     */
    protected $startMonth;
    /**
     * @var int
     */
    protected $startYear;
    /**
     * @var Timestamp
     */
    protected Timestamp $createdAt;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return int|null
     */
    public function getAmount(): ?int
    {
        return $this->amount;
    }

    /**
     * @return int|null
     */
    public function getTerm(): ?int
    {
        return $this->term;
    }

    /**
     * @return float|null
     */
    public function getRate(): ?float
    {
        return $this->rate;
    }

    /**
     * @return int|null
     */
    public function getStartMonth(): ?int
    {
        return $this->startMonth;
    }

    /**
     * @return int|null
     */
    public function getStartYear(): ?int
    {
        return $this->startYear;
    }

    /**
     * @return Timestamp|null
     */
    public function getCreatedAt(): ?Timestamp
    {
        return $this->createdAt;
    }
}
