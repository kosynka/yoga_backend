<?php

namespace App\Services\v1;

use App\Repositories\Contracts\FileRepositoryInterface;
use App\Services\Contracts\FileServiceInterface;
use App\Services\BaseService;

class FileService extends BaseService implements FileServiceInterface
{
    private FileRepositoryInterface $repository;

    public function __construct(FileRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function store($data)
    {
        $file = $this->repository->store($data);

        return $file;
    }
}