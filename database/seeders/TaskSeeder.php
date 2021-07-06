<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $current = Carbon::now();
    $tasks = [
      [
        'name'              => 'Ken 1',
        'user_id'           => 2,
        'customer_id'       => 1,
        'task_type_id'      => 1,
        'description'       => 'Description ken 1',
        'expected_order_at' => $current->addDays(10),
        'survey_price'      => 25000,
        'insurance_price'   => 25000,
        'created_at'        => Carbon::now(),
        'updated_at'        => Carbon::now()
      ],
      [
        'name'              => 'Ken 2',
        'user_id'           => 2,
        'customer_id'       => 1,
        'task_type_id'      => 1,
        'description'       => 'Description ken 2',
        'expected_order_at' => $current->addDays(5),
        'survey_price'      => 25000,
        'insurance_price'   => 25000,
        'created_at'        => Carbon::now(),
        'updated_at'        => Carbon::now()
      ],
      [
        'name'              => 'Ken 3',
        'user_id'           => 2,
        'customer_id'       => 1,
        'task_type_id'      => 1,
        'description'       => 'Description ken 3',
        'expected_order_at' => $current->addDays(15),
        'survey_price'      => 25000,
        'insurance_price'   => 25000,
        'created_at'        => Carbon::now(),
        'updated_at'        => Carbon::now()
      ],
      [
        'name'              => 'Ken 4',
        'user_id'           => 2,
        'customer_id'       => 1,
        'task_type_id'      => 1,
        'description'       => 'Description ken 3',
        'expected_order_at' => $current->addDays(15),
        'survey_price'      => 25000,
        'insurance_price'   => 25000,
        'created_at'        => Carbon::now(),
        'updated_at'        => Carbon::now()
      ],
      [
        'name'              => 'Ken 5',
        'user_id'           => 2,
        'customer_id'       => 1,
        'task_type_id'      => 1,
        'description'       => 'Description ken 3',
        'expected_order_at' => $current->addDays(15),
        'survey_price'      => 25000,
        'insurance_price'   => 25000,
        'created_at'        => Carbon::now(),
        'updated_at'        => Carbon::now()
      ],
      [
        'name'              => 'Ken 6',
        'user_id'           => 2,
        'customer_id'       => 1,
        'task_type_id'      => 1,
        'description'       => 'Description ken 3',
        'expected_order_at' => $current->addDays(15),
        'survey_price'      => 25000,
        'insurance_price'   => 25000,
        'created_at'        => Carbon::now(),
        'updated_at'        => Carbon::now()
      ], [
        'name'              => 'Ken 7',
        'user_id'           => 2,
        'customer_id'       => 1,
        'task_type_id'      => 1,
        'description'       => 'Description ken 3',
        'expected_order_at' => $current->addDays(15),
        'survey_price'      => 25000,
        'insurance_price'   => 25000,
        'created_at'        => Carbon::now(),
        'updated_at'        => Carbon::now()
      ],
      [
        'name'              => 'Ken 8',
        'user_id'           => 2,
        'customer_id'       => 1,
        'task_type_id'      => 1,
        'description'       => 'Description ken 3',
        'expected_order_at' => $current->addDays(15),
        'survey_price'      => 25000,
        'insurance_price'   => 25000,
        'created_at'        => Carbon::now(),
        'updated_at'        => Carbon::now()
      ],
      [
        'name'              => 'Ken 9',
        'user_id'           => 2,
        'customer_id'       => 1,
        'task_type_id'      => 1,
        'description'       => 'Description ken 3',
        'expected_order_at' => $current->addDays(15),
        'survey_price'      => 25000,
        'insurance_price'   => 25000,
        'created_at'        => Carbon::now(),
        'updated_at'        => Carbon::now()
      ],
      [
        'name'              => 'Ken 10',
        'user_id'           => 2,
        'customer_id'       => 1,
        'task_type_id'      => 1,
        'description'       => 'Description ken 3',
        'expected_order_at' => $current->addDays(15),
        'survey_price'      => 25000,
        'insurance_price'   => 25000,
        'created_at'        => Carbon::now(),
        'updated_at'        => Carbon::now()
      ],
      [
        'name'              => 'Ken 11',
        'user_id'           => 3,
        'customer_id'       => 1,
        'task_type_id'      => 1,
        'description'       => 'Description ken 3',
        'expected_order_at' => $current->addDays(15),
        'survey_price'      => 25000,
        'insurance_price'   => 25000,
        'created_at'        => Carbon::now(),
        'updated_at'        => Carbon::now()
      ],
      [
        'name'              => 'Ken 12',
        'user_id'           => 3,
        'customer_id'       => 1,
        'task_type_id'      => 1,
        'description'       => 'Description ken 3',
        'expected_order_at' => $current->addDays(15),
        'survey_price'      => 25000,
        'insurance_price'   => 25000,
        'created_at'        => Carbon::now(),
        'updated_at'        => Carbon::now()
      ],
      [
        'name'              => 'Ken 13',
        'user_id'           => 3,
        'customer_id'       => 1,
        'task_type_id'      => 1,
        'description'       => 'Description ken 3',
        'expected_order_at' => $current->addDays(15),
        'survey_price'      => 25000,
        'insurance_price'   => 25000,
        'created_at'        => Carbon::now(),
        'updated_at'        => Carbon::now()
      ],
      [
        'name'              => 'Ken 14',
        'user_id'           => 3,
        'customer_id'       => 1,
        'task_type_id'      => 1,
        'description'       => 'Description ken 3',
        'expected_order_at' => $current->addDays(15),
        'survey_price'      => 25000,
        'insurance_price'   => 25000,
        'created_at'        => Carbon::now(),
        'updated_at'        => Carbon::now()
      ],
      [
        'name'              => 'Ken 15',
        'user_id'           => 3,
        'customer_id'       => 1,
        'task_type_id'      => 1,
        'description'       => 'Description ken 3',
        'expected_order_at' => $current->addDays(15),
        'survey_price'      => 25000,
        'insurance_price'   => 25000,
        'created_at'        => Carbon::now(),
        'updated_at'        => Carbon::now()
      ],
      [
        'name'              => 'Ken 16',
        'user_id'           => 3,
        'customer_id'       => 1,
        'task_type_id'      => 1,
        'description'       => 'Description ken 3',
        'expected_order_at' => $current->addDays(15),
        'survey_price'      => 25000,
        'insurance_price'   => 25000,
        'created_at'        => Carbon::now(),
        'updated_at'        => Carbon::now()
      ],
      [
        'name'              => 'Ken 17',
        'user_id'           => 3,
        'customer_id'       => 1,
        'task_type_id'      => 1,
        'description'       => 'Description ken 3',
        'expected_order_at' => $current->addDays(15),
        'survey_price'      => 25000,
        'insurance_price'   => 25000,
        'created_at'        => Carbon::now(),
        'updated_at'        => Carbon::now()
      ],
      [
        'name'              => 'Ken 18',
        'user_id'           => 3,
        'customer_id'       => 1,
        'task_type_id'      => 1,
        'description'       => 'Description ken 3',
        'expected_order_at' => $current->addDays(15),
        'survey_price'      => 25000,
        'insurance_price'   => 25000,
        'created_at'        => Carbon::now(),
        'updated_at'        => Carbon::now()
      ],
      [
        'name'              => 'Ken 19',
        'user_id'           => 3,
        'customer_id'       => 1,
        'task_type_id'      => 1,
        'description'       => 'Description ken 3',
        'expected_order_at' => $current->addDays(15),
        'survey_price'      => 25000,
        'insurance_price'   => 25000,
        'created_at'        => Carbon::now(),
        'updated_at'        => Carbon::now()
      ],
      [
        'name'              => 'Ken 20',
        'user_id'           => 3,
        'customer_id'       => 1,
        'task_type_id'      => 1,
        'description'       => 'Description ken 3',
        'expected_order_at' => $current->addDays(15),
        'survey_price'      => 25000,
        'insurance_price'   => 25000,
        'created_at'        => Carbon::now(),
        'updated_at'        => Carbon::now()
      ],
      [
        'name'              => 'Ken 21',
        'user_id'           => 3,
        'customer_id'       => 1,
        'task_type_id'      => 1,
        'description'       => 'Description ken 3',
        'expected_order_at' => $current->addDays(15),
        'survey_price'      => 25000,
        'insurance_price'   => 25000,
        'created_at'        => Carbon::now(),
        'updated_at'        => Carbon::now()
      ],
      [
        'name'              => 'Ken 22',
        'user_id'           => 3,
        'customer_id'       => 1,
        'task_type_id'      => 1,
        'description'       => 'Description ken 3',
        'expected_order_at' => $current->addDays(15),
        'survey_price'      => 25000,
        'insurance_price'   => 25000,
        'created_at'        => Carbon::now(),
        'updated_at'        => Carbon::now()
      ],
      [
        'name'              => 'Ken 23',
        'user_id'           => 3,
        'customer_id'       => 1,
        'task_type_id'      => 1,
        'description'       => 'Description ken 3',
        'expected_order_at' => $current->addDays(15),
        'survey_price'      => 25000,
        'insurance_price'   => 25000,
        'created_at'        => Carbon::now(),
        'updated_at'        => Carbon::now()
      ],
      [
        'name'              => 'Ken 24',
        'user_id'           => 3,
        'customer_id'       => 1,
        'task_type_id'      => 1,
        'description'       => 'Description ken 3',
        'expected_order_at' => $current->addDays(15),
        'survey_price'      => 25000,
        'insurance_price'   => 25000,
        'created_at'        => Carbon::now(),
        'updated_at'        => Carbon::now()
      ],
      [
        'name'              => 'Ken 25',
        'user_id'           => 3,
        'customer_id'       => 1,
        'task_type_id'      => 1,
        'description'       => 'Description ken 3',
        'expected_order_at' => $current->addDays(15),
        'survey_price'      => 25000,
        'insurance_price'   => 25000,
        'created_at'        => Carbon::now(),
        'updated_at'        => Carbon::now()
      ],
      [
        'name'              => 'Ken 26',
        'user_id'           => 3,
        'customer_id'       => 1,
        'task_type_id'      => 1,
        'description'       => 'Description ken 3',
        'expected_order_at' => $current->addDays(15),
        'survey_price'      => 25000,
        'insurance_price'   => 25000,
        'created_at'        => Carbon::now(),
        'updated_at'        => Carbon::now()
      ],
      [
        'name'              => 'Ken 27',
        'user_id'           => 3,
        'customer_id'       => 1,
        'task_type_id'      => 1,
        'description'       => 'Description ken 3',
        'expected_order_at' => $current->addDays(15),
        'survey_price'      => 25000,
        'insurance_price'   => 25000,
        'created_at'        => Carbon::now(),
        'updated_at'        => Carbon::now()
      ],
      [
        'name'              => 'Ken 28',
        'user_id'           => 3,
        'customer_id'       => 1,
        'task_type_id'      => 1,
        'description'       => 'Description ken 3',
        'expected_order_at' => $current->addDays(15),
        'survey_price'      => 25000,
        'insurance_price'   => 25000,
        'created_at'        => Carbon::now(),
        'updated_at'        => Carbon::now()
      ],
      [
        'name'              => 'Ken 29',
        'user_id'           => 3,
        'customer_id'       => 1,
        'task_type_id'      => 1,
        'description'       => 'Description ken 3',
        'expected_order_at' => $current->addDays(15),
        'survey_price'      => 25000,
        'insurance_price'   => 25000,
        'created_at'        => Carbon::now(),
        'updated_at'        => Carbon::now()
      ],
      [
        'name'              => 'Ken 30',
        'user_id'           => 3,
        'customer_id'       => 1,
        'task_type_id'      => 1,
        'description'       => 'Description ken 3',
        'expected_order_at' => $current->addDays(15),
        'survey_price'      => 25000,
        'insurance_price'   => 25000,
        'created_at'        => Carbon::now(),
        'updated_at'        => Carbon::now()
      ],
      [
        'name'              => 'Ken 31',
        'user_id'           => 3,
        'customer_id'       => 1,
        'task_type_id'      => 1,
        'description'       => 'Description ken 3',
        'expected_order_at' => $current->addDays(15),
        'survey_price'      => 25000,
        'insurance_price'   => 25000,
        'created_at'        => Carbon::now(),
        'updated_at'        => Carbon::now()
      ],
      [
        'name'              => 'Ken 32',
        'user_id'           => 3,
        'customer_id'       => 1,
        'task_type_id'      => 1,
        'description'       => 'Description ken 3',
        'expected_order_at' => $current->addDays(15),
        'survey_price'      => 25000,
        'insurance_price'   => 25000,
        'created_at'        => Carbon::now(),
        'updated_at'        => Carbon::now()
      ]
    ];

    DB::table('tasks')->insert($tasks);
  }
}
