<?php

declare(strict_types=1);

namespace Tests\Application\Actions\Side;

use App\Application\Actions\ActionError;
use App\Application\Actions\ActionPayload;
use App\Application\Handlers\HttpErrorHandler;
use App\Domain\Side\SideNotFoundException;
use App\Domain\Side\SideRepository;
use App\Infrastructure\Persistence\Side\InMemorySideRepository;
use DI\Container;
use Slim\Middleware\ErrorMiddleware;
use Tests\TestCase;

class ViewSideActionTest extends TestCase
{
    public function testAction()
    {
        $app = $this->getAppInstance();

        /** @var Container $container */
        $container = $app->getContainer();

        $domain = InMemorySideRepository::one();

        $domainRepositoryProphecy = $this->prophesize(SideRepository::class);
        $domainRepositoryProphecy
            ->findSideOfId(1)
            ->willReturn($domain)
            ->shouldBeCalledOnce();

        $container->set(SideRepository::class, $domainRepositoryProphecy->reveal());

        $request = $this->createRequest('GET', '/sides/1');
        $response = $app->handle($request);

        $payload = (string) $response->getBody();
        $expectedPayload = new ActionPayload(200, $domain);
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

        $domainRepositoryProphecy = $this->prophesize(SideRepository::class);
        $domainRepositoryProphecy
            ->findSideOfId(1)
            ->willThrow(new SideNotFoundException())
            ->shouldBeCalledOnce();

        $container->set(SideRepository::class, $domainRepositoryProphecy->reveal());

        $request = $this->createRequest('GET', '/sides/1');
        $response = $app->handle($request);

        $payload = (string) $response->getBody();
        $expectedError = new ActionError(ActionError::RESOURCE_NOT_FOUND, 'The Side you requested does not exist.');
        $expectedPayload = new ActionPayload(404, null, $expectedError);
        $serializedPayload = json_encode($expectedPayload, JSON_PRETTY_PRINT);

        $this->assertEquals($serializedPayload, $payload);
    }
}
