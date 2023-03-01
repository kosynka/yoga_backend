<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function find(int $id): ?Model
    {
        return $this->model->findOrFail($id);
    }

    public function store(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    public function update(int $id, array $attributes): Model
    {
        $model = $this->find($id);

        $model->update($attributes);
        $model->save();

        return $model;
    }

    public function destroy(int $id): void
    {
        $model = $this->find($id);

        $model->delete();
    }
}
