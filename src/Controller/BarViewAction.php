<?php

declare(strict_types=1);

namespace App\Controller;

use Psr\Http\Message\ResponseInterface;

use Yiisoft\Router\HydratorAttribute\RouteArgument;

use App\Presenter\BarPresenter;
use App\Renderer\EntityRenderer;

class BarViewAction
{
    public function __construct(
        private EntityRenderer $renderer,
        private BarPresenter $presenter
    ) {}

    public function __invoke(
        #[RouteArgument('id')] string $id
    ): ResponseInterface
    {
        $data = (object) [
            'id' => $id,
            'name' => 'bar name',
            'status' => 1,
            'address' => 'bar address',
            'desc' => 'bar comment'
        ];

        return $this->renderer->render($data, $this->presenter);
    }
}
