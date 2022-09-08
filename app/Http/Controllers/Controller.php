<?php

namespace App\Http\Controllers;

use App\Models\Crop;
use App\Models\Disease;
use App\Models\Measurement;
use App\Models\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $crops = Crop::all();
        $measurements = Measurement::all();
        $diseases = Disease::all();
        $users = User::all();

        return response()->json([
            $crops,
            $measurements,
            $diseases,
            $users
        ]);
    }
}
