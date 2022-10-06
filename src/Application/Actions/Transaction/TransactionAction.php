<?php

declare(strict_types=1);

namespace App\Application\Actions\Transaction;

use App\Application\Actions\Action;
use App\Domain\Transaction\TransactionRepository;
use Psr\Log\LoggerInterface;

abstract class TransactionAction extends Action
{
    protected TransactionRepository $transactionRepository;

    public function __construct(LoggerInterface $logger, TransactionRepository $transactionRepository)
    {
        parent::__construct($logger);
        $this->transactionRepository = $transactionRepository;
    }
}
