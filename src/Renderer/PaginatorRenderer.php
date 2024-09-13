<?php

declare(strict_types=1);

namespace App\Renderer;

use Yiisoft\Data\Paginator\OffsetPaginator;
use Yiisoft\Data\Paginator\PaginatorInterface;

use App\Resource\PaginatorResource;

final class PaginatorRenderer
{
    public function render(PaginatorInterface $paginator): PaginatorResource
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
