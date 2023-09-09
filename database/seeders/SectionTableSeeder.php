<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sectionRecords = [
            [
                'id'=>1,
                'name'=>'Movie',
                'status'=>1,
            ], 
            [
                'id'=>2,
                'name'=>'Adventure',
                'status'=>1,
            ],
            [
                'id'=>3,
                'name'=>'Comedy',
                'status'=>1,
            ],[
                'id'=>4,
                'name'=>'Family',
                'status'=>1,
            ]
        ];
        Section::insert($sectionRecords);
    }
}
