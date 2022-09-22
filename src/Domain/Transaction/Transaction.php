<?php

namespace App\Domain\Transaction;

use App\Domain\Side\SideCollection;
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
     * @var SideCollection
     */
    private SideCollection $sides;

    /**
     * Условаия
     * @var Terms
     */
    private Terms $terms;

    public function __construct(SideCollection $sides, Terms $terms)
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

    public function getSides(): SideCollection
    {
        return $this->sides;
    }
}
