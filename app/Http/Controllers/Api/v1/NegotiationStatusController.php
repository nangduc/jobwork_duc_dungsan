<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\NegotiationStatus;
use App\Http\Requests\NegotiationStatusRequest;

class NegotiationStatusController extends Controller
{
  protected $negotiationStatus;

  public function __construct(NegotiationStatus $negotiationStatus)
  {
    $this->negotiationStatus = $negotiationStatus;
  }

  /**
   * Get all negotiation statuses
   */
  public function index()
  {
    return $this->negotiationStatus->all();
  }

  public function store(NegotiationStatusRequest $request)
  {
    $newNegotiation = $this->negotiationStatus->create($request->all());
    return response()->json([
      'message' => 'success',
      'data' => $newNegotiation
    ], 201);
  }


  public function update(NegotiationStatusRequest $request, $id)
  {
    $negotiation = $this->negotiationStatus->find($id);
    $negotiation->update($request->all());

    return response()->json([
      'message' => 'success',
      'data' => $negotiation
    ]);
  }

  public function destroy(Request $request, $id)
  {
    $article = $this->negotiationStatus->findOrFail($id);
    $article->delete();

    return response()->json([
      'status' => 'success',
    ]);
  }
}
