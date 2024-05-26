<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="Car API",
 *     version="1.0.0"
 * ),
 * @OA\Post(
 *     path="/api/get/cars",
 *     summary="Get available cars",
 *     tags={"Cars"},
 *     @OA\RequestBody(
 *         required=true,
 *         description="Request data",
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(
 *                 required={"employee_id", "start_time", "end_time"},
 *                 @OA\Property(property="employee_id", type="integer", example="1"),
 *                 @OA\Property(property="start_time", type="string", format="date-time", example="2024-05-28 09:00:00"),
 *                 @OA\Property(property="end_time", type="string", format="date-time", example="2024-05-28 17:00:00"),
 *                 @OA\Property(property="model", type="string", example="ModelX"),
 *                 @OA\Property(property="category", type="string", example="Luxury")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful response",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", description="Car ID"),
 *                 @OA\Property(property="name", type="string", description="Car name"),
 *                 @OA\Property(property="model", type="string", description="Car model"),
 *                 @OA\Property(property="category", type="string", description="Car category")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Bad request"
 *     )
 * )
 */

class CarController extends Controller
{
    //
}
