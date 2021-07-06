<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskProgressSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $taskProgresses = [
      [
        'date'                          => Carbon::now(),
        'task_id'                      => 1,
        'sale_status_id'               => 1,
        'negotiation_status_id'        => 1,
        'negotiation_result_status_id' => 1,
        'accuracy_id'                  => 1,
        'companion_id'                 => 1,
        'description'                  => 'test',
        'next_negotiation_date'        => new Carbon('2021-1-2'),
        'plan_next_time'               => '',
        'created_at'                   => Carbon::now(),
        'updated_at'                   => Carbon::now()
      ],
      [
        'date'                          => Carbon::now(),
        'task_id'                      => 1,
        'sale_status_id'               => 2,
        'negotiation_status_id'        => 2,
        'negotiation_result_status_id' => 2,
        'accuracy_id'                  => 2,
        'companion_id'                 => 1,
        'description'                  => '',
        'next_negotiation_date'        => new Carbon('2021-1-2'),
        'plan_next_time'               => 'Sign a contract',
        'created_at'                   => Carbon::now(),
        'updated_at'                   => Carbon::now()
      ]
    ];

    DB::table('task_progresses')->insert($taskProgresses);
  }
}
