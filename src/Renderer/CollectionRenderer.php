<?php

declare(strict_types=1);

namespace App\Renderer;

use Yiisoft\Data\Paginator\PaginatorInterface;
use Yiisoft\DataResponse\DataResponseFactoryInterface;
use Yiisoft\DataResponse\DataResponse;
use Yiisoft\Strings\Inflector;

use App\Response\ResponseDataFactory;
use App\Presenter\PaginatorPresenter;

final class CollectionRenderer
{
    public function __construct(
        private ResponseDataFactory $responseDataFactory,
        private PaginatorPresenter $paginatorPresenter,
        private Inflector $inflector,
        private DataResponseFactoryInterface $dataResponseFactory
    ) {}

    public function render(array $rows, PaginatorInterface $paginator): DataResponse
    {
        $pagination = $this->paginatorPresenter->present($paginator);
        $responseData = $this->responseDataFactory->createResponseData()
            ->setData($rows)
            ->setPagination($pagination);

        $response = $this->dataResponseFactory->createResponse($responseData);

        foreach ($pagination as $prop => $value) {
            $response = $response->withHeader('X-Pagination-'.$this->inflector->toPascalCase($prop), $value);
        }

        return $response;
    }
}
