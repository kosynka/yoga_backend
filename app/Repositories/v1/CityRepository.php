<?php

namespace App\Repositories\v1;

use App\Models\City;
use App\Repositories\Contracts\CityRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

class CityRepository extends BaseRepository implements CityRepositoryInterface
{
    public function __construct(City $model)
    {
        parent::__construct($model);
    }

    public function cities(): ?Collection
    {
        return $this->model->all();
    }
}
