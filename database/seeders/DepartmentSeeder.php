<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $data =  array(
      array(
        'name' => '地盤事業本部', // Bộ phận Kinh doanh Địa chất
        'manager_id' => 1,
        '_lft' => 2,
        '_rgt' => 13,
        'parent_id' => null,
        'created_by' => 1,
        'created_at'    => Carbon::now(),
        'updated_at'    => Carbon::now()
      ),
      array(
        'name' => '北海道・東北支社', // Hokkaido - Tohoku
        'manager_id' => 2,
        '_lft' => 3,
        '_rgt' => 4,
        'parent_id' => 1,
        'created_by' => 1,
        'created_at'    => Carbon::now(),
        'updated_at'    => Carbon::now()
      ),
      array(
        'name' => '東京支社', // Tokyo
        'manager_id' => 3,
        '_lft' => 5,
        '_rgt' => 6,
        'parent_id' => 1,
        'created_by' => 1,
        'created_at'    => Carbon::now(),
        'updated_at'    => Carbon::now()
      ),
      array(
        'name' => '関西支社', // Kansai
        'manager_id' => 4,
        '_lft' => 7,
        '_rgt' => 8,
        'parent_id' => 1,
        'created_by' => 1,
        'created_at'    => Carbon::now(),
        'updated_at'    => Carbon::now()
      ),
      array(
        'name' => '九州支社', // Kyushu
        'manager_id' => 5,
        '_lft' => 9,
        '_rgt' => 10,
        'parent_id' => 1,
        'created_by' => 1,
        'created_at'    => Carbon::now(),
        'updated_at'    => Carbon::now()
      ),
      array(
        'name' => 'FC運営', // FC
        'manager_id' => 6,
        '_lft' => 11,
        '_rgt' => 12,
        'parent_id' => 1,
        'created_by' => 1,
        'created_at'    => Carbon::now(),
        'updated_at'    => Carbon::now()
      ),
      array(
        'name' => '住宅DX推進部', // Bộ phận Thúc đẩy DX Nhà ở
        'manager_id' => 7,
        '_lft' => 14,
        '_rgt' => 15,
        'parent_id' => null,
        'created_by' => 1,
        'created_at'    => Carbon::now(),
        'updated_at'    => Carbon::now()
      ),
      array(
        'name' => 'JIBANGOO推進部', // Bộ phận Thúc đẩy JIBANGOO
        'manager_id' => 8,
        '_lft' => 16,
        '_rgt' => 17,
        'parent_id' => null,
        'created_by' => 1,
        'created_at'    => Carbon::now(),
        'updated_at'    => Carbon::now()
      ),
      array(
        'name' => '営業サポート部', // Bộ phận hỗ trợ Kinh doanh
        'manager_id' => 9,
        '_lft' => 18,
        '_rgt' => 15,
        'parent_id' => null,
        'created_by' => 1,
        'created_at'    => Carbon::now(),
        'updated_at'    => Carbon::now()
      ),
      array(
        'name' => '営業サポート', // Hỗ trợ Kinh doanh
        'manager_id' => 10,
        '_lft' => 19,
        '_rgt' => 20,
        'parent_id' => 9,
        'created_by' => 1,
        'created_at'    => Carbon::now(),
        'updated_at'    => Carbon::now()
      ),
      array(
        'name' => '解析', // Phân tích
        'manager_id' => 11,
        '_lft' => 21,
        '_rgt' => 22,
        'parent_id' => 9,
        'created_by' => 1,
        'created_at'    => Carbon::now(),
        'updated_at'    => Carbon::now()
      ),
      array(
        'name' => 'カスタマーサポート', // Hỗ trợ khách hàng
        'manager_id' => 12,
        '_lft' => 23,
        '_rgt' => 24,
        'parent_id' => 9,
        'created_by' => 1,
        'created_at'    => Carbon::now(),
        'updated_at'    => Carbon::now()
      ),
    );

    DB::table('departments')->insert($data);
  }
}
