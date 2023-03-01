<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\ApiController;

class LessonController extends ApiController
{
    private UserServiceInterface $service;

    public function __construct(UserServiceInterface $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $data = $request->validated();

        return $this->result($this->service->index($data));
    }

    public function store(Request $request)
    {
        $data = $request->validated();

        return $this->result($this->service->store($data));
    }

    public function show(int $id)
    {
        return $this->result($this->service->show($id));
    }

    public function update(Request $request, int $id)
    {
        $data = $request->validated();

        return $this->result($this->service->update($data));
    }

    public function destroy(int $id)
    {
        return $this->result($this->service->destroy($id));
    }
}
