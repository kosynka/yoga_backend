<?php

namespace App\Repositories\v1;

use App\Models\Type;
use App\Repositories\Contracts\TypeRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class TypeRepository extends BaseRepository implements TypeRepositoryInterface
{
    public function __construct(Type $model)
    {
        parent::__construct($model);
    }

    public function all(): ?Collection
    {
        return $this->model->all();
    }

    public function find(int $id): ?Model
    {
        return $this->model->find($id);
    }
}
