<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class NegotiationStatusSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $negotiationStatuses = [
      [
        'name' => '架電中', // Đang gọi điện
        'color' => '#F92611',
        'sale_status_id' => 1,
      ],
      [
        'name' => 'アポ確定', // Đã hẹn gặp
        'color' => '#11F9CF',
        'sale_status_id' => 1,
      ],
      [
        'name' => '新規ヒヤリング', // Lắng nghe nhu cầu lần đầu
        'color' => '#11F95E',
        'sale_status_id' => 2,
      ],
      [
        'name' => '再ヒヤリング', // Lắng nghe nhu cầu lại
        'color' => '#F911A1',
        'sale_status_id' => 2,
      ],
      [
        'name' => '新規提案', // Đề xuất lần đầu
        'color' => '#F211F9',
        'sale_status_id' => 2,
      ],
      [
        'name' => '再提案', // Đề xuất lại
        'color' => '#A811F9',
        'sale_status_id' => 2,
      ],
      [
        'name' => '新規見積提示', // Báo giá lần đầu
        'color' => '#2311F9',
        'sale_status_id' => 2,
      ],
      [
        'name' => '再見積提案', // Báo giá lại
        'color' => '#EEF911',
        'sale_status_id' => 2,
      ],
      [
        'name' => 'クロージング', // Closing
        'color' => '#EEF911',
        'sale_status_id' => 3,
      ]
    ];
    DB::table('negotiation_statuses')->insert($negotiationStatuses);
  }
}
