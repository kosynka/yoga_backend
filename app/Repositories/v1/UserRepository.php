<?php

namespace App\Repositories\v1;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function all(array $attributes): ?Collection
    {
        $query = $this->model->when(isset($attributes['instructor_id']), function ($query) use ($attributes) {
            $query->where('role', '!=', User::ROLE_ADMIN);
        });

        $query = $query->where('role', '!=', User::ROLE_ADMIN);

        return $query->get();
    }

    public function findByPhone(string $phone): ?Model
    {
        return $this->model->where('phone', $phone)->first();
    }

    public function store(array $attributes): Model
    {
        $attributes['role'] = User::ROLE_USER;

        return $this->model->create($attributes);
    }

    public function update($model, array $attributes): Model
    {
        $model->update($attributes);
        $model->save();

        return $model;
    }

    public function destroy($model): void
    {
        $model->delete();
    }
}
