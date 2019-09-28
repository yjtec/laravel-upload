<?php

namespace Yjtec\Upload\Resources;

use Illuminate\Http\Resources\Json\Resource;

/**
 * @OA\Schema(
 *      schema="UploadReturn",
 *      type="object",
 *      allOf={
 *          @OA\Schema(ref="#/components/schemas/Success"),
 *          @OA\Schema(
 *              @OA\Property(
 *                  property="data",type="object",
 *                  ref="#/components/schemas/UploadResource"
 *             ),
 *         )
 *      }
 *  )
 */
/**
 * @OA\Schema(
 *      schema="UploadResource",
 *      @OA\Property(property="file_id",type="integer",format="int32",description="文件ID"),
 *      @OA\Property(property="url",type="string",description="全路径"),
 *      @OA\Property(property="path",type="string",description="相对路径")
 *  )
 */
class UploadResource extends Resource
{
    public function toArray($request)
    {
        //dd($this);
        return [
            'path'               => $this->path,
            'url'            => $this->url,
            'file_id' => $this->id,
        ];
    }
    public function with($request)
    {
        return [
            'errcode' => 0,
            'errmsg'  => '成功',
        ];
    }
}
