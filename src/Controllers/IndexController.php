<?php

namespace Yjtec\Upload\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Storage;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        echo 333;
    }
    /**
     * @OA\Post(
     *     path="/kd/upload",
     *     tags={"Upload"},
     *     summary="上传接口",
     *     operationId="uploadUpload",
     *     @OA\Response(
     *         response=200,
     *         description="pet response",
     *         @OA\JsonContent(ref="#/components/schemas/Error")
     *     ),
     *     @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *               @OA\Property(
     *                   property="file",
     *                   description="上传文件字段名",
     *                   type="file"
     *               ),
     *               @OA\Property(
     *                   property="path",
     *                   description="文件存储的路径",
     *                   type="string"
     *               ),
     *               @OA\Property(
     *                   property="foreign_key",
     *                   description="文件的唯一建值",
     *                   type="string"
     *               ),
     *           )
     *
     *       )
     *   ),
     *     security={
     *         {"token": {}}
     *     }
     * )
     */
    public function upload(Request $request)
    {

        $filepath    = $request->input('path');
        $foreign_key = $request->input('foreign_key');
        $path    = $request->file('file')->store($filepath);
        $url         = Storage::url($path);
        $inser = [
            'filename'    => $request->file->getClientOriginalName(),
            'mimetype'    => $request->file->getClientMimeType(),
            'filesize'    => $request->file->getClientSize(),
            'extension'   => $request->file->guessClientExtension(),
            'path'        => $filepath,
            'url'         => $url,
            'foreign_key' => $foreign_key,
        ];

        $file = \Yjtec\Upload\Models\File::create($inser);
        return [
            'url'     => $url,
            'path'    => $path,
            'file_id' => $file->id
        ];
    }
}
