<?php

namespace App\Domain\Terms;

use JsonSerializable;

/**
 * Условия сделки
 * Terms of transaction
 *
 */
class Terms implements JsonSerializable
{
    public function __construct(private readonly ConditionInterface $condition)
    {
    }

    public function getCondition(): ConditionInterface
    {
        return $this->condition;
    }

    public function jsonSerialize(): array
    {
        return [
            "termCondition" => $this->condition,
        ];
    }
}
