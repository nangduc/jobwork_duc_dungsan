<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $companions = [
      [
        'name' => 'Nguyen Van Anh'
      ],
      [
        'name' => 'Nguyen Thi Ngoc Bich'
      ],
      [
        'name' => 'Nguyen Thi Ngoc Qui'
      ],
      [
        'name' => 'Tran Thi Hong Tranh'
      ],
      [
        'name' => 'Le Thi Truc Linh'
      ],
      [
        'name' => 'Phạm Văn Hiểu'
      ],
      [
        'name' => 'Le Nguyen Dang Khoa'
      ],
      [
        'name' => 'Nguyen Ngoc An'
      ],
      [
        'name' => 'Nguyen Thanh Tung'
      ],
      [
        'name' => 'Tran Thi Da Thao'
      ],
      [
        'name' => 'Pham Thi Ut Thao'
      ],
      [
        'name' => 'Tran An Bich Thuan '
      ],
      [
        'name' => 'Nguyen Thi Thai Nhung'
      ],
      [
        'name' => 'Nguyen Thi Hien'
      ],
      [
        'name' => 'Ly Thi Ngoc Truc '
      ],
      [
        'name' => 'Phan Thi Cam Giang'
      ],
      [
        'name' => 'Tran Hoang Ly'
      ],
      [
        'name' => 'Nguyen Phuong Hong An'
      ],
      [
        'name' => 'Nguyen Anh  Tu'
      ],
      [
        'name' => 'Le Thi Thao Quyen'
      ],
      [
        'name' => 'Nguyen Thi Phuong Nhi'
      ],
      [
        'name' => 'Tran Quynh Tram'
      ],
      [
        'name' => 'Nguyen thi Huyen Trang'
      ],
      [
        'name' => 'Bui Thanh Binh'
      ],
      [
        'name' => 'Dang Phuoc Linh'
      ],
      [
        'name' => 'Le Thi Ngoc Tu'
      ],
      [
        'name' => 'Nguyen Thi Dieu'
      ],
      [
        'name' => 'Nguyen Thị Thảo Quyên'
      ],
      [
        'name' => 'Nguyễn Thị Tuyết Minh'
      ],
      [
        'name' => 'Nguyễn Thị Kim Chi'
      ],
      [
        'name' => 'Nguyễn Nghĩa Nhật'
      ],
      [
        'name' => 'Pham Thi Thanh Huyền'
      ],
      [
        'name' => 'Võ văn Xuân Sơn'
      ],
      [
        'name' => 'Lê Thị Đan Phượng'
      ],
      [
        'name' => 'Nguyễn Thị Hằng Nga'
      ],
      [
        'name' => 'Hồ Thị Ngọc Ánh'
      ]
    ];

    DB::table('companions')->insert($companions);
  }
}
