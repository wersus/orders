<?php

declare(strict_types=1);

namespace App\Domain\Transaction;

interface TransactionRepository
{
    /**
     * @return Transaction[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return Transaction
     * @throws TransactionNotFoundException
     */
    public function findTransactionOfId(int $id): Transaction;
}
