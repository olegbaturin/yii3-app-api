<?php

declare(strict_types=1);

namespace App\Resource;

final readonly class AboutResource
{
    public function __construct(
        public string $name,
        public string $version,
        public string $author,
        public ?string $license = null
    ) {}
}
