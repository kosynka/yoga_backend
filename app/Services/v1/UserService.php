<?php

namespace App\Services\v1;

use App\Http\Resources\UserResource;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\BaseService;
use App\Services\Contracts\FileServiceInterface;
use App\Services\Contracts\UserServiceInterface;

class UserService extends BaseService implements UserServiceInterface
{
    private UserRepositoryInterface $repository;
    private FileServiceInterface $fileService;

    public function __construct(
        UserRepositoryInterface $repository,
        FileServiceInterface $fileService,
        )
    {
        parent::__construct();

        $this->repository = $repository;
        $this->fileService = $fileService;
    }

    public function index(array $data)
    {
        $users = $this->repository->all($data);

        return $this->result([
            'user' => UserResource::collection($users),
        ]);
    }

	public function show(int $id)
    {
        $user = $this->repository->find($id);

        return $this->result([
            'user' => (new UserResource($user)),
        ]);
    }

	public function update(array $data)
    {
        if (isset($data['photo'])) {
            $data['photo_id'] = $this->fileService->store($data['photo'])->id;
        }

        $this->repository->update($this->user, $data);

        return $this->result([
            'user' => (new UserResource($this->user)),
        ]);
    }

	public function destroy()
    {
        $this->repository->destroy($this->user);

        return $this->ok('Ваш аккаунт удален');
    }
}