<?php

declare(strict_types=1);

use Yiisoft\Auth\Middleware\Authentication;
use Yiisoft\Router\Group;
use Yiisoft\Router\Route;

use App\Controller\BarViewAction;
use App\Controller\FooController;
use App\Controller\IndexController;
use App\Exception\EntityNotFoundException;
use App\Exception\ForbiddenException;

return [
    Route::get('/')
        ->name('app.index')
        ->action([IndexController::class, 'index']),
    Route::get('/resource')
        ->name('app.resource')
        ->action([IndexController::class, 'resource']),
    Route::get('/ping')
        ->name('app.ping')
        ->action([IndexController::class, 'ping']),

    Route::get('/bar/{id:\d+}')
        ->name('bar.view')
        ->action(BarViewAction::class),

    Group::create('/foo')->routes(
        Route::get('[/page{page:\d+}]')
            ->name('foo.index')
            ->action([FooController::class, 'index']),
        Route::get('/{id:\d+}')
            ->name('foo.view')
            ->action([FooController::class, 'view']),
    ),

    Route::get('/me')
        ->name('app.me')
        ->middleware(Authentication::class)
        /** will not be executed if request is unauthenticated */
        ->action(static fn() => throw new ForbiddenException(code: 901)),
    Route::get('/missed-entity')
        ->name('app.missed-entity')
        ->action(static fn() => throw new EntityNotFoundException(code: 801)),
];
