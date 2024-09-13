<?php

declare(strict_types=1);

use Yiisoft\DataResponse\Formatter\JsonDataResponseFormatter;
use Yiisoft\DataResponse\Formatter\XmlDataResponseFormatter;
use Yiisoft\DataResponse\Middleware\FormatDataResponse;
use Yiisoft\ErrorHandler\Middleware\ErrorCatcher;
use Yiisoft\Router\Middleware\Router;
use Yiisoft\Yii\Middleware\Subfolder;

return [
    'middlewares' => [
        FormatDataResponse::class,
        ErrorCatcher::class,
        Subfolder::class,
        Router::class,
    ],

    'yiisoft/input-http' => [
        'requestInputParametersResolver' => [
            'throwInputValidationException' => true,
        ],
    ],

    'yiisoft/data-response' => [
        'contentFormatters' => [
            'application/json' => JsonDataResponseFormatter::class,
            'application/xml' => XmlDataResponseFormatter::class,
        ],
    ],
];
