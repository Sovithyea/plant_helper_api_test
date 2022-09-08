<?php

namespace App\Http\Controllers;

use App\Models\Crop;
use App\Models\Disease;
use App\Http\Requests\StoreDiseaseRequest;
use App\Http\Requests\UpdateDiseaseRequest;

class DiseaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diseases = Disease::with('crop')->get();

        return response()->json([
            $diseases
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
     * @param  \App\Http\Requests\StoreDiseaseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDiseaseRequest $request)
    {
        $disease = new Disease();

            $disease->avatar = $request->image;
            $disease->name = $request->name;
            $disease->diagnosis = $request->diagnosis;
            $disease->cause = $request->cause;
            $disease->solution = $request->solution;
            $disease->crop_id = $request->crop_id;

        $disease->save();

        return response()->json([
            'message' => 'Successfully create Disease.'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function show(Disease $disease)
    {
        $id = $disease->id;
        $disease = Disease::with('crop')->where('id', $id)->first();

        return response()->json([
            $disease
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function edit(Disease $disease)
    {
        $id = $disease->id;
        $disease = Disease::with('crop')->where('id', $id)->first();

        return response()->json([
            $disease
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDiseaseRequest  $request
     * @param  \App\Models\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDiseaseRequest $request, $id)
    {
        // dd($request->all());
        $disease = Disease::find($id);

            $disease->avatar = $request->image;
            $disease->name = $request->name;
            $disease->diagnosis = $request->diagnosis;
            $disease->cause = $request->cause;
            $disease->solution = $request->solution;
            $disease->crop_id = $request->crop_id;
        // dd($disease);
        $disease->save();

        return response()->json([
            'message' => 'Update Disease successfully'
        ], 200);

    }

    
    public function delete(Disease $disease)
    {
     
        $disease->delete();

        return response()->json([
            'message' => 'Successfully Deleted!'
        ], 200);
        
    }

    public function recovery($id)
    {
        $disease = Disease::onlyTrashed()->find($id);

        $disease->restore();

        return response()->json([
            'message' => 'Successfully Recovery!'
        ], 200);
    }

    public function forceDelete($id) 
    {
        $disease = Disease::onlyTrashed()->find($id);

        $disease->forceDelete();

        return response()->json([
            'message' => 'Successfully Pernamently Deleted!'
        ], 200);
        
    }

    public function showTrash()
    {
        $disease = Disease::onlyTrashed()->with('crop')->get();

        return response()->json([
            $disease 
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function destroy(Disease $disease)
    {
        //
    }
}
