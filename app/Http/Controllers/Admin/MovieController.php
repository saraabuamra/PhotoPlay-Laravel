<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Section;
use App\Models\SectionMovie;
use App\Models\User;
use App\Notifications\NewMovieNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class MovieController extends Controller
{
      public function movies(){
        Session::put('page','movies');
        $movies = Movie::with('sections')->get()->toArray();
        //dd($movies);
          return view('admin.movies.movies')->with(compact('movies'));
        }
  
      public function updateMovieStatus(Request $request){
        if($request->ajax()){
           $data = $request->all();
           if($data['status']=="Active"){
               $status = 0;
           }else{
               $status = 1;
           }
           Movie::where('id',$data['movie_id'])->update(['status'=>$status]);
           return response()->json(['status'=>$status,'movie_id'=>$data['movie_id']]);
        }
       }
  
      public function deleteMovie($id){
       $movie = Movie::findOrFail($id);
       $movie->delete($movie);
       return redirect()->back()->with('success_message','Movie has been deleted successfully');
     }
  


    public function addEditMovie(Request $request,$id=null){
      Session::put('page','movies');
       // Define $selectedSections as an empty array initially
       $selectedSections = [];
       if(empty($id)){
        $title = "Add Movie";
        $movie = new Movie;
        $message = "Movie added successfully!";
       }else{
        $title = "Edit Movie";
        $movie = Movie::find($id);
        $message = "Movie updated successfully!";
        if (!$movie) {
          // Handle the case where the movie with the given ID was not found
          abort(404);
      }
        // Get the IDs of the sections associated with the movie
        $selectedSections = $movie->sections->pluck('id')->toArray(); 
       }
  
       if($request->isMethod('post')){
          $data = $request->all();
  
          $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sections' => 'required|array', // Assuming sections are sent as an array
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ],
          [
            'sections.required' => 'At least one section must be selected!',
          ]
        );
         //uplode movie image 
         if($request->hasFile('image')){
          $image_tmp = $request->file('image');
          if($image_tmp->isValid()){
              //Get Image Extention
              $extention = $image_tmp->getClientOriginalExtension();
              //Generate New Image Name
              $imageName = rand(111,99999).'.'.$extention;
              $ImagePath = 'admin/images/movie_images/'.$imageName;
  
              //upload the images 
              Image::make($image_tmp)->save($ImagePath);
  
              //insert image name in movie table
              $movie->image = $imageName;
          }
        }
        // Update movie attributes
        $movie->name = $data['name'];
        $movie->description = $data['description'];
        $movie->status = 1;
        $movie->save();

        // Sync sections
        $sectionIds = $request->input('sections',[]);
        $sections = Section::whereIn('id', $sectionIds)->get();
        $movie->sections()->sync($sections);
        //dd($sections);

         // Send the new movie notification to all users
        $users = User::all(); // Get all users or customize as needed
        Notification::send($users, new NewMovieNotification($movie));
        

      return redirect('admin/movies')->with('success_message',$message);
       }
      // Fetch all sections for the select input
       $sections = Section::get()->toArray();
      //dd($selectedSections);
      
       return view('admin.movies.add_edit_movie')->with(compact('title','sections','movie','selectedSections'));
  }



  
     public function deleteMovieImage($id){
      //get movie image
      $movieImage = Movie::select('image')->where('id',$id)->first();
  
      //get movie image path
      $image_path = 'admin/images/movie_images/';
  
      //delete movie small image from small folder if exists
      if(file_exists($image_path.$movieImage->image)){
          unlink($image_path.$movieImage->image);
      }
      //delete movie image from movies folder 
      Movie::where('id',$id)->update(['image'=>'']);
  
     return redirect()->back()->with('success_message','Movie Image has been deleted successfully');
   }
  
  
  
   
  
}
