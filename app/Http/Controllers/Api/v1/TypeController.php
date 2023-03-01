<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Type\IndexTypeRequest;
use App\Services\Contracts\TypeServiceInterface;

class TypeController extends ApiController
{
    private TypeServiceInterface $service;

    public function __construct(TypeServiceInterface $service)
    {
        $this->service = $service;
    }

    public function index(IndexTypeRequest $request)
    {
        $data = $request->validated();

        return $this->result($this->service->index($data));
    }

    public function show(int $id)
    {
        return $this->result($this->service->show($id));
    }
}
