<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentTargetRequest extends FormRequest
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
            'targets' => 'required|between:0,99.99',
            'department_id' => 'required|integer|unique:department_targets,department_id,NULL,id,deleted_at,NULL',
            'year' => 'required'
        ];
    }
}
