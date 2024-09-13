<?php

declare(strict_types=1);

namespace App\Resource;

final readonly class BarResource
{
    private const STATUS_MAP = [
        1 => 'new',
        2 => 'done',
    ];

    public function __construct(
        public string $id,
        public string $name,
    ) {}

    public string $status;
    public string $address;
    public string $comment;

    public function setStatus(int $v): void
    {
        $this->status = self::STATUS_MAP[$v];
    }

    public function setAddress(string $v): void
    {
        $this->address = $v;
    }

    public function setComment(string $v): void
    {
        $this->comment = $v;
    }
}
