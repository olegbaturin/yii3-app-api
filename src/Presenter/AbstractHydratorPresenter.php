<?php

declare(strict_types=1);

namespace App\Presenter;

use Yiisoft\Hydrator\HydratorInterface;

abstract class AbstractHydratorPresenter implements PresenterInterface
{
    public function __construct(
        protected readonly HydratorInterface $hydrator,
    ) {}
}
