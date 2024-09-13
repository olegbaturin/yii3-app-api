<?php

declare(strict_types=1);

namespace App\Presenter;

use App\Resource\FooResource;

final class FooListPresenter extends AbstractHydratorPresenter
{
    public function present(object $entity): FooResource
    {
        $data = [
            'id' => $entity->id,
            'name' => $entity->name,
            'comment' => $entity->desc,
        ];

        return $this->hydrator->create(FooResource::class, $data);
    }
}
