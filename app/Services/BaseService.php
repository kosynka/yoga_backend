<?php


namespace App\Services;

use Illuminate\Support\Facades\Log;

class BaseService
{
    protected $user;

    protected function defineUser()
    {
        $user = auth()->user();

        if (!isset($user)) {
            return $this->errFobidden(403, 'Требуется авторизация');
        }
        else {
            $this->user = $user;
        }
    }

    protected function errValidate($message): array
    {
        return $this->error(422, $message);
    }

    protected function errFobidden($message): array
    {
        return $this->error(403, $message);
    }
    protected function errNotFound($message): array
    {
        return $this->error(404, $message);
    }

    protected function errService($message): array
    {
        return $this->error(500, $message);
    }
    protected function errNotAcceptable($message): array
    {
        return $this->error(406, $message);
    }

    protected function ok($message = 'OK'): array
    {
        return $this->result(['message' => $message]);
    }

    protected function result(array $data): array
    {
        Log::info(__METHOD__ . ' ' . $this->getInfoContext($data));

        $returningData = ['success' => true] + $data;

        return [
            'data' => $returningData,
            'httpCode' => 200
        ];
    }

    protected function error(int $code, string $message): array
    {
        Log::info(__METHOD__ . ' ' . $message);

        return [
            'data' => [
                'message' => $message,
                'success' => false,
            ],
            'httpCode' => $code
        ];
    }

    protected function response(int $code, array $data): array
    {
        Log::info(__METHOD__ . ' code:' . $code, $data);

        return [
            'data' => $data,
            'httpCode' => $code
        ];
    }

    protected function isSuccess(array $result): bool
    {
        return (!empty($result['httpCode']) && $result['httpCode'] === 200);
    }

    private function getInfoContext($data)
    {
        $info = '';

        if (!empty($data['message'])) {
            $info = $data['message'];
        }

        return $info;
    }
}
