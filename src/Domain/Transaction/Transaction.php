<?php

declare(strict_types=1);

namespace App\Domain\Transaction;

use App\Domain\Side\Side;
use App\Domain\Terms\Terms;
use App\Domain\Uuid\Uuid;
use JsonSerializable;

/**
 * Сделка
 *
 */
class Transaction implements JsonSerializable
{
    public function __construct(
        private readonly Uuid $uuid,
        private readonly Side $sideForm,
        private readonly Side $sideTo,
        private readonly Terms $terms
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            "uuid" => $this->uuid,
            "sideFrom" => $this->sideForm,
            "sideTo" => $this->sideTo,
            "terms" => $this->terms,
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

    public function getUuid(): Uuid
    {
        return $this->uuid;
    }
}
