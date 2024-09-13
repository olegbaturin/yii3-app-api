<?php

declare(strict_types=1);

namespace App;

final readonly class ApplicationParameters
{
    public function __construct(
        public string $author = 'John Doe',
        public string $charset = 'UTF-8',
        public string $name = 'My Project',
        public string $version = '1.0'
    ) {}

    public function getCharset(): string
    {
        return $this->charset;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }
}
