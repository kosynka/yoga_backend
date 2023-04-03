<?php

namespace App\Services\v1;

use App\Facades\Sms;
use App\Jobs\SmsSendJob;
use App\Http\Resources\UserResource;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Contracts\AuthServiceInterface;
use App\Services\BaseService;

class AuthService extends BaseService implements AuthServiceInterface
{
    private UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function login(array $data)
    {
        $user = $this->repository->findByPhone($data['phone']);

        if (! isset($user)) {               // if user not found
            if (isset($data['role'])) {     // and if user role is not set (as INSTRUCTOR)
                return $this->errForbidden('Тренера с таким номером не существует');
            } else {
                $this->storeNewUser($data);
            }
        }

        SmsSendJob::dispatch($data['phone']);

        return $this->ok('На ваш телефон отправлен код авторизации');
    }

    public function register(array $data)
    {
        $user = $this->repository->findByPhone($data['phone']);

        if (isset($user)) {
			return $this->error(401, 'Данный номер телефона уже занят');
        }

        $this->repository->store($data);

        SmsSendJob::dispatch($data['phone']);

        return $this->ok('На ваш телефон отправлен код верификации');
    }

    public function sendverify(string $phone)
    {
        $user = $this->repository->findByPhone($phone);

        if (!isset($user)) {
			return $this->errForbidden('Пользователя с таким номером телефона не существует');
        }

		SmsSendJob::dispatch($phone);

        return $this->ok('На ваш телефон отправлен код верификации');
	}

    public function verify(array $data)
    {
        $user = $this->repository->findByPhone($data['phone']);

		if (!isset($user)) {
			return $this->errForbidden('Пользователя с таким номером телефона не существует');
        }

		if (!Sms::check($data['phone'], $data['code'])) {
			return $this->errNotFound('Неверный код');
		}

        $token = $user->createToken($user->phone, ['user'])->plainTextToken;

        return $this->result([
            'token' => $token,
            'user' => (new UserResource($user)),
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return $this->ok();
    }

    private function storeNewUser(array $data): void
    {
        $data = array(
            'phone' => $data['phone'],
            'role' => 'USER',
            'name' => 'user' . uniqid(),
        );

        $this->repository->store($data);
    }
}