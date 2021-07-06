<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FieldsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fields')->insert([
            'name' => 'ビルダーフラグ',
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);
        DB::table('fields')->insert([
            'name' => 'FCフラグ',
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);
        DB::table('fields')->insert([
            'name' => '取次店フラグ',
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);
        DB::table('fields')->insert([
            'name' => '調査会社フラグ',
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);
        DB::table('fields')->insert([
            'name' => '工事会社フラグ',
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);
        DB::table('fields')->insert([
            'name' => '一般業者フラグ',
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);
    }
}
