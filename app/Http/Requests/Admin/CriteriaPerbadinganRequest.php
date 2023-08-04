<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CriteriaPerbadinganRequest extends FormRequest
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
            'id'                          => 'required|exists:criteria_analyses',
            'criteria_analysis_detail_id' => 'required|array',
            'comparison_values'           => 'required|array'
        ];
    }
}
