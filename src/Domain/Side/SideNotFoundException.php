<?php

declare(strict_types=1);

namespace App\Domain\Side;

use App\Domain\DomainException\DomainRecordNotFoundException;

class SideNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The Side you requested does not exist.';
}
