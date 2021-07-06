<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $this->call([
        DepartmentSeeder::class,
        UserSeeder::class,
        RolePermissionSeeder::class,
        SaleStatusSeeder::class,
        NegotiationStatusSeeder::class,
        NegotiationResultStatusSeeder::class,
        AccuraciesSeeder::class,
        TaskGroupsSeeder::class,
        TaskTypesSeeder::class,
        FieldsSeeder::class,
        CustomerSeeder::class,
        CompanionSeeder::class,
        TaskSeeder::class,
        TaskProgressSeeder::class,
        ReportSeeder::class
      ]);
    }
}
