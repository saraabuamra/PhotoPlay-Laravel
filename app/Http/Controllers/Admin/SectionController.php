<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use function PHPUnit\Framework\isEmpty;

class SectionController extends Controller
{
    public function sections(){
        Session::put('page','sections');
        $sections = Section::get()->toArray();
        //dd($sections);
        return view('admin.sections.sections')->with(compact('sections'));
    }


       public function deleteSection($id){
          Section::destroy($id);
         return redirect()->back()->with('success_message','Section has been deleted successfully');
       }


       public function addEditSection(Request $request,$id=null){
        Session::put('page','sections');
        if($id==""){
        $title = "Add Section";
        $section = new Section;
        $message = "Section added successfully!";
        }else{
            $title = "Edit Section";
            $section = Section::find($id);
            $message = "Section updated successfully!"; 
        }
        if($request->isMethod('post')){
            $data = $request->all();
            $validated = $request->validate([
                'section_name' => 'required|regex:/^[\pL\s\-]+$/u|unique:sections,name',
            ]);
            $section->name = $data['section_name'];
            $section->save();

            return redirect('admin/sections')->with('success_message',$message);
        }
        return view('admin.sections.add_edit_section')->with(compact('title','section','message'));
       }
}
