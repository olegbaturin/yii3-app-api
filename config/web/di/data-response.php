<?php

declare(strict_types=1);

use Yiisoft\DataResponse\DataResponseFormatterInterface;
use Yiisoft\DataResponse\Formatter\JsonDataResponseFormatter;

/* @var array $params */

return [
    DataResponseFormatterInterface::class => JsonDataResponseFormatter::class,
];
