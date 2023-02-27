<?php

namespace App\Repositories\v1;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function findByPhone(string $phone): ?Model
    {
        return $this->model->where('phone', $phone)->first();
    }

    public function find(int $id): ?Model
    {
        return $this->model->find($id);
    }

    public function store(array $attributes): Model
    {
        $attributes['role'] = User::ROLE_USER;

        return $this->model->create($attributes);
    }

    public function update(int $id, array $attributes): Model
    {
        $field = $this->model->find($id);

        return $field->update($attributes);
    }

    public function delete(int $id): void
    {
        $field = $this->model->find($id);

        $field->delete();
    }
}
