<?php

namespace App\Http\Controllers;

use App\Models\Crop;
use App\Http\Requests\StoreCropRequest;
use App\Http\Requests\UpdateCropRequest;

class CropController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $crops = Crop::with(['measurement'])->get();

        return response()->json([
            $crops
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCropRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCropRequest $request)
    {
        // dd($request->all());
        $crop = new Crop();
    
            $crop->avatar = $request->image;
            $crop->name = $request->name;
            $crop->sown = $request->sown;
            $crop->harvest = $request->harvest;
            $crop->expired = $request->expired;

            $crop->save();
        // dd($crop);        
        return response()->json([
            'message'=>'Create crop succesfully!'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Crop  $crop
     * @return \Illuminate\Http\Response
     */
    public function show(Crop $crop)
    {
        $id = $crop->id;
        $crop = Crop::with(['measurement', 'disease'])->where('id', $id)->first();

        return response()->json([
            $crop
        ], 200);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Crop  $crop
     * @return \Illuminate\Http\Response
     */
    public function edit(Crop $crop)
    {
        return response()->json([
            $crop
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCropRequest  $request
     * @param  \App\Models\Crop  $crop
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCropRequest $request, $id)
    {
        $crop = Crop::find($id);
        // dd($request->all());
        
            $crop->avatar = $request->image;
            $crop->name = $request->name;
            $crop->sown = $request->sown;
            $crop->harvest = $request->harvest;
            $crop->expired = $request->expired;

            $crop->save();
            // dd($crop);
        return response()->json([
            'message'=>'Update crop succesfully!'
        ], 200);
    }

    public function delete(Crop $crop)
    {
     
        $crop->delete();

        return response()->json([
            'message' => 'Successfully Deleted!'
        ], 200);
        
    }

    public function recovery($id)
    {
        $crop = Crop::onlyTrashed()->find($id);

        $crop->restore();

        return response()->json([
            'message' => 'Successfully Recovery!'
        ], 200);
    }

    public function forceDelete($id) 
    {
        $crop = Crop::onlyTrashed()->find($id);

        $crop->forceDelete();

        return response()->json([
            'message' => 'Successfully Pernamently Deleted!'
        ], 200);
        
    }

    public function showTrash()
    {
        $crops = Crop::onlyTrashed()->with('measurement')->get();

        return response()->json([
            $crops 
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Crop  $crop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Crop $crop)
    {
        //
    }
}
