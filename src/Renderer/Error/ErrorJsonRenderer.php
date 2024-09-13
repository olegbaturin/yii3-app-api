<?php

declare(strict_types=1);

namespace App\Renderer\Error;

use function json_encode;
use Throwable;

use Psr\Http\Message\ServerRequestInterface;

use Yiisoft\ErrorHandler\ErrorData;
use Yiisoft\ErrorHandler\ThrowableRendererInterface;
use Yiisoft\Http\Status;

use App\Response\ResponseDataFactory;

/**
 * Formats throwable into JSON string.
 */
final class ErrorJsonRenderer implements ThrowableRendererInterface
{
    public function __construct(
        private ResponseDataFactory $responseDataFactory,
    ) {}

    public function render(Throwable $t, ServerRequestInterface $request = null): ErrorData
    {
        $responseData = $this->responseDataFactory->createResponseData()
            ->setStatus(Status::INTERNAL_SERVER_ERROR)
            ->setMessage(self::DEFAULT_ERROR_MESSAGE);

        if ($code = $e->getCode()) {
            $responseData->setReason($code);
        }

        return new ErrorData(
            json_encode($responseData,JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES)
        );
    }

    public function renderVerbose(Throwable $t, ServerRequestInterface $request = null): ErrorData
    {
        $responseData = $this->responseDataFactory->createResponseData()
            ->setStatus(Status::INTERNAL_SERVER_ERROR)
            ->setMessage($t->getMessage())
            ->setData([
                'type' => $t::class,
                'file' => $t->getFile(),
                'line' => $t->getLine(),
                //'trace' => $t->getTrace(),
                'memory' => memory_get_peak_usage(true),
            ]);

        if ($code = $e->getCode()) {
            $responseData->setReason($code);
        }

        return new ErrorData(
            json_encode($responseData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_INVALID_UTF8_SUBSTITUTE | JSON_PARTIAL_OUTPUT_ON_ERROR)
        );
    }
}
