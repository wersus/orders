<?php

declare(strict_types=1);

namespace App\Domain\Side;

use App\Domain\Domain\DomainInterface;
use App\Domain\User\User;
use JsonSerializable;

class Side implements JsonSerializable, DomainInterface
{
    public function __construct(
        private readonly ?int $id,
        private readonly User $user,
        private readonly bool $is_person
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            "id" => $this->id,
            "user" => $this->user,
            "is_person" => $this->is_person,
        ];
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return bool
     */
    public function isIsPerson(): bool
    {
        return $this->is_person;
    }
}
