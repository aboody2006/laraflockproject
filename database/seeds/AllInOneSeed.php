<?php

use Illuminate\Database\Seeder;

class AllInOneSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CreateMasterPermissionTableSeeder::class);
        $this->call(DeleteMasterPermissionTableSeeder::class);
        $this->call(EditMasterPermissionTableSeeder::class);
        $this->call(ExportMasterPermissionTableSeeder::class);
        $this->call(ImportMasterPermissionTableSeeder::class);
        $this->call(ViewMasterPermissionTableSeeder::class);
    }
}
