<?php

declare(strict_types=1);

namespace Tests\Application\Actions\Side;

use App\Application\Actions\ActionPayload;
use App\Domain\Side\SideRepository;
use App\Infrastructure\Persistence\Side\InMemorySideRepository;
use DI\Container;
use Tests\TestCase;

class ListSideActionTest extends TestCase
{
    public function testAction()
    {
        $app = $this->getAppInstance();

        /** @var Container $container */
        $container = $app->getContainer();

        $domain = InMemorySideRepository::default();

        $domainRepositoryProphecy = $this->prophesize(SideRepository::class);
        $domainRepositoryProphecy
            ->findAll()
            ->willReturn([$domain])
            ->shouldBeCalledOnce();

        $container->set(SideRepository::class, $domainRepositoryProphecy->reveal());

        $request = $this->createRequest('GET', '/sides');
        $response = $app->handle($request);

        $payload = (string) $response->getBody();
        $expectedPayload = new ActionPayload(200, [$domain]);
        $serializedPayload = json_encode($expectedPayload, JSON_PRETTY_PRINT);

        $this->assertEquals($serializedPayload, $payload);
    }
}
