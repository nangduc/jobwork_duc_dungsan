<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskTypesSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $taskTypes = [
      [
        'task_group_id' => 1,
        'name' => '商談'
      ],
      [
        'task_group_id' => 2,
        'name' => '受注対応' // Đối ứng đơn hàng
      ],
      [
        'task_group_id' => 2,
        'name' => 'CB'
      ],
      [
        'task_group_id' => 2,
        'name' => '納品' // Giao hàng
      ],
      [
        'task_group_id' => 2,
        'name' => 'CAD'
      ],
      [
        'task_group_id' => 3,
        'name' => '施主新規' // Khách hàng mới
      ],
      [
        'task_group_id' => 3,
        'name' => '施主継続' // Khách hàng hiện tại
      ],
      [
        'task_group_id' => 3,
        'name' => '業者商談' // Thương thảo với trung gian
      ],
      [
        'task_group_id' => 3,
        'name' => 'アポ'
      ],
      [
        'task_group_id' => 4,
        'name' => '商談'
      ],
      [
        'task_group_id' => 4,
        'name' => '引渡' // Bàn giao
      ],
      [
        'task_group_id' => 4,
        'name' => '現場対応' // Đối ứng hiện trường
      ],
      [
        'task_group_id' => 5,
        'name' => 'サービス案内' // Hướng dẫn sử dụng dịch vụ
      ],
      [
        'task_group_id' => 5,
        'name' => 'CS･FC対応' // Đối ứng CS - FC
      ],
      [
        'task_group_id' => 5,
        'name' => '社内サポート' // Hỗ trợ nội bộ
      ],
      [
        'task_group_id' => 5,
        'name' => '回収件数' // Số đơn hàng thu hồi được
      ],
      [
        'task_group_id' => 5,
        'name' => '営業同行' // Đồng hành sale
      ],
      [
        'task_group_id' => 5,
        'name' => '設計審査' // Kiểm định thiết kế
      ],
      [
        'task_group_id' => 5,
        'name' => '報告書確認' // Check báo cáo
      ],
      [
        'task_group_id' => 5,
        'name' => '新規発行' // Phát hành mới
      ],
      [
        'task_group_id' => 5,
        'name' => '解析' // Phân tích
      ],
      [
        'task_group_id' => 6,
        'name' => 'マップ拡販', // Bán bản đồ
      ],
      [
        'task_group_id' => 7,
        'name' => 'セミナー集客', // Khách tham dự seminar
      ],
      [
        'task_group_id' => 8,
        'name' => 'BIM動画', // VR BIM
      ],
      [
        'task_group_id' => 9,
        'name' => '調査補償',
      ],
      [
        'task_group_id' => 10,
        'name' => '新築申込', // Đơn hàng xây mới
      ],
      [
        'task_group_id' => 11,
        'name' => 'リフォーム申込', // Đơn hàng reform
      ],
      [
        'task_group_id' => 12,
        'name' => '調査・微動',
      ]
    ];
    DB::table('task_types')->insert($taskTypes);
  }
}
