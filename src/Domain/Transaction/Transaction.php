<?php

declare(strict_types=1);

namespace App\Domain\Transaction;

use App\Domain\Side\SideRepository;
use App\Domain\Terms\Terms;
use JsonSerializable;

/**
 * Сделка
 *
 */
class Transaction implements JsonSerializable
{
    /**
     * Стороны
     * @var SideRepository
     */
    private SideRepository $sides;

    /**
     * Условаия
     * @var Terms
     */
    private Terms $terms;

    public function __construct(SideRepository $sides, Terms $terms)
    {
        $this->sides = $sides;
        $this->terms = $terms;
    }

    public function jsonSerialize(): array
    {
        return [
            $this->sides,
            $this->terms,
        ];
    }

    public function getSides(): SideRepository
    {
        return $this->sides;
    }

    /**
     * @return Terms
     */
    public function getTerms(): Terms
    {
        return $this->terms;
    }
}
