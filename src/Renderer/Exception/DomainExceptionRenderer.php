<?php

declare(strict_types=1);

namespace App\Renderer\Exception;

use Psr\Http\Message\ResponseInterface;

use Yiisoft\DataResponse\DataResponseFactoryInterface;
use Yiisoft\Http\Status;

use App\Exception\DomainException;
use App\Response\ResponseDataFactory;

final class DomainExceptionRenderer
{
    public function __construct(
        private ResponseDataFactory $responseDataFactory,
        private DataResponseFactoryInterface $dataResponseFactory,
        private int $status = Status::BAD_REQUEST
    ) {}

    public function __invoke(DomainException $e): ResponseInterface
    {
        $errors = array_map(fn(string $it) => [
            'message' => $it,
        ], $e->getErrors());

        $responseData = $this->responseDataFactory->createResponseData()
            ->setStatus($this->status)
            ->setMessage($e->getMessage())
            ->setErrors($errors);

        return $this->dataResponseFactory->createResponse(data: $responseData, code: $this->status);
    }
}
