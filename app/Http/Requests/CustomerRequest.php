<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
    return [
      'name'     => 'required',
      'image'    => 'nullable|mimes:jpeg,jpg,png,gif|max:100000',
      'email'    => 'sometimes|nullable|email',
      'phone'    => 'nullable|min:10|max:15|regex:/^([0-9\s\-\+\(\)]*)$/',
      'founding' => 'nullable|date|date_format:Y-m-d|before:today',
    ];
  }
}
