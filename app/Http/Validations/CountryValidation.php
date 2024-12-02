<?php

namespace App\Http\Validations;

use Illuminate\Support\Facades\Validator;

class CountryValidation 
{
    public static function validate($request, $id = 0)
    {
        $validator = Validator::make($request->all(), [
            'name_en' => 'required|string|max:100|unique:countries,name_en,' . $id,
            'name_bn' => 'required|string|max:100|unique:countries,name_bn,' . $id,
            'country_code' => 'required|string|max:2|unique:countries,country_code,' . $id,
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