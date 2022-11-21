<?php

declare(strict_types=1);

namespace Tests\Infrastructure\Persistence\Side;

use App\Domain\Side\SideNotFoundException;
use App\Infrastructure\Persistence\Side\InMemorySideRepository;
use Tests\TestCase;

class ImMemorySideRepositoryTest extends TestCase
{
    public function testFindAll()
    {
        $side = InMemorySideRepository::one();

        $sideRepository = new InMemorySideRepository([1 => $side]);

        $this->assertEquals([$side], $sideRepository->findAll());
    }

    public function testFindAllSidesByDefault()
    {
        $sides = InMemorySideRepository::default();

        $sideRepository = new InMemorySideRepository();

        $this->assertEquals(array_values($sides), $sideRepository->findAll());
    }

    public function testFindSideOfId()
    {
        $side = InMemorySideRepository::one();

        $userRepository = new InMemorySideRepository([1 => $side]);

        $this->assertEquals($side, $userRepository->findSideOfId(1));
    }

    public function testFindSideOfIdThrowsNotFoundException()
    {
        $userRepository = new InMemorySideRepository([]);
        $this->expectException(SideNotFoundException::class);
        $userRepository->findSideOfId(1);
    }
}
