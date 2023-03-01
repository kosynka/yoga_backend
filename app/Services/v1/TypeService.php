<?php

namespace App\Services\v1;

use App\Http\Resources\TypeResource;
use App\Repositories\Contracts\TypeRepositoryInterface;
use App\Services\BaseService;
use App\Services\Contracts\TypeServiceInterface;

class TypeService extends BaseService implements TypeServiceInterface
{
    private TypeRepositoryInterface $repository;

    public function __construct(TypeRepositoryInterface $repository)
    {
        parent::__construct();

        $this->repository = $repository;
    }

    public function index(array $data)
    {
        $types = $this->repository->all($data);

        return $this->result([
            'type' => TypeResource::collection($types),
        ]);
    }

	public function show(int $id)
    {
        $type = $this->repository->find($id);

        return $this->result([
            'type' => (new TypeResource($type)),
        ]);
    }
}