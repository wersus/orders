<?php

namespace App\Domain\Terms;

use JsonSerializable;

class BoolCondition implements ConditionInterface, JsonSerializable
{
    public function __construct(private readonly bool $condition)
    {
    }

    /**
     * @return bool
     */
    public function getCondition(): bool
    {
        return $this->condition;
    }

    public function jsonSerialize(): array
    {
        return [
            'condition' => $this->condition,
        ];
    }
}
