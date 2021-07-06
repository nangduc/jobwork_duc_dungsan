<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SaleStatusSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $saleStatuses = [
      [
        'name' => '架電中', // Đang gọi điện
        'color' => '#007BFF',
      ],
      [
        'name' => '商談', // Thương thảo
        'color' => '#28A745',
      ],
      [
        'name' => 'クロージング', // Closing
        'color' => '#6C757D',
      ]
    ];

    DB::table('sale_statuses')->insert($saleStatuses);
  }
}
