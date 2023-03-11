<?php

namespace App\Services\v1;

use App\Http\Resources\AssignmentResource;
use App\Repositories\Contracts\AssignmentRepositoryInterface;
use App\Repositories\Contracts\LessonRepositoryInterface;
use App\Services\BaseService;
use App\Services\Contracts\AssignmentServiceInterface;

class AssignmentService extends BaseService implements AssignmentServiceInterface
{
    private AssignmentRepositoryInterface $repository;
    private LessonRepositoryInterface $lessonRepository;

    public function __construct(
        AssignmentRepositoryInterface $repository,
        LessonRepositoryInterface $lessonRepository,
        )
    {
        $this->user = auth('api-user')->user();
        parent::__construct();

        $this->repository = $repository;
        $this->lessonRepository = $lessonRepository;
    }

    public function index(array $data)
    {
        if (isset($this->user) && $this->user->isUser()) {
            $data['user_id'] = $this->user->id;
        }

        $assignments = $this->repository->all($data);

        return $this->result([
            'assignment' => AssignmentResource::collection($assignments->load('lesson')),
        ]);
    }

    public function store(array $data)
    {
        $data['user_id'] = $this->user->id;

        if (!$this->isParticipantsLimitEndedUp($data['lesson_id'])) {
            return $this->ok('Свободных мест не осталось');
        }

        $assignment = $this->repository->store($data);

        return $this->result([
            'assignment' => (new AssignmentResource($assignment->load('lesson'))),
        ]);
    }

	public function show(int $id)
    {
        $assignment = $this->repository->find($id);

        return $this->result([
            'assignment' => (new AssignmentResource($assignment->load('lesson'))),
        ]);
    }

    public function update(int $id, array $data)
    {
        $assignment = $this->repository->find($id);

        if ($this->user->id === $assignment->user_id) {
            $assignment = $this->repository->update($id, $data);
        } else {
            return $this->errFobidden('Вы не можете изменить эту запись');
        }

        return $this->result([
            'assignment' => (new AssignmentResource($assignment->load('lesson'))),
        ]);
    }

	public function destroy(int $id)
    {
        $assignment = $this->repository->find($id);

        if ($this->user->id === $assignment->id) {
            $this->repository->destroy($id);

            return $this->ok('Ваша запись удалена');
        } else {
            return $this->errFobidden('Вы не можете удалить эту запись');
        }
    }

    private function isParticipantsLimitEndedUp(int $lessonId): bool
    {
        return $this->lessonRepository->isParticipantsLimitEndedUp($lessonId);
    }
}