<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\EmployeeTarget;
use Illuminate\Http\Request;

class EmployeeTargetController extends Controller
{
    
    protected $employeeTarget;
    public function __construct(EmployeeTarget $employeeTarget)
    {
        $this->employeeTarget = $employeeTarget;
    }

    
}
