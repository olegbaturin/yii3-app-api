<?php

declare(strict_types=1);

namespace App\Exception;

use RuntimeException;
use Throwable;

final class ForbiddenException extends RuntimeException
{
    public function __construct($message = 'Forbidden request', int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
