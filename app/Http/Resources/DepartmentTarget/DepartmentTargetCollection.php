<?php

namespace App\Http\Resources\DepartmentTarget;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DepartmentTargetCollection extends ResourceCollection
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
          'data' => $this->collection->transform(function ($departmentTargets) {
            $departmentTarget = $departmentTargets->departmentTarget->last();
            return [
              'id'            => $departmentTarget->id,
              'department_id' => $departmentTarget->department_id,
              'target'        => $departmentTarget->target,
              'achievement'   => $departmentTarget->achievement,
              'from'          => $departmentTarget->from,
              'to'            => $departmentTarget->to,
            ];
          }),
        ];
    }
}
