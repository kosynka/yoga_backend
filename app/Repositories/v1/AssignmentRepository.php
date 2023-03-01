<?php

namespace App\Repositories\v1;

use App\Models\Assignment;
use App\Repositories\Contracts\AssignmentRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class AssignmentRepository extends BaseRepository implements AssignmentRepositoryInterface
{
    public function __construct(Assignment $model)
    {
        parent::__construct($model);
    }

    public function all(array $attributes): ?Collection
    {
        $query = $this->model->when(isset($attributes['user_id']), function ($query) use ($attributes) {
            $query->where('user_id', $attributes['user_id']);
        })->get();

        return $query;
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
