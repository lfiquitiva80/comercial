<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'line_id' => ['required', 'integer', 'exists:lines,id'],
            'marker_id' => ['required', 'integer', 'exists:makers,id'],
            'brand_id' => ['required', 'integer', 'exists:brands,id'],
            'presentation_id' => ['required', 'integer', 'exists:presentations,id'],
            'precio_iva' => ['required'],
            'observaciones' => ['required', 'string'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
        ];
    }
}
