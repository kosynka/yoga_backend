<?php

namespace App\Repositories\v1;

use App\Models\Lesson;
use App\Repositories\Contracts\LessonRepositoryInterface;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
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
        $query = $this->filter($attributes);

        $query->when(isset($attributes['instructor_id']), function ($query) use ($attributes) {
            $query->where('instructor_id', $attributes['instructor_id']);
        });

        $query->when(isset($attributes['type_id']), function ($query) use ($attributes) {
            $query->where('type_id', $attributes['type_id']);
        });

        $this->paginate($query, $attributes);
        $this->order($query, $attributes);

        return $query->get();
    }

    public function update(int $id, array $attributes): Model
    {
        $model = $this->find($id);

        $model->update($attributes);
        $model->save();

        return $model;
    }

    private function filter($attributes)
    {
        return $this->model->when(isset($attributes['filter']), function ($query) use ($attributes) {
            $query->where('comment', 'LIKE', '%' . $attributes['filter'] . '%');
        })
        ->when(isset($attributes['starts_at']), function ($query) use ($attributes) {
            $query->whereDate('starts_at', $attributes['starts_at']);
        });
        // }, function ($query) {
        //     $query->whereDate('starts_at', Carbon::today());
        // });
    }

    public function isParticipantsLimitEndedUp(int $id): bool
    {
        $model = $this->find($id);

        return $model->isParticipantsLimitEndedUp();
    }
}
