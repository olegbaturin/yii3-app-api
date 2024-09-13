<?php

declare(strict_types=1);

namespace App\Exception;

use RuntimeException;
use Throwable;

final class EntityNotFoundException extends RuntimeException
{
    public function __construct($message = 'Entity not found', int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
