<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $reports = [
        [
          'user_id' => 2,
          'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry',
          'properties' => json_encode([
            [
              'id' => 1,
              'name' => 'Ken 1',
              'customer' => 'Toyota Motor',
              'sale_status' => '商談',
              'negotiation_status' => 'アポ確定',
              'negotiation_result_status' => '先方返答待ち'
            ],
            [
              'id' => 2,
              'name' => 'Ken 2',
              'customer' => 'Toyota Motor',
              'sale_status' => '商談',
              'negotiation_status' => 'アポ確定',
              'negotiation_result_status' => '先方返答待ち'
            ]
          ]),
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
        [
          'user_id' => 2,
          'content' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
          'properties' => null,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
        [
          'user_id' => 3,
          'content' => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old',
          'properties' => null,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
        [
          'user_id' => 4,
          'content' => 'here are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form',
          'properties' => null,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
        [
          'user_id' => 4,
          'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry 123',
          'properties' => null,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
      ];
        DB::table('reports')->insert($reports);

    }
}
