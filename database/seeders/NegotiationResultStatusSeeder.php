<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class NegotiationResultStatusSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $negotiationResultStatuses = [
      [
        'name' => '次回再提案', // Lần tiếp theo sẽ đề xuất tiếp
        'color' => '#ACF911',
      ],
      [
        'name' => '先方返答待ち', // Đang đợi khách hàng trả lời
        'color' => '#11F9D6',
      ],
      [
        'name' => '受注/契約確定', // Nhận đơn hàng/Ký hợp đồng
        'color' => '#F9112A',
      ],
      [
        'name' => '受注/契約ならず', // Nhận đơn hàng/Không ký hợp đồng
        'color' => '#F96211',
      ]
    ];

    DB::table('negotiation_result_statuses')->insert($negotiationResultStatuses);
  }
}
