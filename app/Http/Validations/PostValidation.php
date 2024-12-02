<?php

namespace App\Http\Validations;

use Illuminate\Support\Facades\Validator;

class PostValidation 
{
    public static function validate($request, $id = 0)
    {
        $validator = Validator::make($request->all(), [
            'title_en' => 'required|string|max:100',
            'title_bn' => 'required|string|max:100',
            'content_en' => 'required|string',
            'content_bn' => 'required|string',
        ]);

        if ($validator->fails()) {
            return [
                'success' => false,
                'errors' => $validator->errors()
            ];
        }

        return ['success' => true];
    }
}