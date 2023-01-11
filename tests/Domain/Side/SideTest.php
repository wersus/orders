<?php

declare(strict_types=1);

namespace Tests\Domain\Side;

use App\Domain\Side\Side;
use App\Domain\Side\SideRepository;
use App\Domain\User\User;
use App\Infrastructure\Persistence\Side\InMemorySideRepository;
use Tests\TestCase;

class SideTest extends TestCase
{
    public function sideProvider(): array
    {
        return InMemorySideRepository::default();
    }

    /**
     * @dataProvider sideProvider
     * @param int $id
     * @param User $user
     */
    public function testGetters(int $id, User $user)
    {
        $side = new Side($id, $user, false);

        $this->assertEquals($id, $side->getId());
        $this->assertEquals($user, $side->getUser());
    }

    /**
     * @dataProvider sideProvider
     * @param int $id
     * @param User $user
     */
    public function testJsonSerialize(int $id, User $user)
    {
        $side = new Side($id, $user, false);

        $expectedPayload = json_encode([
            'id' => $id,
            'user' => $user]);

        $this->assertEquals($expectedPayload, json_encode($side));
    }
}
