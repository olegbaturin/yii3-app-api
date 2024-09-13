<?php

declare(strict_types=1);

namespace App\Response;

final readonly class ApiResponseData
{
    public int $now;
    public int $code;
    public int $reason;
    public array $errors;
    public string $message;
    public mixed $data;
    public object|array $pagination;

    public function __construct()
    {
        $this->now = time();
    }

    public function setStatus(int $v): self
    {
        $this->code = $v;
        return $this;
    }

    public function setReason(int $v): self
    {
        $this->reason = $v;
        return $this;
    }

    public function setMessage(string $v): self
    {
        $this->message = $v;
        return $this;
    }

    public function setErrors(array $v): self
    {
        $this->errors = $v;
        return $this;
    }

    public function setData(mixed $v): self
    {
        $this->data = $v;
        return $this;
    }

    public function setPagination(object|array $v): self
    {
        $this->pagination = $v;
        return $this;
    }
}
