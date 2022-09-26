<?php

declare(strict_types=1);

namespace App\Domain\Side;

use App\Domain\User\User;
use JsonSerializable;

class Side implements JsonSerializable
{
    private ?int $id;

    private User $user;

    private bool $is_person;

    public function __construct(?int $id, User $user, bool $is_person)
    {
        $this->id = $id;
        $this->user = $user;
        $this->is_person = $is_person;
    }

    public function jsonSerialize(): array
    {
        return [
            $this->id,
            $this->user,
            $this->is_person,
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
