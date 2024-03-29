<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Affiliate\IndexAffiliateRequest;
use App\Http\Requests\FilterDateRequest;
use App\Services\Contracts\AffiliateServiceInterface;

class AffiliateController extends ApiController
{
    private AffiliateServiceInterface $service;

    public function __construct(AffiliateServiceInterface $service)
    {
        $this->service = $service;
    }

    public function index(IndexAffiliateRequest $request)
    {
        $data = $request->validated();

        return $this->result($this->service->index($data));
    }

    public function show(FilterDateRequest $request, int $id)
    {
        $data = $request->validated();

        return $this->result($this->service->show($data, $id));
    }

    public function like(int $id)
    {
        return $this->result($this->service->like($id));
    }

    public function showFavorite()
    {
        return $this->result($this->service->showFavorite());
    }
}
