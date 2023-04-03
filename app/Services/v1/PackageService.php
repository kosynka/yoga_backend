<?php

namespace App\Services\v1;

use App\Http\Resources\PackageResource;
use App\Repositories\Contracts\PackageRepositoryInterface;
use App\Services\BaseService;
use App\Services\Contracts\PackageServiceInterface;

class PackageService extends BaseService implements PackageServiceInterface
{
    private PackageRepositoryInterface $repository;

    public function __construct(PackageRepositoryInterface $repository)
    {
        parent::__construct();

        $this->repository = $repository;
    }

    public function index()
    {
        $packages = $this->repository->all();

        return $this->result([
            'package' => PackageResource::collection($packages),
        ]);
    }
}