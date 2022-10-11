<?php

declare(strict_types=1);

namespace Tests\Application\Actions\Transaction;

use App\Domain\Transaction\TransactionRepository;
use App\Infrastructure\Persistence\Transaction\InMemoryTransactionRepository;
use Tests\Application\Actions\ListActionTest;

class ListTransactionActionTest extends ListActionTest
{
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        $this->setExpectedDomain(InMemoryTransactionRepository::default());
        $this->setDomainRepository(TransactionRepository::class);
        $this->setPath('/transactions');
        parent::__construct($name, $data, $dataName);
    }
}
