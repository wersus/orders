<?php

declare(strict_types=1);

use App\Domain\Side\SideRepository;
use App\Domain\Transaction\TransactionRepository;
use App\Domain\User\UserRepository;
use App\Infrastructure\Persistence\Side\InMemorySideRepository;
use App\Infrastructure\Persistence\Transaction\InMemoryTransactionRepository;
use App\Infrastructure\Persistence\User\InMemoryUserRepository;
use DI\ContainerBuilder;
use function DI\autowire;

return function (ContainerBuilder $containerBuilder) {
    // Here we map our UserRepository interface to its in memory implementation
    $containerBuilder->addDefinitions([
        UserRepository::class => autowire(InMemoryUserRepository::class),
        TransactionRepository::class => autowire(InMemoryTransactionRepository::class),
        SideRepository::class => autowire(InMemorySideRepository::class),
    ]);
};
