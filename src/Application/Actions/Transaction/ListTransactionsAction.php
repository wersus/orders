<?php

declare(strict_types=1);

namespace App\Application\Actions\Transaction;

use Psr\Http\Message\ResponseInterface as Response;

class ListTransactionsAction extends TransactionAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $transactions = $this->transactionRepository->findAll();

        $this->logger->info("Users list was viewed.");

        return $this->respondWithData($transactions);
    }
}
