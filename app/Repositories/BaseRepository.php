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

    protected function paginate(&$query, $attributes)
    {
        $page = 1;
        $limit = 20;

        if (isset($attributes['page']) && $attributes['page'] > 0) {
            $page = (int) $attributes['page'];
        }

        if (isset($attributes['limit'])) {
            $limit = (int) $attributes['limit'];
        }

        $query->offset(($page - 1) * $limit);
        $query->limit($limit);
        
        return $query;
    }

    protected function order(&$query, $attributes)
    {
        $desc = 'desc';
        if (isset($attributes['descending']) && $attributes['descending'] == 0) {
            $desc = 'asc';
        }

        $sortBy = 'id';
        if (isset($attributes['sortBy'])) {
            $sortBy = $attributes['sortBy'];
        }

        return $query->orderBy($sortBy, $desc);
    }
}
