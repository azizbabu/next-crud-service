<?php

namespace App\Http\Controllers;

use App\Http\Validations\CountryValidation;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Country::latest()->paginate();

        return response([
            'success' => true,
            'message' => 'List of countries',
            'data' => $list
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validationResult = CountryValidation::validate($request);

        if (!$validationResult['success']) {
            return response($validationResult);
        }

        $model = Country::create($request->all());

        if (!$model) {
            return response([
                'success' => false,
                'message' => 'Data not saved'
            ]);
        }

        return response([
            'success' => true,
            'message' => 'Data saved successfully',
            'data' => $model
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validationResult = CountryValidation::validate($request, $id);

        if (!$validationResult['success']) {
            return response($validationResult);
        }

        $model = Country::find($id);

        if (!$model) {
            return response([
                'success' => false,
                'message' => 'Data not found'
            ]);
        }

        $isUpdated = $model->update($request->all());

        if (!$isUpdated) {
            return response([
                'success' => false,
                'message' => 'Data not saved'
            ]);
        }

        return response([
            'success' => true,
            'message' => 'Data saved successfully',
            'data' => $model
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Country::find($id);

        if (!$model) {
            return response([
                'success' => false,
                'message' => 'Data not found'
            ]);
        }

        $isDeleted = $model->delete();

        if (!$isDeleted) {
            return response([
                'success' => false,
                'message' => 'Data not deleted'
            ]);
        }

        return response([
            'success' => true,
            'message' => 'Data deleted successfully',
            'data' => $model
        ]);
    }
}
