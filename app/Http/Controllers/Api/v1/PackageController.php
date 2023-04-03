<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\ApiController;
use App\Services\Contracts\PackageServiceInterface;

class PackageController extends ApiController
{
    private PackageServiceInterface $service;

    public function __construct(PackageServiceInterface $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->result($this->service->index());
    }
}
