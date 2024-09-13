<?php

declare(strict_types=1);

namespace App\Response;

final class ResponseDataFactory
{
    public function createResponseData(): ApiResponseData
    {
        return new ApiResponseData();
    }
}
