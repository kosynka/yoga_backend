<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="UserController",
 *     description="UserController APIs",
 *     @OA\Xml(
 *         name="UserController"
 *     )
 * )
 */
class UserController extends Controller
{
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
     *     @OA\Response(response="200", description="Список верифицированных пользователей")
     * )
     */
    public function index()
    {
        //
    }

    /**
     * @OA\Post(
     *     path="/api/v1/user/register",
     *     @OA\Response(response="200", description="Создать нового пользователя")
     * )
     */
    public function create()
    {
        //
    }

    /**
     * @OA\Get(
     *     path="/api/v1/user/{id}",
     *     @OA\Response(response="200", description="Показать пользователя по id")
     * )
     */
    public function show(int $id)
    {
        //
    }

    /**
     * @OA\Put(
     *     path="/api/v1/user/{id}",
     *     @OA\Response(response="200", description="Изменить данные пользователя по id")
     * )
     */
    public function update(int $id, Request $request)
    {
        //
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/user/{id}",
     *     @OA\Response(response="200", description="Удалить пользователя по id")
     * )
     */
    public function delete(int $id)
    {
        //
    }
}
