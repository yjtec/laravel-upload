<?php

namespace Yjtec\Upload\Resources;

use Illuminate\Http\Resources\Json\Resource;

/**
 * @OA\Schema(
 *      schema="UrlReturn",
 *      type="object",
 *      allOf={
 *          @OA\Schema(ref="#/components/schemas/Success"),
 *          @OA\Schema(
 *              @OA\Property(
 *                  property="data",type="object",
 *                  ref="#/components/schemas/UrlResource"
 *             ),
 *         )
 *      }
 *  )
 */
/**
 * @OA\Schema(
 *      schema="UrlResource",
 *      @OA\Property(property="type",type="string",description="上传类型"),
 *      @OA\Property(property="url",type="string",description="全路径")
 *  )
 */
class UrlResource extends Resource
{
    public function toArray($request)
    {
        //dd($this);
        return [
            'url' => $this->url,
            'type' => $this->type
        ];
    }
}
