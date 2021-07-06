<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Http\Resources\Customer\CustomerResource;
use App\Http\Resources\Customer\CustomersCollection;
use App\Http\Resources\Customer\CustomersSelectBoxCollection;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Image;

class CustomerController extends Controller
{
  protected $customer;

  public function __construct(Customer $customer)
  {
    $this->customer = $customer;
  }

  /**
   * Get all customers
   */

  public function index(Request $request)
  {
    $customers = $this->customer
      ->select('id', 'name', 'kana_name', 'email', 'phone', 'image')->search($request->search)
      ->ordered()
      ->paginated($request->length);;
    return new CustomersCollection($customers);
  }

  /**
   * Get id, name attribute from customers for select box
   * @param object $request
   * @return json
   */
  public function getCustomersForSelectBox(Request $request)
  {
    $customers = $this->customer
      ->select('id', 'parent_id', 'name')
      ->with('children:id,parent_id,name')
      ->where('parent_id', null)
      ->search($request->search)
      ->ordered()
      ->paginated($request->length);

    return new CustomersSelectBoxCollection($customers);
  }

  /**
   * Create new customer
   */

  public function store(CustomerRequest $request)
  {
    DB::beginTransaction();
    try {
      $data = $request->except(['image', 'field_ids']);
      if ($request->hasFile('image')) {

        $filename = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
        $image = $request->file('image');
        Image::make($image)->resize(300, 300)->save(public_path('storage/images/customers/' . $filename));
        $data['image'] = $filename;
      }
      $data['address'] = $request->province . ', ' . $request->district . ', ' . $request->street . ', ' . $request->building_name;
      $customer = $this->customer->create($data);
      $customer->fields()->sync($request->field_ids);

      DB::commit();
      return response()->json([
        'message' => 'Created successfully!',
      ], 201);
    } catch (\Throwable $th) {
      DB::rollBack();
      return response()->json(['message' => $th->getMessage()], 400);
    }
  }

  /**
   * Update customer
   */
  public function update(CustomerRequest $request, $id)
  {
    $customer = $this->customer->find($id);

    // $validator   = Validator::make($request->all(), (new CustomerRequest)->rules($id));
    // if ($validator->fails()) return response()->json($validator->errors(), 422);

    if ($customer->image) {
      File::delete('storage/images/customers/' . $customer->image);
    }

    $data = $request->except(['avatar', '_method']);

    if ($request->hasFile('image')) {
      $image = $request->file('image');
      $filename = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
      Image::make($image)->resize(300, 300)->save(public_path('storage/images/customers/' . $filename));
      $data['image'] = $filename;
    }

    $customer->update($data);
    $customer->fields()->sync($request->field_ids);
    return response()->json([
      'message' => 'Updated successfully!',
    ]);
  }

  public function show($id)
  {
    $customer = $this->customer->with(['fields:id,name'])->find($id);
    return new CustomerResource($customer);
  }

  /**
   * soft delete customer
   */
  public function softDelete(Request $request)
  {
    $this->customer->destroy($request->ids);

    return response()->json([
      'message' => 'Deleted successfully!',
    ]);
  }
}
