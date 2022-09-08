<?php

namespace App\Http\Controllers;

use App\Models\Crop;
use App\Models\Measurement;
use App\Http\Requests\StoreMeasurementRequest;
use App\Http\Requests\UpdateMeasurementRequest;

class MeasurementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $measurement = Measurement::with('crop')->get();

        return response()->json([
            $measurement
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $crop = Crop::all();

        return response()->json([
            $crop
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMeasurementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMeasurementRequest $request)
    {
        // $measurement = Measurement::with('crop')->where('id', );
        // dd($crop);
        
            $measurement = new Measurement();

            $measurement->ph = $request->ph;
            $measurement->ec = $request->ec;
            $measurement->temp = $request->temp;
            $measurement->humidity = $request->humidity;
            $measurement->soil_moisture = $request->soil_moisture;
            $measurement->crop_id = $request->crop_id;
            
            $measurement->save();

            return response()->json([
                'message' => 'Succesfully create Measurement.'
            ], 200);
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Measurement  $measurement
     * @return \Illuminate\Http\Response
     */
    public function show(Measurement $measurement)
    {
        $id = $measurement->id;
        $measurement = Measurement::with('crop')->where('id', $id)->first();

        return response()->json([
            $measurement
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Measurement  $measurement
     * @return \Illuminate\Http\Response
     */
    public function edit(Measurement $measurement)
    {
        $id = $measurement->id;
        $measurement = Measurement::with('crop')->where('id', $id)->first();

        return response()->json([
            $measurement
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMeasurementRequest  $request
     * @param  \App\Models\Measurement  $measurement
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMeasurementRequest $request, $id)
    {
        $measurement = Measurement::find($id);

            $measurement->ph = $request->ph;
            $measurement->ec = $request->ec;
            $measurement->temp = $request->temp;
            $measurement->humidity = $request->humidity;
            $measurement->soil_moisture = $request->soil_moisture;
            $measurement->crop_id = $request->crop_id;

        $measurement->save();

        return response()->json([
            'message' => 'Update Measurement successfully'
        ], 200);
    }

    public function delete(Measurement $measurement)
    {
     
        $measurement->delete();

        return response()->json([
            'message' => 'Successfully Deleted!'
        ], 200);
        
    }

    public function recovery($id)
    {
        $measurement = Measurement::onlyTrashed()->find($id);

        $measurement->restore();

        return response()->json([
            'message' => 'Successfully Recovery!'
        ], 200);
    }

    public function forceDelete($id) 
    {
        $measurement = Measurement::onlyTrashed()->find($id);

        $measurement->forceDelete();

        return response()->json([
            'message' => 'Successfully Pernamently Deleted!'
        ], 200);
        
    }

    public function showTrash()
    {
        $measurement = Measurement::onlyTrashed()->with('crop')->get();

        return response()->json([
            $measurement
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Measurement  $measurement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Measurement $measurement)
    {
        //
    }
}
