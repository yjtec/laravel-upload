<?php

namespace Yjtec\Upload\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Yjtec\Upload\Resources\UploadResource;

/**
 * @OA\Schema(
 *      schema="UploadsReturn",
 *      type="object",
 *      allOf={
 *          @OA\Schema(ref="#/components/schemas/Success"),
 *          @OA\Schema(
 *              @OA\Property(
 *                  property="data",type="array",
 *                  @OA\Items(ref="#/components/schemas/UploadResource")
 *             ),
 *         )
 *      }
 *  )
 */
class UploadResourceCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return UploadResource::collection($this);
    }
    public function with($request)
    {
        return [
            'errcode' => 0,
            'errmsg' => '成功',
        ];
    }
}
