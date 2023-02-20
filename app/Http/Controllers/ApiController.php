<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="Yoga API documentation",
 *     version="0.1",
 *      @OA\Contact(
 *          url="http://t.me/kosynka"
 *      ),
 * ),
 *  @OA\Server(
 *      description="Local API Server",
 *      url="https://127.0.0.1:8000/"
 *  ),
 */
class ApiController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function result($data)
    {
        return response()->json($data['data'])->setStatusCode($data['httpCode']);
    }

    public function appLanguage()
    {
        $lang = request()->header('Accept-Language') ?? 'ru';
        if (!in_array($lang, ['ru', 'kk', 'en'])) {
            $lang = 'ru';
        }
        return $lang;
    }
}
