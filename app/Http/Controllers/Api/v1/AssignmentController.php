<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Assignment\CreateAssignmentRequest;
use App\Http\Requests\Assignment\IndexAssignmentRequest;
use App\Http\Requests\Assignment\UpdateAssignmentRequest;
use App\Services\Contracts\AssignmentServiceInterface;

class AssignmentController extends ApiController
{
    private AssignmentServiceInterface $service;

    public function __construct(AssignmentServiceInterface $service)
    {
        $this->service = $service;
    }

    public function index(IndexAssignmentRequest $request)
    {
        $data = $request->validated();

        return $this->result($this->service->index($data));
    }

    public function store(CreateAssignmentRequest $request)
    {
        $data = $request->validated();

        return $this->result($this->service->store($data));
    }

    public function show(int $id)
    {
        return $this->result($this->service->show($id));
    }

    public function update(UpdateAssignmentRequest $request, int $id)
    {
        $data = $request->validated();

        return $this->result($this->service->update($id, $data));
    }

    public function destroy(int $id)
    {
        return $this->result($this->service->destroy($id));
    }
}
