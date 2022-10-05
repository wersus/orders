<?php

declare(strict_types=1);

namespace App\Domain\Transaction;

use App\Domain\Side\Side;
use App\Domain\Terms\Terms;
use JsonSerializable;

/**
 * Сделка
 *
 */
class Transaction implements JsonSerializable
{
    public function __construct(
        private readonly Side $sideForm,
        private readonly Side $sideTo,
        private readonly Terms $terms
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            $this->sideForm,
            $this->sideTo,
            $this->terms,
        ];
    }

    public function getSideFrom(): Side
    {
        return $this->sideForm;
    }

    public function getTerms(): Terms
    {
        return $this->terms;
    }

    public function getSideTo(): Side
    {
        return $this->sideTo;
    }
}
