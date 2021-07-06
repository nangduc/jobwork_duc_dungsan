<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskGroupsSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $taskGroups = [
      [
        'name' => '商談' // Thương thảo
      ],
      [
        'name' => '工程管理' // Quản lý gia công
      ],
      [
        'name' => '商談 (Jibangoo)' // Thương thảo (Jibangoo)
      ],
      [
        'name' => '集客・発信・現場管理等' // Kiếm khách - Kêu gọi - Quản lí hiện trường
      ],
      [
        'name' => 'サポート業務' // Nghiệp vụ hỗ trợ
      ],
      [
        'name' => 'マップ拡販' // Bán bản đồ
      ],
      [
        'name' => 'セミナー集客' //Khách tham dự seminar
      ],
      [
        'name' => 'BIM動画' //VR BIM
      ],
      [
        'name' => '調査補償' //Khảo sát - Bảo hiểm
      ],
      [
        'name' => '新築申込' //Đơn hàng xây mới
      ],
      [
        'name' => 'リフォーム申込' //Đơn hàng reform
      ],
      [
        'name' => '調査・微動' //Khảo sát địa chất - Đo vi chuẩn
      ]
    ];
    DB::table('task_groups')->insert($taskGroups);
  }
}
