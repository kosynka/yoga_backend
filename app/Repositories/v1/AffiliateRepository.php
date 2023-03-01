<?php

namespace App\Repositories\v1;

use App\Models\Affiliate;
use App\Repositories\Contracts\AffiliateRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class AffiliateRepository extends BaseRepository implements AffiliateRepositoryInterface
{
    public function __construct(Affiliate $model)
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
