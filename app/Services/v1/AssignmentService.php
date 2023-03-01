<?php

namespace App\Services\v1;

use App\Http\Resources\AssignmentResource;
use App\Repositories\Contracts\AssignmentRepositoryInterface;
use App\Services\BaseService;
use App\Services\Contracts\AssignmentServiceInterface;

class AssignmentService extends BaseService implements AssignmentServiceInterface
{
    private AssignmentRepositoryInterface $repository;

    public function __construct(AssignmentRepositoryInterface $repository)
    {
        parent::__construct();

        $this->repository = $repository;
    }

    public function index(array $data)
    {
        if ($this->user->isUser()) {
            $data['user_id'] = $this->user->id;
        }

        $assignments = $this->repository->all($data);

        return $this->result([
            'assignment' => AssignmentResource::collection($assignments),
        ]);
    }

    public function store(array $data)
    {
        $data['user_id'] = $this->user->id;

        $assignment = $this->repository->store($data);

        return $this->result([
            'assignment' => (new AssignmentResource($assignment)),
        ]);
    }

	public function show(int $id)
    {
        $assignment = $this->repository->find($id);

        return $this->result([
            'assignment' => (new AssignmentResource($assignment)),
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
            'assignment' => (new AssignmentResource($assignment)),
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
}