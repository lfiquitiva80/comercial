<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExerciseUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'year_id' => ['required', 'integer', 'exists:years,id'],
            'month_id' => ['required', 'integer', 'exists:months,id'],
            'client_id' => ['required', 'integer', 'exists:clients,id'],
            'direccion' => ['required', 'string', 'max:100'],
            'ciudad' => ['required', 'string', 'max:20'],
            'observaciones' => ['required', 'string'],
            'latitude' => ['required', 'string', 'max:20'],
            'longitude' => ['required', 'string', 'max:20'],
            'map' => ['required', 'string', 'max:50'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
        ];
    }
}
