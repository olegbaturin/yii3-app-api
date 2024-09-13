<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Yiisoft\DataResponse\DataResponseFactoryInterface;
use Yiisoft\DataResponse\DataResponseFormatterInterface;
use Yiisoft\Http\Status;
use Yiisoft\Translator\TranslatorInterface;
use App\Response\ResponseDataFactory;

final class ApplicationFallbackHandler implements RequestHandlerInterface
{
    public function __construct(
        private ResponseDataFactory $responseDataFactory,
        private DataResponseFactoryInterface $dataResponseFactory,
        private DataResponseFormatterInterface $formatter,
        private TranslatorInterface $translator
    ) {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $responseData = $this->responseDataFactory->createResponseData()
            ->setStatus(Status::NOT_FOUND)
            ->setMessage($this->translator->translate('404.title'));

        return $this->formatter->format(
            $this->dataResponseFactory->createResponse(data: $responseData, code: Status::NOT_FOUND)
        );
    }
}
