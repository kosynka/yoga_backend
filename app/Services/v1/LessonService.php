<?php

namespace App\Services\v1;

use App\Http\Resources\LessonResource;
use App\Repositories\Contracts\LessonRepositoryInterface;
use App\Services\BaseService;
use App\Services\Contracts\LessonServiceInterface;

class LessonService extends BaseService implements LessonServiceInterface
{
    private LessonRepositoryInterface $repository;

    public function __construct(LessonRepositoryInterface $repository)
    {
        parent::__construct();

        $this->repository = $repository;
    }

    public function index(array $data)
    {
        if ($this->user->isInstructor()) {
            $data['instructor_id'] = $this->user->id;
        }

        $lessons = $this->repository->all($data);

        return $this->result([
            'lesson' => LessonResource::collection($lessons),
        ]);
    }

    public function store(array $data)
    {
        $data['instructor_id'] = $this->user->id;

        $lesson = $this->repository->store($data);

        return $this->result([
            'lesson' => (new LessonResource($lesson)),
        ]);
    }

	public function show(int $id)
    {
        $lesson = $this->repository->find($id);

        return $this->result([
            'lesson' => (new LessonResource($lesson)),
        ]);
    }

    public function update(int $id, array $data)
    {
        $lesson = $this->repository->find($id);

        if ($this->user->id === $lesson->instructor_id) {
            $lesson = $this->repository->update($id, $data);
        } else {
            return $this->errFobidden('Вы не можете изменить этот урок');
        }


        return $this->result([
            'lesson' => (new LessonResource($lesson)),
        ]);
    }

	public function destroy(int $id)
    {
        $lesson = $this->repository->find($id);

        if ($this->user->id === $lesson->instructor_id) {
            $this->repository->destroy($id);

            return $this->ok('Ваш урок удален');
        } else {
            return $this->errFobidden('Вы не можете удалить этот урок');
        }
    }
}