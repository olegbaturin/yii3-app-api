<?php

declare(strict_types=1);

use Yiisoft\Data\Paginator\PaginatorException;
use Yiisoft\Definitions\Reference;
use Yiisoft\ErrorHandler\ErrorResponseFactory;
use Yiisoft\ErrorHandler\ErrorResponseFactoryInterface;
use Yiisoft\Http\Status;
use Yiisoft\Input\Http\InputValidationException;
use App\Exception\EntityNotFoundException;
use App\Exception\ForbiddenException;
use App\Renderer\Error\ErrorJsonRenderer;
use App\Renderer\Error\ErrorResponseFactory as AppErrorResponseFactory;
use App\Renderer\Exception\InputValidationExceptionRenderer;
use App\Renderer\Exception\ExceptionRenderer;

/**
 * @var array $params
 */

return [
    ErrorResponseFactoryInterface::class => AppErrorResponseFactory::class,

    AppErrorResponseFactory::class => [
        '__construct()' => [
            'exceptionMap' => [
                DomainException::class => Status::BAD_REQUEST,
                PaginatorException::class => Status::NOT_FOUND,
                InputValidationException::class => InputValidationExceptionRenderer::class,
                EntityNotFoundException::class => Status::NOT_FOUND,
                ForbiddenException::class => Status::FORBIDDEN,
                Exception::class => ExceptionRenderer::class,
            ],
            'fallbackFactory' => Reference::to(ErrorResponseFactory::class),
        ],
    ],

    ErrorResponseFactory::class => [
        'withRenderer()' => ['contentType' => 'application/json', 'rendererClass' => ErrorJsonRenderer::class],
    ],
];
