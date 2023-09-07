<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
/**
 * @OA\Swagger(
 *      schemes={"http"},
 *      host="trident-course",
 *      basePath="/api",
 *      @OA\Info(
 *          title="Course System API",
 *          version="1.0.0"
 *      ),
 *      @OA\Server(
 *          description="Swagger-doc Course System API",
 *          url="http://127.0.0.1:8000"
 *      )
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
