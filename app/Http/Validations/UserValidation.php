<?php

namespace App\Http\Validations;

use Illuminate\Support\Facades\Validator;

class UserValidation 
{
    public static function validate($request, $id = 0)
    {
        $validator = Validator::make($request->all(), [
            'country_id' => 'required|integer|exists:countries,id,status,1',
            'name_en' => 'required|string|max:100',
            'name_bn' => 'required|string|max:100',
            'email' => 'nullable|string|unique:users,email,' . $id,
            'username' => 'required|string|unique:users,username,' . $id,
            'mobile' => 'required|string|unique:users,mobile,' . $id,
            'birth_date' => 'nullable|date|date_format:Y-m-d',
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