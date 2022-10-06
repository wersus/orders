<?php

declare(strict_types=1);

namespace App\Application\Actions\Side;

use Psr\Http\Message\ResponseInterface as Response;

class ViewSideAction extends SideAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $sideId = (int) $this->resolveArg('id');
        $user = $this->sideRepository->findSideOfId($sideId);

        $this->logger->info("side of id `${sideId}` was viewed.");

        return $this->respondWithData($user);
    }
}
