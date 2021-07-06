<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AccuraciesRequest;
use App\Models\Accuracy;

class AccuraciesController extends Controller
{
  protected $accuracies;

  public function __construct(Accuracy $accuracies)
  {
    $this->accuracies = $accuracies;
  }

  /**
   * Get all accuracies
   */
  public function index()
  {
    $accuracies = $this->accuracies->all();
    return $accuracies;
  }


  public function store(AccuraciesRequest $request)
  {
    $newAccuracies = $this->accuracies->create($request->all());


    return response()->json([
      'message' => 'success',
      'data' => $newAccuracies
    ], 201);
  }


  public function update(AccuraciesRequest $request, $id)
  {
    $accuracies = $this->accuracies->find($id);
    $accuracies->update($request->all());

    return response()->json([
      'message' => 'success',
      'data' => $accuracies
    ]);
  }

  public function destroy(Request $request, $id)
  {
    $accuracies = $this->accuracies->findOrFail($id);
    $accuracies->delete();

    return response()->json([
      'status' => 'success',
    ]);
  }
}
