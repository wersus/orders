<?php

declare(strict_types=1);

namespace App\Application\Actions\Transaction;

use Psr\Http\Message\ResponseInterface as Response;

class ViewTransactionAction extends TransactionAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $transactionId = (int) $this->resolveArg('id');
        $user = $this->transactionRepository->findTransactionOfId($transactionId);

        $this->logger->info("Transaction of id `${transactionId}` was viewed.");

        return $this->respondWithData($user);
    }
}
