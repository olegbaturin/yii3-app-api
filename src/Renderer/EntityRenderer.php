<?php

declare(strict_types=1);

namespace App\Renderer;

use Psr\Http\Message\ResponseInterface;

use App\Renderer\DataRenderer;
use App\Presenter\PresenterInterface;

final class EntityRenderer
{
    public function __construct(
        private DataRenderer $dataRenderer
    ) {}

    public function render(object|array $entity, PresenterInterface $presenter): ResponseInterface
    {
        return $this->dataRenderer->render($presenter->present($entity));
    }
}
