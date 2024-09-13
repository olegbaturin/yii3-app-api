<?php

declare(strict_types=1);

namespace App\Resource;

final readonly class FooResource
{
    public function __construct(
        public string $id,
        public string $name,
    ) {}

    public string $address;
    public string $comment;
}
