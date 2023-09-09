<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $movieRecords = [
            [
                'id'=>1,
                'episode_id'=>1,
                'name'=>'Dora and the lost city of gold ',
                'description'=>'Having spent most of her life exploring the jungle, nothing could prepare Dora for her most dangerous adventure yet — high school.',
                'image'=>'',
                'status'=>1,
            ], 
            [
                'id'=>2,
                'episode_id'=>2,
                'name'=>'Sara and the lost',
                'description'=>'Having spent most of her life exploring the jungle, nothing could prepare Dora for her most dangerous adventure yet — high school.',
                'image'=>'',
                'status'=>1,
            ],
        ];
        Movie::insert($movieRecords);
    }
}
