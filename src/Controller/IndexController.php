<?php

declare(strict_types=1);

namespace App\Controller;

use Psr\Http\Message\ResponseInterface;

use Yiisoft\DataResponse\DataResponseFactoryInterface;

use App\ApplicationParameters;
use App\Renderer\DataRenderer;
use App\Resource\AboutResource;

class IndexController
{
    public function __construct(
        private ApplicationParameters $appParams,
        private DataRenderer $dataRenderer
    ) {}

    public function index(): ResponseInterface
    {
        return $this->dataRenderer->render([
            'name' => $this->appParams->getName(),
            'version' => $this->appParams->getVersion(),
            'author' => $this->appParams->getAuthor(),
            'license' => 'BSD License',
        ]);
    }

    public function resource(): ResponseInterface
    {
        $data = new AboutResource(
            name: $this->appParams->getName(),
            version: $this->appParams->getVersion(),
            author: $this->appParams->getAuthor()
        );

        return $this->dataRenderer->render($data);
    }

    public function ping(
        DataResponseFactoryInterface $responseFactory
    ): ResponseInterface
    {
        return $responseFactory->createResponse();
    }
}
