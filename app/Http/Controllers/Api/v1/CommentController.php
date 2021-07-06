<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Comment\CommentCollection;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
  protected $comment;

  public function __construct(Comment $comment)
  {
    return $this->comment = $comment;
  }

  public function getCommentsByReportId(Request $request, $reportId)
  {
    $comment = $this->comment
      ->where('report_id', $reportId)
      ->with(['user:id,name,kana_name,username,avatar'])
      ->ordered()
      ->paginated($request->length);
    return new CommentCollection($comment);
  }

  public function store(Request $request) {
    $this->comment->create($request->all());
    return response()->json([
      'message' => 'Created successfully!'
    ], 201);
  }

  public function update(Request $request, $id) {
    $comment = $this->comment->find($id);
    $comment->update($request->all());

    return response()->json([
      'message' => 'Updated successfully!'
    ], 201);
  }

  public function destroy($id) {
    $comment = $this->comment->find($id);
    $comment->delete();
    return response()->json([
      'message' => 'Deleted successfully!'
    ], 201);
  }
}
