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
}
