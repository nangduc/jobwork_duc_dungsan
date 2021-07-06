<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $users = [
      [
        'department_id' => 2,
        'name'          => 'Admin',
        'username'      => 'admin',
        'email'         => 'admin@gmail.com',
        'phone'         => '0123456789',
        'job_title'     => 'Owner',
        'password'      => bcrypt('123123'),
        'avatar'        => 'avatar-admin.jpg',
        'active'        => true,
        'created_by'    => null,
        'created_at'    => Carbon::now(),
        'updated_at'    => Carbon::now()
      ],
      [
        'department_id' => 2,
        'name'          => '住宅事業部チーム',
        'username'      => 'kstuna',
        'email'         => 'kstuna@gmail.com',
        'phone'         => '',
        'job_title'     => 'Leader',
        'password'      => bcrypt('123123'),
        'avatar'        => 'avatar-admin.jpg',
        'active'        => true,
        'created_by'    => 1,
        'created_at'    => Carbon::now(),
        'updated_at'    => Carbon::now()
      ],
      [
        'department_id' => 2,
        'name'          => 'FREEDOMのチーム',
        'username'      => 'ly',
        'email'         => 'ly@gmail.com',
        'phone'         => '0905123456',
        'job_title'     => 'Leader',
        'password'      => bcrypt('123123'),
        'avatar'        => null,
        'active'        => true,
        'created_by'    => 1,
        'created_at'    => Carbon::now(),
        'updated_at'    => Carbon::now()
      ],
      [
        'department_id' => 2,
        'name'          => '経理チーム経理チーム',
        'username'      => 'minh',
        'email'         => 'minh@gmail.com',
        'phone'         => '0905246357',
        'job_title'     => 'Leader',
        'password'      => bcrypt('123123'),
        'avatar'        => 'avatar-member.jpg',
        'active'        => true,
        'created_by'    => 1,
        'created_at'    => Carbon::now(),
        'updated_at'    => Carbon::now()
      ],
      [
        'department_id' => 3,
        'name'          => '解析チーム',
        'username'      => 'dieu',
        'email'         => 'dieu@gmail.com',
        'phone'         => '0123456780',
        'job_title'     => 'Leader',
        'password'      => bcrypt('123123'),
        'avatar'        => null,
        'active'        => true,
        'created_by'    => 1,
        'created_at'    => Carbon::now(),
        'updated_at'    => Carbon::now()
      ],
      [
        'department_id' => 3,
        'name'          => '業務チーム',
        'username'      => 'tram',
        'email'         => 'tram@gmail.com',
        'phone'         => '0123456781',
        'job_title'     => 'Leader',
        'password'      => bcrypt('123123'),
        'avatar'        => null,
        'active'        => true,
        'created_by'    => 1,
        'created_at'    => Carbon::now(),
        'updated_at'    => Carbon::now()
      ],
      [
        'department_id' => 3,
        'name'          => 'オートキャドチーム',
        'username'      => 'nhat',
        'email'         => 'nhat@gmail.com',
        'phone'         => '0123456782',
        'job_title'     => 'Leader',
        'password'      => bcrypt('123123'),
        'avatar'        => null,
        'active'        => true,
        'created_by'    => 1,
        'created_at'    => Carbon::now(),
        'updated_at'    => Carbon::now()
      ],
      [
        'department_id' => 4,
        'name'          => 'Ngọc',
        'username'      => 'ngoc',
        'email'         => 'ngoc@gmail.com',
        'phone'         => '0123456783',
        'job_title'     => 'Member',
        'password'      => bcrypt('123123'),
        'avatar'        => null,
        'active'        => true,
        'created_by'    => 1,
        'created_at'    => Carbon::now(),
        'updated_at'    => Carbon::now()
      ],
      [
        'department_id' => 4,
        'name'          => 'Phú',
        'username'      => 'phu',
        'email'         => 'phu@gmail.com',
        'phone'         => '0123456784',
        'job_title'     => 'Manager',
        'password'      => bcrypt('123123'),
        'avatar'        => null,
        'active'        => true,
        'created_by'    => 1,
        'created_at'    => Carbon::now(),
        'updated_at'    => Carbon::now()
      ],
      [
        'department_id' => 5,
        'name'          => 'Hồng Anh',
        'username'      => 'honganh',
        'email'         => 'honganh@gmail.com',
        'phone'         => '0123456785',
        'job_title'     => 'Member',
        'password'      => bcrypt('123123'),
        'avatar'        => null,
        'active'        => true,
        'created_by'    => 1,
        'created_at'    => Carbon::now(),
        'updated_at'    => Carbon::now()
      ],
      [
        'department_id' => 5,
        'name'          => 'Hoàng Anh',
        'username'      => 'hoanganh',
        'email'         => 'hoanganh@gmail.com',
        'phone'         => '0123456786',
        'job_title'     => 'Member',
        'password'      => bcrypt('123123'),
        'avatar'        => null,
        'active'        => true,
        'created_by'    => 1,
        'created_at'    => Carbon::now(),
        'updated_at'    => Carbon::now()
      ],
      [
        'department_id' => 6,
        'name'          => 'Đan Thảo',
        'username'      => 'danthao',
        'email'         => 'danthao@gmail.com',
        'phone'         => '0123456787',
        'job_title'     => 'Member',
        'password'      => bcrypt('123123'),
        'avatar'        => null,
        'active'        => true,
        'created_by'    => 1,
        'created_at'    => Carbon::now(),
        'updated_at'    => Carbon::now()
      ],
      [
        'department_id' => 6,
        'name'          => 'Thanh Lam',
        'username'      => 'thanhlam',
        'email'         => 'thanhlam@gmail.com',
        'phone'         => '0123456788',
        'job_title'     => 'Member',
        'password'      => bcrypt('123123'),
        'avatar'        => null,
        'active'        => true,
        'created_by'    => 1,
        'created_at'    => Carbon::now(),
        'updated_at'    => Carbon::now()
      ],
      [
        'department_id' => 6,
        'name'          => 'Đình Trí',
        'username'      => 'dinhtri',
        'email'         => 'dinhtri@gmail.com',
        'phone'         => '0123456798',
        'job_title'     => 'Member',
        'password'      => bcrypt('123123'),
        'avatar'        => null,
        'active'        => true,
        'created_by'    => 1,
        'created_at'    => Carbon::now(),
        'updated_at'    => Carbon::now()
      ],
      [
        'department_id' => 7,
        'name'          => 'Huyền Trang',
        'username'      => 'huyentrang',
        'email'         => 'huyentrang@gmail.com',
        'phone'         => '0123456790',
        'job_title'     => 'Member',
        'password'      => bcrypt('123123'),
        'avatar'        => null,
        'active'        => true,
        'created_by'    => 1,
        'created_at'    => Carbon::now(),
        'updated_at'    => Carbon::now()
      ],
      [
        'department_id' => 7,
        'name'          => 'Đăng Cường',
        'username'      => 'dangcuong',
        'email'         => 'dangcuong@gmail.com',
        'phone'         => '0123456791',
        'job_title'     => 'Member',
        'password'      => bcrypt('123123'),
        'avatar'        => null,
        'active'        => true,
        'created_by'    => 1,
        'created_at'    => Carbon::now(),
        'updated_at'    => Carbon::now()
      ],
      [
        'department_id' => 8,
        'name'          => 'Quang Khải',
        'username'      => 'quangkhai',
        'email'         => 'quangkhai@gmail.com',
        'phone'         => '0123456792',
        'job_title'     => 'Member',
        'password'      => bcrypt('123123'),
        'avatar'        => null,
        'active'        => true,
        'created_by'    => 1,
        'created_at'    => Carbon::now(),
        'updated_at'    => Carbon::now()
      ],
      [
        'department_id' => 8,
        'name'          => 'Thủy Cúc',
        'username'      => 'thuycuc',
        'email'         => 'thuycuc@gmail.com',
        'phone'         => '0123456793',
        'job_title'     => 'Member',
        'password'      => bcrypt('123123'),
        'avatar'        => null,
        'active'        => true,
        'created_by'    => 1,
        'created_at'    => Carbon::now(),
        'updated_at'    => Carbon::now()
      ],
      [
        'department_id' => 8,
        'name'          => 'Quang Hường',
        'username'      => 'quanghuong',
        'email'         => 'quanghuong@gmail.com',
        'phone'         => '0123456794',
        'job_title'     => 'Member',
        'password'      => bcrypt('123123'),
        'avatar'        => null,
        'active'        => true,
        'created_by'    => 1,
        'created_at'    => Carbon::now(),
        'updated_at'    => Carbon::now()
      ]
    ];

    DB::table('users')->insert($users);
  }
}
