<?php
namespace Yjtec\Upload\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\RequestBody(
 *     request="UploadsRequest",
 *     description="上传文件",
 *     required=true,
 *     @OA\MediaType(
 *         mediaType="multipart/form-data",
 *         @OA\Schema(
 *             type="object",
 *             @OA\Property(
 *                property="type",
 *                type="array",
 *                @OA\Items(ref="#/components/schemas/UploadTypes")
 *             ),
 *             @OA\Property(
 *                  property="file[]",
 *                  description="上传文件字段名",
 *                  type="file"
 *             ),
 *         )
 *     )
 * )
 */
class UploadsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'type' => [
                'required',
                app('upload.rule')->getTypes(),
            ],
            'file.*' => app('upload.rule')->getRule($this->type),
        ];
    }

    public function attributes()
    {
        return [
            'type' => '类型',
            'file.*' => '文件',
        ];
    }
}
