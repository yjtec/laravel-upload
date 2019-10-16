<?php

namespace Yjtec\Upload\Resources;

use Illuminate\Http\Resources\Json\Resource;

/**
 * @OA\Schema(
 *      schema="uploadGetListByForeignKeyObject",
 *      @OA\Property(property="id",type="integer",format="int32",description="文件ID"),
 *      @OA\Property(property="key",type="string",description="文件路径MD5值"),
 *      @OA\Property(property="filename",type="string",description="文件名称"),
 *      @OA\Property(property="path",type="string",description="相对路径"),
 *      @OA\Property(property="url",type="string",description="全路径")
 *  )
 */
class GetListByForeignKeyResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'key' => $this->key,
            'filename' => $this->filename,
            'path' => $this->path,
            'url' => $this->url,
        ];
    }
}
