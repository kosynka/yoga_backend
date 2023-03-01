<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Lesson\CreateLessonRequest;
use App\Http\Requests\Lesson\IndexLessonRequest;
use App\Http\Requests\Lesson\UpdateLessonRequest;
use App\Services\Contracts\LessonServiceInterface;

class LessonController extends ApiController
{
    private LessonServiceInterface $service;

    public function __construct(LessonServiceInterface $service)
    {
        $this->service = $service;
    }

    public function index(IndexLessonRequest $request)
    {
        $data = $request->validated();

        return $this->result($this->service->index($data));
    }

    public function store(CreateLessonRequest $request)
    {
        $data = $request->validated();

        return $this->result($this->service->store($data));
    }

    public function show(int $id)
    {
        return $this->result($this->service->show($id));
    }

    public function update(UpdateLessonRequest $request, int $id)
    {
        $data = $request->validated();

        return $this->result($this->service->update($id, $data));
    }

    public function destroy(int $id)
    {
        return $this->result($this->service->destroy($id));
    }
}
