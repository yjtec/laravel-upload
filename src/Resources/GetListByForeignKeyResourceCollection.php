<?php

namespace Yjtec\Upload\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Yjtec\Upload\Resources\GetListByForeignKeyResource;

/**
 * @OA\Schema(
 *      schema="uploadGetListByForeignKeyResponse",
 *      type="object",
 *      allOf={
 *          @OA\Schema(ref="#/components/schemas/Success"),
 *          @OA\Schema(
 *              @OA\Property(
 *                  property="data",type="array",
 *                  @OA\Items(ref="#/components/schemas/uploadGetListByForeignKeyObject")
 *             ),
 *         )
 *      }
 *  )
 */
class GetListByForeignKeyResourceCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return GetListByForeignKeyResource::collection($this);
    }
    public function with($request)
    {
        return [
            'errcode' => 0,
            'errmsg' => '成功',
        ];
    }
}
