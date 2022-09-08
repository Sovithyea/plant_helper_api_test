<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMeasurementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'temp' => ['numeric'],
            'humidity' => ['numeric'],
            'soil_moisture' => ['numeric'],
            'ph' => ['numeric'],
            'ec' => ['numeric'],
            'crop_id' => ['integer', 'required']
        ];
    }
}
