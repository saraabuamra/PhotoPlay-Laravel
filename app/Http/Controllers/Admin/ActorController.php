<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Actor;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class ActorController extends Controller
{
    
      public function actors(){
        Session::put('page','actors');
        $actors = Actor::with('movies')->get()->toArray();
        //dd($actors);
          return view('admin.actors.actors')->with(compact('actors'));
        }
  
      public function updateActorStatus(Request $request){
        if($request->ajax()){
           $data = $request->all();
           if($data['status']=="Active"){
               $status = 0;
           }else{
               $status = 1;
           }
           Actor::where('id',$data['actor_id'])->update(['status'=>$status]);
           return response()->json(['status'=>$status,'actor_id'=>$data['actor_id']]);
        }
       }
  
      public function deleteActor($id){
       $actor = Actor::findOrFail($id);
       $actor->delete($actor);
       return redirect()->back()->with('success_message','Actor has been deleted successfully');
     }
  


    public function addEditActor(Request $request,$id=null){
      Session::put('page','actors');
      // Define $selectedMovies as an empty array initially
      $selectedMovies = [];
       if(empty($id)){
        $title = "Add Actor";
        $actor = new Actor;
        $message = "Actor added successfully!";
       }else{
        $title = "Edit Actor";
        $actor = Actor::find($id);
        $message = "Actor updated successfully!";
        if (!$actor) {
          // Handle the case where the movie with the given ID was not found
          abort(404);
       }
        // Get the IDs of the movies associated with the actor
        $selectedMovies = $actor->movies->pluck('id')->toArray(); 
       }
  
       if($request->isMethod('post')){
          $data = $request->all();
  
          $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'movies' => 'required|array',// Assuming movies are sent as an array
            'biography' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ],
        [
          'movies.required' => 'At least one movie must be selected!',
        ]);
         //uplode actor image 
         if($request->hasFile('image')){
          $image_tmp = $request->file('image');
          if($image_tmp->isValid()){
              //Get Image Extention
              $extention = $image_tmp->getClientOriginalExtension();
              //Generate New Image Name
              $imageName = rand(111,99999).'.'.$extention;
              $ImagePath = 'admin/images/actor_images/'.$imageName;
  
              //upload the images 
              Image::make($image_tmp)->save($ImagePath);
  
              //insert image name in actor table
              $actor->image = $imageName;
          }
        }
        // Update actor attributes
        $actor->firstname = $data['firstname'];
        $actor->lastname = $data['lastname'];
        $actor->biography = $data['biography'];
        $actor->status = 1;
        $actor->save();

        // Sync movies
        $movieIds = $request->input('movies');
        $movies = Movie::whereIn('id', $movieIds)->get();
        $actor->movies()->sync($movies);
        //dd($sections);

      return redirect('admin/actors')->with('success_message',$message);
       }
      // Fetch all movies for the select input
       $movies = Movie::get()->toArray();
      // dd($movies);
       return view('admin.actors.add_edit_actor')->with(compact('title','movies','actor','selectedMovies'));
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
