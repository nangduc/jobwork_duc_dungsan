<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
  public function rules($id = null)
  {
    $rules = [
      'name'        => 'required|string|max:255|unique:roles,name,' . $id,
    ];

    if ($id) return $rules;

    return [
      'name'        => 'required|string|max:255|unique:roles'
    ];
  }
}
