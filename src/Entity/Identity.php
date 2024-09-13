<?php

declare(strict_types=1);

namespace App\Entity;

use Yiisoft\Auth\IdentityInterface;

class Identity implements IdentityInterface
{
    public function __construct(
        private string $id
    ) {}

    public function getId(): ?string
    {
        return $this->id;
    }
}
