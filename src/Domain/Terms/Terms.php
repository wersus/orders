<?php

namespace App\Domain\Terms;

/**
 * Условия сделки
 * Terms of transaction
 *
 * @todo make type of condition
 */
class Terms
{
    public function __construct($condition)
    {
        $this->condition = $condition;
    }

    private $condition;

    public function getCondition()
    {
        return $this->condition;
    }

}