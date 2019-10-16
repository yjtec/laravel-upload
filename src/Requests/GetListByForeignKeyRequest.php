<?php
namespace Yjtec\Upload\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Parameter(
 *   parameter="uploadGetListByForeignKeyParameter_type",
 *   name="type",
 *   description="类型",
 *   @OA\Schema(
 *       type="array",
 *       @OA\Items(ref="#/components/schemas/UploadTypes")
 *   ),
 *   in="query",
 *   required=true
 * )
 */
/**
 * @OA\Parameter(
 *   parameter="uploadGetListByForeignKeyParameter_foreign_key",
 *   name="foreign_key",
 *   description="文件的唯一建值",
 *   @OA\Schema(
 *     type="integer",
 *   ),
 *   in="query",
 *   required=true
 * )
 */
class GetListByForeignKeyRequest extends FormRequest
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
            'foreign_key' => [
                'required',
                'integer',
            ],
        ];
    }

    public function attributes()
    {
        return [
            'type' => '类型',
            'foreign_key' => '外键',
        ];
    }
}
