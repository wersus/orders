<?php

namespace App\Domain\Transaction;

use App\Domain\DomainException\DomainRecordNotFoundException;

class TransactionNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The transaction you requested does not exist.';
}
