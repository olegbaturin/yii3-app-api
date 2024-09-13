<?php

declare(strict_types=1);

namespace App\Presenter;

use Yiisoft\Data\Paginator\OffsetPaginator;
use Yiisoft\Data\Paginator\PaginatorInterface;

use App\Resource\PaginatorResource;

final class PaginatorPresenter implements PresenterInterface
{
    public function present(PaginatorInterface $paginator): PaginatorResource
    {
        $resource = new PaginatorResource(
            page: $paginator->getCurrentPage(),
            size: $paginator->getPageSize()
        );

        if ($paginator instanceof OffsetPaginator) {
            $resource->setCount($paginator->getTotalItems());
            $resource->setPages($paginator->getTotalPages());
        }

        return $resource;
    }
}
