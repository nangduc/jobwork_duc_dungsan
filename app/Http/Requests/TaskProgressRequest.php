<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskProgressRequest extends FormRequest
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
      'date'                         => 'required|date',
      'task_id'                      => 'required|integer',
      'sale_status_id'               => 'nullable|integer',
      'negotiation_status_id'        => 'nullable|integer',
      'negotiation_result_status_id' => 'nullable|integer',
      'accuracy_id'                  => 'nullable|integer',
      'companion_id'                 => 'nullable|integer',
      'next_negotiation_date'        => 'nullable|date'
    ];
  }
}
