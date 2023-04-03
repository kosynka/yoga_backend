<?php


namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class BaseService
{    
    protected User $user;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */     
    public function __construct()
    {
        if (auth('api-user')->user() != null) {
            $this->user = auth('api-user')->user();
        }
    }

    protected function errPaymentRequired($message): array
    {
        return $this->error(402, $message);
    }

    protected function errForbidden($message): array
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

    private function writeLog($data, array $context = []): void
    {
        Log::info(__METHOD__ . '  ' . get_class($this) . '->' . __FUNCTION__ . ' ' . $data, $context);
    }

    protected function result(array $data): array
    {
        $this->writeLog($this->getInfoContext($data));

        $returningData = ['success' => true] + $data;

        return [
            'data' => $returningData,
            'httpCode' => 200
        ];
    }

    protected function error(int $code, string $message): array
    {
        $this->writeLog($this->getInfoContext($message));

        return [
            'data' => [
                'message' => $message,
                'success' => false,
            ],
            'httpCode' => $code
        ];
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
