<?php

declare(strict_types=1);

namespace App\Renderer;

use Yiisoft\DataResponse\DataResponseFactoryInterface;
use Yiisoft\DataResponse\DataResponse;

use App\Response\ResponseDataFactory;

final class DataRenderer
{
    public function __construct(
        private ResponseDataFactory $responseDataFactory,
        private DataResponseFactoryInterface $dataResponseFactory
    ) {}

    public function render(mixed $data): DataResponse
    {
        $responseData = $this->responseDataFactory->createResponseData();

        if (null !== $data) {
            $responseData->setData($data);
        }

        return $this->dataResponseFactory->createResponse($responseData);
    }
}
