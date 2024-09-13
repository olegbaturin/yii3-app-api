<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Yiisoft\DataResponse\DataResponseFactoryInterface;
use Yiisoft\Http\Status;
use App\Response\ResponseDataFactory;

final class FailureHandler implements RequestHandlerInterface
{
    public function __construct(
        private ResponseDataFactory $responseDataFactory,
        private DataResponseFactoryInterface $dataResponseFactory,
        private int $status = Status::INTERNAL_SERVER_ERROR,
        private ?int $reason = null,
    ) {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $responseData = $this->responseDataFactory->createResponseData()
            ->setStatus($this->status)
            ->setMessage(Status::TEXTS[$this->status]);

        if (null !== $this->reason) {
            $responseData->setReason($this->reason);
        }

        return $this->dataResponseFactory->createResponse(data: $responseData, code: $this->status);
    }
}
