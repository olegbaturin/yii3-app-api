<?php

declare(strict_types=1);

namespace App\Renderer\Exception;

use Psr\Http\Message\ResponseInterface;
use Yiisoft\DataResponse\DataResponseFactoryInterface;
use Yiisoft\Http\Status;
use Yiisoft\Input\Http\InputValidationException;
use Yiisoft\Validator\Error;
use App\Response\ResponseDataFactory;

final class InputValidationExceptionRenderer
{
    public function __construct(
        private ResponseDataFactory $responseDataFactory,
        private DataResponseFactoryInterface $dataResponseFactory,
        private int $status = Status::UNPROCESSABLE_ENTITY
    ) {}

    public function __invoke(InputValidationException $e): ResponseInterface
    {
        $errors = array_map(fn(Error $it) => [
            'message' => $it->getMessage(),
            'field' => $it->getValuePath()[0],
        ], $e->getResult()->getErrors());

        $responseData = $this->responseDataFactory->createResponseData()
            ->setStatus($this->status)
            ->setMessage($e->getMessage())
            ->setErrors($errors);

        return $this->dataResponseFactory->createResponse(data: $responseData, code: $this->status);
    }
}
