<?php

declare(strict_types=1);

use App\ApplicationParameters;

/** @var array $params */

return [
    /*ApplicationParameters::class => [
        'charset()' => [$params['app']['charset']],
        'name()' => [$params['app']['name']],
        'version()' => [$params['app']['version']],
        'author()' => [$params['app']['author']],
    ],*/
    ApplicationParameters::class => [
        '__construct()' => [
            'author' => $params['app']['author'],
            'charset' => $params['app']['charset'],
            'name' => $params['app']['name'],
            'version' => $params['app']['version'],
        ],
    ],
];
