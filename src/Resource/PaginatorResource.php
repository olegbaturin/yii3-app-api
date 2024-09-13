<?php

declare(strict_types=1);

namespace App\Resource;

final readonly class PaginatorResource
{
    public function __construct(
        public int $page,
        public int $size,
    ) {}

    public int $count;
    public int $pages;

    public function setCount(int $v): void
    {
        $this->count = $v;
    }

    public function setPages(int $v): void
    {
        $this->pages = $v;
    }
}
