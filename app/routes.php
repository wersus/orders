<?php

declare(strict_types=1);

use App\Application\Actions\Side\ListSideAction;
use App\Application\Actions\Side\ViewSideAction;
use App\Application\Actions\Transaction\ListTransactionsAction;
use App\Application\Actions\Transaction\ViewTransactionAction;
use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });

    $app->group('/transactions', function (Group $group) {
        $group->get('', ListTransactionsAction::class);
        $group->get('/{id}', ViewTransactionAction::class);
    });

    $app->group('/sides', function (Group $group) {
        $group->get('', ListSideAction::class);
        $group->get('/{id}', ViewSideAction::class);
    });
};
