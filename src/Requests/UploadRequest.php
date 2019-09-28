<?php
namespace Yjtec\Upload\Requests;

use Illuminate\Foundation\Http\FormRequest;


/**
 * @OA\RequestBody(
 *     request="UploadRequest",
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
 *                  property="file",
 *                  description="上传文件字段名",
 *                  type="file"
 *             ),
 *             @OA\Property(
 *                  property="foreign_key",
 *                  description="文件的唯一建值",
 *                  type="string"
 *             ),
 *         )
 *     )
 * )
 */
class UploadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => [
                'required',
                app('upload.rule')->getTypes(),
            ],
            'file' => app('upload.rule')->getRule($this->type)
        ];
    }

    public function attributes()
    {
        return [
            'type'        => '类型',
            'file'        => '文件',
            'foreign_key' => '外键',
        ];
    }
}
