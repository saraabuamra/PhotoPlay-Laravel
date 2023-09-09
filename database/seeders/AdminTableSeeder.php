<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRecords = [
            [
               'id'=>1,
               'name'=>'Sara',
               'mobile'=>'0595789861',
               'email'=>'sara@admin.com',
               'password'=> Hash::make('12345678'),
               'image'=>'',
               'status'=>0
            ],
           ];
           Admin::insert($adminRecords);
    }
}
