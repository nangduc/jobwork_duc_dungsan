<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CustomersSelectBoxCollection extends ResourceCollection
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
            'parent_id' => $customer->parent_id,
            'name'      => $customer->name,
            'children'  => $customer->children
          ];
        })
      ];
    }
}
