<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\FieldRequest;
use App\Models\Field;

class FieldController extends Controller
{
	protected $field;

	public function __construct(Field $field)
	{
		$this->field = $field;
	}

	public function index()
	{
		$field = $this->field->all();
		return $field;
	}

	public function store(FieldRequest $request)
	{

		$newField = $this->field->create($request->all());


		return response()->json([
			'message' => 'success',
			'data' => $newField
		], 201);
	}


	public function update(FieldRequest $request, $id)
	{
		$field = $this->field->find($id);
		$field->update($request->all());

		return response()->json([
			'message' => 'success',
			'data' => $field
		]);
	}

	public function destroy(Request $request, $id)
	{
		$field = Field::findOrFail($id);
		$field->delete();

		return response()->json([
			'status' => 'success',
		]);
	}
}
