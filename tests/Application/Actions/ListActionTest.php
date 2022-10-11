<?php

declare(strict_types=1);

namespace Tests\Application\Actions;

use App\Application\Actions\ActionPayload;
use DI\Container;
use Exception;
use Tests\TestCase;

class ListActionTest extends TestCase
{
    private $expected_domain;
    private string $domain_repository = '';
    private string $path;

    /**
     * @throws Exception
     */
    public function testAction()
    {
        $app = $this->getAppInstance();

        /** @var Container $container */
        $container = $app->getContainer();

        $domainRepositoryProphecy = $this->prophesize($this->domain_repository);
        $domainRepositoryProphecy
            ->findAll()
            ->willReturn([$this->expected_domain])
            ->shouldBeCalledOnce();

        $container->set($this->domain_repository, $domainRepositoryProphecy->reveal());

        $request = $this->createRequest('GET', $this->path);
        $response = $app->handle($request);

        $payload = (string)$response->getBody();
        $expectedPayload = new ActionPayload(200, [$this->expected_domain]);
        $serializedPayload = json_encode($expectedPayload, JSON_PRETTY_PRINT);

        $this->assertEquals($serializedPayload, $payload);
    }

    public function setExpectedDomain($expected_domain): void
    {
        $this->expected_domain = $expected_domain;
    }

    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    public function setDomainRepository(string $domain_repository): void
    {
        $this->domain_repository = $domain_repository;
    }
}
