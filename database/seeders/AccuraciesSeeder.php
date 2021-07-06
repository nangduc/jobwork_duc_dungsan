<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccuraciesSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $accuracies = [
      [
        'name' => '角度A', // Góc độ A
      ],
      [
        'name' => '角度B', // Góc độ B
      ],
      [
        'name' => '角度C', // Góc độ C
      ],
      [
        'name' => '受注', // Nhận đơn
      ]
    ];

    DB::table('accuracies')->insert($accuracies);
  }
}
