<?php

namespace App\Services\v1;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SmsService
{
    private array $config = [];

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function send(string $phone, array $data): void
    {
        $code = rand(100000, 999999);

        $this->insertRecord($phone, $code);
        $data = $this->prepareData($phone, $code);
        $options = $this->generateOptions($data);
        $context  = stream_context_create($options);
        $result = file_get_contents($this->config['url'], false, $context);

        Log::info(__METHOD__ . '. Верификация phone:' . $this->preparedId($phone) . '; код:' . $code . ' result:' . $result);
    }

    private function preparedPhone(string $phone): string
    {
        return '+7' . str_replace(' ', '', $phone);
    }

    private function preparedId(string $phone): string
    {
        return str_replace(' ', '', $phone);
    }

    private function insertRecord(string $phone, int $code): void
    {
        DB::table('verify_sign_token')->insert([
            'phone' => $phone,
            'token' => $code,
        ]);
    }

    private function prepareData(string $phone, int $code): array
    {
        return array(
            'login' => $this->config['login'],
            'psw' => $this->config['password'],
            'phones' => $this->preparedPhone($phone),
            'mes' => 'Ваш код для подтверждения: ' . $code,
            'id' => $this->preparedId($phone),
        );
    }

    private function generateOptions(array $data): array
    {
        return array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
    }
}