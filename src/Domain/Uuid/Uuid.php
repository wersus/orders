<?php

namespace App\Domain\Uuid;

use JsonSerializable;
use Ramsey\Uuid\UuidInterface;

class Uuid implements JsonSerializable
{
    public function __construct(private readonly UuidInterface $uuid)
    {
    }

    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }

    public function jsonSerialize(): array
    {
        return [
            'uuid' => $this->uuid,
        ];
    }
}
