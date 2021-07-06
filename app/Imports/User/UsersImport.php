<?php

namespace App\Imports\User;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class UsersImport implements WithMultipleSheets
{
  public function sheets(): array
  {
    return [
      new FirstSheetImport
    ];
  }
}
