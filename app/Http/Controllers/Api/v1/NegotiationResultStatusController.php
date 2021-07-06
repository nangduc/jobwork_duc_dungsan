<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\NegotiationResultStatusRequest;
use App\Models\NegotiationResultStatus;

class NegotiationResultStatusController extends Controller
{
    protected $negotiationResultStatus;

	public function __construct(NegotiationResultStatus $negotiationResultStatus)
	{
		$this->negotiationResultStatus = $negotiationResultStatus;
	}

	public function index()
	{
		$negotiationResultStatus = $this->negotiationResultStatus->all();
		return $negotiationResultStatus;
	}


	public function store(NegotiationResultStatusRequest $request)
	{
		$newNegotiationResultStatus = $this->negotiationResultStatus->create($request->all());


		return response()->json([
			'message' => 'success',
			'data' => $newNegotiationResultStatus
		], 201);
	}


	public function update(NegotiationResultStatusRequest $request, $id)
	{
		$negotiationResultStatus = $this->negotiationResultStatus->find($id);
		$negotiationResultStatus->update($request->all());

		return response()->json([
			'message' => 'success',
			'data' => $negotiationResultStatus
		]);
	}

	public function destroy(Request $request, $id)
	{
		$negotiationResultStatus = $this->negotiationResultStatus->findOrFail($id);
		$negotiationResultStatus->delete();

		return response()->json([
			'status' => 'success',
		]);
	}
}
