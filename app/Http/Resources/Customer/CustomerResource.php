<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    return [
      'parent_id'           => $this->parent_id,
      'id'                  => $this->id,
      'name'                => $this->name,
      'kana_name'           => $this->kana_name,
      'business_name'       => $this->business_name,
      'short_name'          => $this->short_name,
      'representative'      => $this->representative,
      'image'               => $this->image ? asset('storage/images/customers/' . $this->image) : asset('images/customers/default.jpg'),
      'building_name'       => $this->building_name,
      'street'              => $this->street,
      'district'            => $this->district,
      'province'            => $this->province,
      'address'             => $this->address,
      'post_code'           => $this->post_code,
      'phone'               => $this->phone,
      'fax'                 => $this->fax,
      'email'               => $this->email,
      'website'             => $this->website,
      'charter_capital'     => $this->charter_capital,
      'founding'            => $this->founding,
      'number_of_employees' => $this->number_of_employees,
      'revenue'             => $this->revenue,
      'remark'              => $this->remark,
      'created_at'          => $this->created_at,
      'updated_at'          => $this->updated_at,
      'fields' => $this->fields
    ];
  }
}
