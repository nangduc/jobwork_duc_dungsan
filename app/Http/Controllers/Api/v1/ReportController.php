<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Report\ReportCollection;
use App\Http\Resources\Report\ReportResource;
use App\Models\Report;
use App\Models\TaskProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
  protected $report;
  protected $taskProgress;

  public function __construct(Report $report, TaskProgress $taskProgress)
  {
    $this->report = $report;
    $this->taskProgress = $taskProgress;
  }

  public function index(Request $request)
  {
    $reports = $this->report->select('id', 'user_id', 'created_at')->with('user:id,name')->ordered()->paginated($request->length);
    return new ReportCollection($reports);
  }

  public function show($id)
  {
    $report =  $this->report->find($id);
    return new ReportResource($report);
  }

  public function getLastReport()
  {
    $report = $this->report->all()->last();
    return new ReportResource($report);
  }

  public function store(Request $request)
  {
    $properties = DB::table('task_progresses')
      ->join('tasks', 'tasks.id', '=', 'task_progresses.task_id')
      ->join('users', 'tasks.user_id', '=', 'users.id')
      ->join('customers', 'tasks.customer_id', '=', 'customers.id')
      ->join('sale_statuses', 'task_progresses.sale_status_id', '=', 'sale_statuses.id')
      ->join('negotiation_statuses', 'task_progresses.negotiation_status_id', '=', 'negotiation_statuses.id')
      ->leftJoin('negotiation_result_statuses', 'task_progresses.negotiation_result_status_id', '=', 'negotiation_result_statuses.id')
      ->select(
        'tasks.id AS id',
        'tasks.name',
        'customers.name AS customer',
        'sale_statuses.name AS sale_status',
        'negotiation_statuses.name AS negotiation_status',
        'negotiation_result_statuses.name AS negotiation_result_status'
      )
      ->where('tasks.user_id', $request->user_id)
      ->where('task_progresses.date', $request->date)
      ->get();

    $this->report->create([
      'user_id' => $request->user_id,
      'content' => $request->content,
      'properties' => json_encode($properties)
    ]);

    return response()->json([
      'message' => 'Created successfully!',
    ], 201);

  }
}
