<?php

declare(strict_types=1);

namespace App\Domain\Side;

use App\Domain\Side\Side;
use App\Domain\Side\SideNotFoundException;

interface SideRepository
{
    /**
     * @return Side[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return Side
     * @throws SideNotFoundException
     */
    public function findSideOfId(int $id): Side;
}
