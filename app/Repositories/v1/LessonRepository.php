<?php

namespace App\Repositories\v1;

use App\Models\Lesson;
use App\Repositories\Contracts\LessonRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class LessonRepository extends BaseRepository implements LessonRepositoryInterface
{
    public function __construct(Lesson $model)
    {
        parent::__construct($model);
    }

    public function all(array $attributes): ?Collection
    {
        $query = $this->model->when(isset($attributes['instructor_id']), function ($query) use ($attributes) {
            $query->where('instructor_id', $attributes['instructor_id']);
        })->get();

        return $query;
    }

    public function update(int $id, array $attributes): Model
    {
        $model = $this->find($id);

        $model->update($attributes);
        $model->save();

        return $model;
    }
}
