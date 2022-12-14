<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Side;

use App\Domain\Domain\DomainRepositoryInterface;
use App\Domain\Side\Side;
use App\Domain\Side\SideNotFoundException;
use App\Domain\Side\SideRepository;
use App\Domain\User\User;

class InMemorySideRepository implements SideRepository, DomainRepositoryInterface
{
    public static function one(): Side
    {
        return new Side(1, new User(1, 'bill.gates', 'Bill', 'Gates'), true);
    }
    public static function default(): array
    {
        return [
            1 => self::one(),
            2 => new Side(2, new User(2, 'steve.jobs', 'Steve', 'Jobs'), true),
            3 => new Side(3, new User(3, 'mark.zuckerberg', 'Mark', 'Zuckerberg'), true),
            4 => new Side(4, new User(4, 'evan.spiegel', 'Evan', 'Spiegel'), true),
            5 => new Side(5, new User(5, 'jack.dorsey', 'Jack', 'Dorsey'), true),
        ];
    }

    /**
     * @var Side[]
     */
    private array $sides;

    public function __construct(array $sides = null)
    {
        $this->sides = $sides ?? self::default();
    }

    public function findAll(): array
    {
        return array_values($this->sides);
    }

    public function findSideOfId(int $id): Side
    {
        if (!isset($this->sides[$id])) {
            throw new SideNotFoundException();
        }

        return $this->sides[$id];
    }
}
