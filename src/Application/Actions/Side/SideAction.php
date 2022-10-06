<?php

declare(strict_types=1);

namespace App\Application\Actions\Side;

use App\Application\Actions\Action;
use App\Domain\Side\SideRepository;
use Psr\Log\LoggerInterface;

abstract class SideAction extends Action
{
    protected SideRepository $sideRepository;

    public function __construct(LoggerInterface $logger, SideRepository $sideRepository)
    {
        parent::__construct($logger);
        $this->sideRepository = $sideRepository;
    }
}
