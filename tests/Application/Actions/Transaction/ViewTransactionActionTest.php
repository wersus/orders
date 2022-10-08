<?php

declare(strict_types=1);

namespace Tests\Application\Actions\Transaction;

use App\Application\Actions\ActionError;
use App\Application\Actions\ActionPayload;
use App\Application\Handlers\HttpErrorHandler;
use App\Domain\Side\Side;
use App\Domain\Terms\BoolCondition;
use App\Domain\Terms\Terms;
use App\Domain\Transaction\Transaction;
use App\Domain\Transaction\TransactionNotFoundException;
use App\Domain\Transaction\TransactionRepository;
use App\Domain\User\User;
use App\Domain\Uuid\Uuid;
use DI\Container;
use Slim\Middleware\ErrorMiddleware;
use Tests\TestCase;

class ViewTransactionActionTest extends TestCase
{
    public function testAction()
    {
        $app = $this->getAppInstance();

        /** @var Container $container */
        $container = $app->getContainer();

        $transaction = new Transaction(
            new Uuid(\Ramsey\Uuid\Uuid::fromInteger('3948539481')),
            new Side(1, new User(1, 'bill.gates', 'Bill', 'Gates'), true),
            new Side(1, new User(2, 'steve.jobs', 'Steve', 'Jobs'), true),
            new Terms(new BoolCondition(true)),
        );

        $transactionRepositoryProphecy = $this->prophesize(TransactionRepository::class);
        $transactionRepositoryProphecy
            ->findTransactionOfId(1)
            ->willReturn($transaction)
            ->shouldBeCalledOnce();

        $container->set(TransactionRepository::class, $transactionRepositoryProphecy->reveal());

        $request = $this->createRequest('GET', '/transactions/1');
        $response = $app->handle($request);

        $payload = (string) $response->getBody();
        $expectedPayload = new ActionPayload(200, $transaction);
        $serializedPayload = json_encode($expectedPayload, JSON_PRETTY_PRINT);

        $this->assertEquals($serializedPayload, $payload);
    }

    public function testActionThrowsUserNotFoundException()
    {
        $app = $this->getAppInstance();

        $callableResolver = $app->getCallableResolver();
        $responseFactory = $app->getResponseFactory();

        $errorHandler = new HttpErrorHandler($callableResolver, $responseFactory);
        $errorMiddleware = new ErrorMiddleware($callableResolver, $responseFactory, true, false, false);
        $errorMiddleware->setDefaultErrorHandler($errorHandler);

        $app->add($errorMiddleware);

        /** @var Container $container */
        $container = $app->getContainer();

        $transactionRepositoryProphecy = $this->prophesize(TransactionRepository::class);
        $transactionRepositoryProphecy
            ->findTransactionOfId(1)
            ->willThrow(new TransactionNotFoundException())
            ->shouldBeCalledOnce();

        $container->set(TransactionRepository::class, $transactionRepositoryProphecy->reveal());

        $request = $this->createRequest('GET', '/transactions/1');
        $response = $app->handle($request);

        $payload = (string) $response->getBody();
        $expectedError = new ActionError(ActionError::RESOURCE_NOT_FOUND, 'The user you requested does not exist.');
        $expectedPayload = new ActionPayload(404, null, $expectedError);
        $serializedPayload = json_encode($expectedPayload, JSON_PRETTY_PRINT);

        $this->assertEquals($serializedPayload, $payload);
    }
}
