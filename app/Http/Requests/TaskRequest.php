<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
      'user_id'        => 'required|integer',
      'customer_id'    => 'required|integer',
      'task_type_id'   => 'required|integer',
      'sale_status_id' => 'required|integer',
      'name'           => 'required|max:255',
    ];
  }

  public function attributes()
  {
    return [
      'customer_id'    => 'customer',
      'task_type_id'   => 'task type',
      'sale_status_id' => 'sale status',
    ];
  }
}
