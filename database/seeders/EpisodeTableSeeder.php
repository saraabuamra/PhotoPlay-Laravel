<?php

namespace Database\Seeders;

use App\Models\Episode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EpisodeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $episodeRecords = [
            [
                'id'=>1,
                'name'=>'The Kingpin Strategy',
                'runtime'=>'54 min',
                'status'=>1,
                'video'=>'admin/videos/movie_videos/video.mp4'
            ], 
            [
                'id'=>2,
                'name'=>'The Cali KBG',
                'runtime'=>'54 min',
                'status'=>1,
                'video'=>'admin/videos/movie_videos/video.mp4'
            ],
        ];
        Episode::insert($episodeRecords);
    }
}
