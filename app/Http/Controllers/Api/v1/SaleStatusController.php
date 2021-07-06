<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SaleStatus;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\SaleStatusRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SaleStatusController extends Controller
{
  //

  protected $saleStatus;

  public function __construct(SaleStatus $saleStatus)
  {
    $this->saleStatus = $saleStatus;
  }

  /**
   * Get all sale statuses
   */
  public function index()
  {
    $saleStatus = $this->saleStatus->all();
    return $saleStatus;
  }


  public function store(SaleStatusRequest $request)
  {
    $newSaleStatus = $this->saleStatus->create($request->all());


    return response()->json([
      'message' => 'success',
      'data' => $newSaleStatus
    ], 201);
  }


  public function update(SaleStatusRequest $request, $id)
  {

    $saleStatus = $this->saleStatus->find($id);
    $saleStatus->update($request->all());

    return response()->json([
      'message' => 'success',
      'data' => $saleStatus
    ]);
  }

  public function destroy(Request $request, $id)
  {
    $article = SaleStatus::findOrFail($id);
    $article->delete();

    return response()->json([
      'status' => 'success',
    ]);
  }
}
