<?php 
/**
 * @OA\Schema(
 *      schema="UploadTypesDefault",
 *      enum={"store_avatar"}
 *  )
 */
return [
    'rules' => ['required','max:2','mimes:jpeg,bmp,png,jpg'],
    'types' => [ 
        // 'store_avatar' => [
        //     'path' => 'store_avatar',
        //     'rules' => ['max:100','mimes:jpeg,bmp,png,jpg']
        // ]
    ]
];