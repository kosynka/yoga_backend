<?php

namespace App\Services\v1;

use App\Http\Resources\AffiliateResource;
use App\Repositories\Contracts\AffiliateRepositoryInterface;
use App\Services\BaseService;
use App\Services\Contracts\AffiliateServiceInterface;

class AffiliateService extends BaseService implements AffiliateServiceInterface
{
    private AffiliateRepositoryInterface $repository;

    public function __construct(AffiliateRepositoryInterface $repository)
    {
        parent::__construct();

        $this->repository = $repository;
    }

    public function index(array $data)
    {
        $affiliates = $this->repository->all($data);

        return $this->result([
            'affiliate' => AffiliateResource::collection($affiliates),
        ]);
    }

	public function show(int $id)
    {
        $affiliate = $this->repository->find($id);

        return $this->result([
            'affiliate' => (new AffiliateResource($affiliate)),
        ]);
    }
}