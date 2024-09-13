<?php

declare(strict_types=1);

namespace App\Presenter;

use App\Resource\BarResource;

final class BarPresenter implements PresenterInterface
{
    public function present(object $entity): BarResource
    {
        $resource = new BarResource(
            id: $entity->id,
            name: $entity->name,
        );

        $resource->setStatus($entity->status);
        $resource->setComment($entity->desc);

        return $resource;
    }
}
