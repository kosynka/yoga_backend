<?php

namespace App\Services\v1;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsService
{
    private array $config = [];

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function send(string $phone): void
    {
        $code = rand(100000, 999999);

        $this->insertRecord($phone, $code);
        $data = $this->prepareData($phone, $code);

        $response = Http::get(
            $this->config['url'],
            $data
        );

        Log::info(__METHOD__ . '. Верификация phone:' . $this->preparedPhone($phone) . '; код:' . $code . ' ответ:' . $response->body());
    }

    public function check(string $phone, string $code)
    {
        $token = DB::table('verify_phone_token')
            ->where([
                ['phone', $phone],
                ['code', $code],
            ])->first();

        if (is_null($token)) {
            return false;
        }

        DB::table('verify_phone_token')
            ->where([
                ['phone', $phone],
                ['code', $code],
            ])->delete();

        return true;
    }

    private function insertRecord(string $phone, int $code): void
    {
        DB::table('verify_phone_token')->updateOrInsert([
            'phone' => $phone,
            'code' => $code,
        ]);
    }

    private function preparedPhone(string $phone): string
    {
        return '7' . str_replace(' ', '', $phone);
    }

    private function prepareData(string $phone, int $code): array
    {
        return array(
            'login' => $this->config['login'],
            'password' => $this->config['password'],
            'id' => time(),
            'type' => 'message',
            'recipient' => $this->preparedPhone($phone),
            'sender' => 'MESSAGE',
            'text' => 'Ваш код: ' . $code,
        );
    }
}