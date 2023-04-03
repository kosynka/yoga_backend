<?php

namespace App\Repositories\v1;

use App\Models\Package;
use App\Repositories\Contracts\PackageRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

class PackageRepository extends BaseRepository implements PackageRepositoryInterface
{
    public function __construct(Package $model)
    {
        parent::__construct($model);
    }

    public function all(): ?Collection
    {
        return $this->model->all();
    }
}
