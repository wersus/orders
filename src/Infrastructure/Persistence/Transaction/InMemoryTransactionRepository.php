<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Transaction;

use App\Domain\Side\Side;
use App\Domain\Terms\BoolCondition;
use App\Domain\Terms\Terms;
use App\Domain\Transaction\Transaction;
use App\Domain\Transaction\TransactionNotFoundException;
use App\Domain\Transaction\TransactionRepository;
use App\Domain\User\User;
use App\Domain\Uuid\Uuid;

class InMemoryTransactionRepository implements TransactionRepository
{
    private array $transactions;

    public function __construct(array $transactions = null)
    {
        $this->transactions = $transactions ?? self::default();
    }

    public static function default()
    {
        return [
            1 => new Transaction(
                new Uuid(\Ramsey\Uuid\Uuid::fromInteger('3948539481')),
                new Side(1, new User(1, 'bill.gates', 'Bill', 'Gates'), true),
                new Side(1, new User(2, 'steve.jobs', 'Steve', 'Jobs'), true),
                new Terms(new BoolCondition(true)),
            ),
        ];
    }

    public function findAll(): array
    {
        return array_values($this->transactions);
    }

    public function findTransactionOfId(int $id): Transaction
    {
        if (!isset($this->transactions[$id])) {
            throw new TransactionNotFoundException();
        }

        return $this->transactions[$id];
    }
}
