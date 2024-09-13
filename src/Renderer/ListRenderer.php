<?php

declare(strict_types=1);

namespace App\Renderer;

use Psr\Http\Message\ResponseInterface;

use Yiisoft\Data\Paginator\PaginatorInterface;

use App\Renderer\CollectionRenderer;
use App\Presenter\PresenterInterface;

final class ListRenderer
{
    public function __construct(
        private readonly CollectionRenderer $collectionRenderer
    ) {}

        public function render(PaginatorInterface $paginator, PresenterInterface $presenter): ResponseInterface
    {
        $rows = [];
        foreach ($paginator->read() as $record) {
            $rows[] = $presenter->present($record);
        }

        return $this->collectionRenderer->render($rows, $paginator);
    }
}
