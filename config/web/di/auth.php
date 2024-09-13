<?php

declare(strict_types=1);

use Yiisoft\Auth\AuthenticationMethodInterface;
use Yiisoft\Auth\IdentityWithTokenRepositoryInterface;
use Yiisoft\Auth\Method\HttpHeader;
use Yiisoft\Auth\Middleware\Authentication;
use Yiisoft\Definitions\DynamicReference;
use Yiisoft\Http\Status;

use App\Handler\FailureHandler;
use App\Repository\IdentityRepository;

/** @var array $params */

return [
    IdentityWithTokenRepositoryInterface::class => IdentityRepository::class,
    AuthenticationMethodInterface::class => HttpHeader::class,
    Authentication::class => [
        '__construct()' => [
            'authenticationFailureHandler' => DynamicReference::to([
                'class' => FailureHandler::class,
                '__construct()' => ['status' => Status::UNAUTHORIZED],
            ]),
        ],
    ],
];
