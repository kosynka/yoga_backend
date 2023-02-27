<?php

namespace App\Repositories;

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
        return $this->model->find($id);
    }

    public function store(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    // public function update(int $id, array $attributes): Model
    // {
    //     $field = $this->model->find($id);

    //     return $field->update($attributes);
    // }

    public function delete(int $id): void
    {
        $field = $this->model->find($id);

        $field->delete();
    }
}
