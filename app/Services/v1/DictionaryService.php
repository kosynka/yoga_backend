<?php

namespace App\Services\v1;

use App\Http\Resources\CityResource;
use App\Repositories\Contracts\CityRepositoryInterface;
use App\Services\BaseService;
use App\Services\Contracts\DictionaryServiceInterface;

class DictionaryService extends BaseService implements DictionaryServiceInterface
{
    private CityRepositoryInterface $cityRepository;

    public function __construct(CityRepositoryInterface $cityRepository)
    {
        parent::__construct();

        $this->cityRepository = $cityRepository;
    }

    public function cities()
    {
        $cities = $this->cityRepository->cities();

        return $this->result([
            'city' => CityResource::collection($cities),
        ]);
    }
}