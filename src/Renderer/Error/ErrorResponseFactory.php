<?php

declare(strict_types=1);

namespace App\Renderer\Error;

use Throwable;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Yiisoft\ErrorHandler\ErrorResponseFactoryInterface;
use Yiisoft\Injector\Injector;
use App\Renderer\Exception\ExceptionRenderer;

final class ErrorResponseFactory implements ErrorResponseFactoryInterface
{
    public function __construct(
        private array $exceptionMap,
        private ContainerInterface $container,
        private Injector $injector,
        private ErrorResponseFactoryInterface $fallbackFactory
    ) {}

    public function createResponse(Throwable $t, ServerRequestInterface $request): ResponseInterface
    {
        foreach ($this->exceptionMap as $exceptionType => $rendererClass) {
            if ($t instanceof $exceptionType) {
                /** @var int http status */
                if (is_int($rendererClass)) {
                    $renderer = $this->container->get(ExceptionRenderer::class);
                    return $renderer($t, $rendererClass);
                }

                if (is_callable($rendererClass)) {
                    /** @var ResponseInterface */
                    return $this->injector->invoke($rendererClass, ['exception' => $t]);
                }

                if (is_string($rendererClass) && $this->container->has($rendererClass)) {
                    $renderer = $this->container->get($rendererClass);
                    if (is_callable($renderer)) {
                        return $renderer($t);
                    }
                }
            }
        }

        return $this->fallbackFactory->createResponse($t, $request);
    }
}
