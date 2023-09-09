<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EpisodeController extends Controller
{
    public function episodes(){
        Session::put('page','episodes');
        $episodes = Episode::with('movie')->get()->toArray();
        $movies = Movie::where('status',1)->with('episodes')->get()->toArray();
        //dd($movies);
        return view('admin.episodes.episodes')->with(compact('episodes','movies'));
    }

    public function updateEpisodeStatus(Request $request){
        if($request->ajax()){
           $data = $request->all();
           if($data['status']=="Active"){
               $status = 0;
           }else{
               $status = 1;
           }
           Episode::where('id',$data['episode_id'])->update(['status'=>$status]);
           return response()->json(['status'=>$status,'episode_id'=>$data['episode_id']]);
        }
       }

       public function deleteEpisode($id){
        Episode::destroy($id);
        return redirect()->back()->with('success_message','Episode has been deleted successfully');
       }


       public function addEditEpisode(Request $request,$id=null){
        Session::put('page','episodes');
        if($id==""){
        $title = "Add Episode";
        $episode = new Episode;
        $message = "Episode added successfully!";
        }else{
            $title = "Edit Episode";
            $episode = Episode::find($id);
            $message = "Episode updated successfully!"; 
        }
        if($request->isMethod('post')){
            $data = $request->all();
            $validated = $request->validate([
                'title' => 'required|string',
                'movie_id'=>'required',
                // 'write_path'=>'unique:episodes,external_video',
            ],
             [
                'movie_id.required' => 'Select Movie is required !',
             ]
             );
            //uplode Episode video
            if($request->hasFile('video')){
            $video_tmp = $request->file('video');
            if($video_tmp->isValid()){
                //uplode video in videos folder
                $extention = $video_tmp->getClientOriginalExtension();
                $videoName =  rand(111,99999).'.'.$extention;
                $videoPath = 'admin/videos/movie_videos/';
                $video_tmp->move($videoPath,$videoName);
                //insert video name in episodes table
                $episode->video = $videoName;
            }
            }
            $episode->movie_id = $data['movie_id'];
            $episode->title = $data['title'];
            $episode->external_video = $data['write_path'];
            $episode->runtime = $data['runtime'];
            $episode->status = 1;
            $episode->save();

            return redirect('admin/episodes')->with('success_message',$message);
        }
         $movies = Movie::where('status',1)->get()->toArray();
        //dd($movies);
        return view('admin.episodes.add_edit_episode')->with(compact('title','episode','message','movies'));
       }

       public function deleteEpisodeVideo($id){
        //get episode video
        $episodeVideo = Episode::select('video')->where('id',$id)->first();
      
        //get episode video path
        $episode_video_path = 'admin/videos/movie_videos/';
      
        //delete episode video from movie_videos folder if exists
        if(file_exists($episode_video_path.$episodeVideo->video)){
            unlink($episode_video_path.$episodeVideo->video);
        }
        //delete episode video from episodes folder 
        Episode::where('id',$id)->update(['video'=>'']);
      
       return redirect()->back()->with('success_message','Episode Video has been deleted successfully');
      }
}
