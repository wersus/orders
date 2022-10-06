<?php

declare(strict_types=1);

namespace App\Application\Actions\Side;

use Psr\Http\Message\ResponseInterface as Response;

class ListSideAction extends SideAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $sides = $this->sideRepository->findAll();

        $this->logger->info("Users list was viewed.");

        return $this->respondWithData($sides);
    }
}
