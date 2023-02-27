<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\ApiController;
use App\Http\Requests\User\IndexUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\UpdateUserTokenRequest;
use App\Services\Contracts\UserServiceInterface;

/**
 * @OA\Schema(
 *     title="UserController",
 *     description="Авторизация требуется",
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
     *     tags={"users"},
     *     summary="Index user",
     *     operationId="createUser",
     *     @OA\RequestBody(
     *         required=false,
     *         description="Index of user objects",
     *         @OA\MediaType(
     *             mediaType="params",
     *             @OA\Schema(ref="#")
     *         )
     *     ),
     *     path="/api/v1/users",
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
     *     tags={"users"},
     *     summary="Show user",
     *     operationId="showUser",
     *     path="/api/v1/users/{id}",
     *     @OA\Response(response="200", description="Показать пользователя по id")
     * )
     */
    public function show(int $id)
    {
        return $this->result($this->service->show($id));
    }

    /**
     * @OA\Post(
     *     tags={"users"},
     *     summary="Update user",
     *     operationId="updateUser",
     *     path="/api/v1/users",
     *     @OA\Response(response="200", description="Изменить данные авторизованного пользователя")
     * )
     */
    public function update(UpdateUserRequest $request)
    {
        $data = $request->validated();

        return $this->result($this->service->update($data));
    }

    /**
     * @OA\Put(
     *     tags={"users"},
     *     summary="Update user fb token",
     *     operationId="updateUserFbToken",
     *     path="/api/v1/users",
     *     @OA\Response(response="200", description="Изменить firebase token авторизованного пользователя")
     * )
     */
    public function updateToken(UpdateUserTokenRequest $request)
    {
        $data = $request->validated();

        return $this->result($this->service->update($data));
    }

    /**
     * @OA\Delete(
     *     tags={"users"},
     *     summary="Delete user",
     *     operationId="deleteUser",
     *     path="/api/v1/users",
     *     @OA\Response(response="200", description="Удалить авторизованного пользователя")
     * )
     */
    public function delete()
    {
        return $this->result($this->service->delete());
    }
}
