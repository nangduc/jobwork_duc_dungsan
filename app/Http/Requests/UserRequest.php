<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
      'name'          => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
      'username'      => 'sometimes|required|string|max:255|alpha_dash|unique:users,username,' . $id,
      'email'         => 'sometimes|required|email|unique:users,email,' . $id,
      'phone'         => 'nullable|min:10|max:15|regex:/^([0-9\s\-\+\(\)]*)$/|unique:users,phone,' . $id,
      'birthday'      => 'nullable|date|date_format:Y-m-d|before:today',
      'avatar'        => 'nullable|mimes:jpeg,jpg,png,gif|max:100000',
    ];

    if ($id) return $rules;

    return array_merge($rules, [
      'username'      => 'required|string|max:255|alpha_dash|unique:users,username',
      'email'         => 'required|email|unique:users',
      'phone'         => 'nullable|min:10|max:15|regex:/^([0-9\s\-\+\(\)]*)$/|unique:users',
      'department_id' => 'required',
      'role'          => 'required'
    ]);
  }

  public function attributes()
  {
    return [
      'department_id'  => 'department',
    ];
  }
}
