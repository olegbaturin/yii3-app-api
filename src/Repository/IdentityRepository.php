<?php

declare(strict_types=1);

namespace App\Repository;

use Yiisoft\Auth\IdentityInterface;
use Yiisoft\Auth\IdentityWithTokenRepositoryInterface;

use App\Entity\Identity;

final class IdentityRepository implements IdentityWithTokenRepositoryInterface
{
    public function findIdentityByToken(string $token, string $type = null): ?IdentityInterface
    {
        return new Identity($token);
    }
}
