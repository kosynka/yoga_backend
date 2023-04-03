<?php

namespace App\Services\v1;

class PaymentService
{
    protected array $config = [];

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function generate(array $data): string
    {
        return 'PaymentService::generate() has been called. ' . $data;
    }

    public function check(int $id): string
    {
        return 'PaymentService::check() has been called. ' . $id;
    }

    public function info(int $id): string
    {
        return 'PaymentService::info() has been called. ' . $id;
    }
}