<?php

namespace Yjtec\Upload\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yjtec\Upload\Events\UploadEvent;
use Yjtec\Upload\Requests\UploadRequest;
use Yjtec\Upload\Resources\UploadResource;
use Yjtec\Upload\Resources\UrlResource;
use \Yjtec\Upload\Models\File;

class IndexController extends Controller
{
    /**
     * @OA\Get(
     *     path="/upload/{path}",
     *     tags={"Upload"},
     *     summary="获取url接口",
     *     operationId="uploadUrl",
     *     @OA\Parameter(
     *          description="path(md5(加密的path))",
     *          in="path",
     *          name="path",
     *          required=true,
     *          @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="pet response",
     *         @OA\JsonContent(ref="#/components/schemas/UrlReturn")
     *     )
     * )
     */
    public function url(File $file,Request $request)
    {
        return new UrlResource($file);
    }
    /**
     * @OA\Post(
     *     path="/upload",
     *     tags={"Upload"},
     *     summary="上传接口",
     *     operationId="uploadUpload",
     *     @OA\Response(
     *         response=200,
     *         description="pet response",
     *         @OA\JsonContent(ref="#/components/schemas/UploadReturn")
     *     ),
     *     @OA\RequestBody(ref="#/components/requestBodies/UploadRequest"),
     * )
     */
    public function upload(UploadRequest $request)
    {

        $path            = app('upload')->getPath();
        $truePath        = $request->file('file')->store($path);
        $fm              = new File();
        $fm->file        = $request->file;
        $fm->foreign_key = $request->foreign_key;
        $fm->type        = $request->type;
        $fm->path        = $truePath;
        $fm->save();
        new UploadEvent($fm);
        return new UploadResource($fm);
    }
}
