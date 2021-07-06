<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CustomersCollection extends ResourceCollection
{
  /**
   * Transform the resource collection into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    return [
      'data' => $this->collection->transform(function ($customer) {
        return [
          'id'        => $customer->id,
          'name'      => $customer->name,
          'kana_name' => $customer->kana_name,
          'email'     => $customer->email,
          'phone'     => $customer->phone,
          'image'     => $customer->image ? asset('storage/images/customers/' . $customer->image) : asset('images/customers/default.jpg')
        ];
      })
    ];
  }
}
