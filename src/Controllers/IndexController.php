<?php

namespace Yjtec\Upload\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yjtec\Upload\Events\UploadEvent;
use Yjtec\Upload\Requests\GetListByForeignKeyRequest;
use Yjtec\Upload\Requests\UploadRequest;
use Yjtec\Upload\Requests\UploadsRequest;
use Yjtec\Upload\Resources\GetListByForeignKeyResourceCollection;
use Yjtec\Upload\Resources\UploadResource;
use Yjtec\Upload\Resources\UploadResourceCollection;
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
    
    /**
     * @OA\Post(
     *     path="/uploads",
     *     tags={"Upload"},
     *     summary="批量上传接口",
     *     operationId="uploadUploads",
     *     @OA\Response(
     *         response=200,
     *         description="pet response",
     *         @OA\JsonContent(ref="#/components/schemas/UploadsReturn")
     *     ),
     *     @OA\RequestBody(ref="#/components/requestBodies/UploadsRequest"),
     * )
     */
    public function uploads(UploadsRequest $request)
    {
        $type = $request->type;
        $foreignKey = (int) $request->foreign_key;
        $path = app('upload')->getPath();
        $files = $request->file('file');
        $return = array();
        foreach ($files as $v) {
            $tempFile = $v->store($path);
            $fm = new File();
            $fm->file = $v;
            $fm->foreign_key = $foreignKey;
            $fm->type = $type;
            $fm->path = $tempFile;
            $fm->save();
            new UploadEvent($fm);
            $return[] = $fm;
        }
        return new UploadResourceCollection(collect($return));
    }

    /**
     * @OA\Get(
     *     path="/upload/getlists/foreignkey",
     *     tags={"Upload"},
     *     summary="根据类型和外键获取图片列表",
     *     description="",
     *     operationId="uploadGetListByForeignKey",
     *     @OA\Parameter(ref="#/components/parameters/uploadGetListByForeignKeyParameter_type"),
     *     @OA\Parameter(ref="#/components/parameters/uploadGetListByForeignKeyParameter_foreign_key"),
     *     @OA\Response(
     *         response="200",
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/uploadGetListByForeignKeyResponse")
     *     )
     * )
     */
    public function getListByForeignKey(GetListByForeignKeyRequest $request)
    {
        $type = $request->get('type', '');
        $foreignKey = (int) $request->get('foreign_key', 0);
        $listRs = File::where([
            'type' => $type,
            'foreign_key' => $foreignKey,
        ])->orderBy('id', 'asc')->get();
        return new GetListByForeignKeyResourceCollection($listRs);
    }
}
