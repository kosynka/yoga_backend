<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\ApiController;
use App\Http\Requests\User\IndexUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\Contracts\UserServiceInterface;

/**
 * @OA\Schema(
 *     title="UserController",
 *     description="UserController APIs",
 *     @OA\Xml(
 *         name="UserController"
 *     )
 * )
 */
class UserController extends ApiController
{
    private UserServiceInterface $service;

    public function __construct(UserServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *     tags={"user"},
     *     summary="Index user",
     *     description="Авторизация не требуется",
     *     operationId="createUser",
     *     @OA\RequestBody(
     *         required=false,
     *         description="Created user object",
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#")
     *         )
     *     ),
     *     path="/api/v1/user/",
     *     @OA\Response(response="200", description="Список пользователей")
     * )
     */
    public function index(IndexUserRequest $request)
    {
        $data = $request->validated();
        dd($data);

        return $this->result($this->service->index($data));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/user/{id}",
     *     @OA\Response(response="200", description="Показать пользователя по id")
     * )
     */
    public function show(int $id)
    {
        return $this->result($this->service->show($id));
    }

    /**
     * @OA\Put(
     *     path="/api/v1/user/{id}",
     *     @OA\Response(response="200", description="Изменить данные пользователя по id")
     * )
     */
    public function update(UpdateUserRequest $request)
    {
        $data = $request->validated();

        return $this->result($this->service->update($data));
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/user/{id}",
     *     @OA\Response(response="200", description="Удалить пользователя по id")
     * )
     */
    public function delete()
    {
        return $this->result($this->service->delete());
    }
}
