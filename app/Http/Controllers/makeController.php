<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class makeController extends Controller
{
    public function index(){
    	return view('listitem');
    }
    public function store(Request $request){

   		$data = array();
   		$data['name']=$request->name;
   		

		$category = DB::table('ajax')->insert($data);
		if ($category) {
			Session::flash('success','Data successfully inserted!');
			return Redirect()->route('listitem');
		}
		else{
			Session::flash('error','Data Not inserted!');
		}
}

  public function Allread(){
     $category=DB::table('ajax')->get();

    return view('listitem',compact('category'));
      	

 
 }

 public function delete($id){
     	$category=DB::table('ajax')->where('id',$id)->delete();
     if ($category) {
			Session::flash('success','Data successfully Deleted!');
			return Redirect()->route('listitem');
		}
		else{
			Session::flash('error','Data Not Deleted!');
            return redirect()->back();
		}
}
 //update
   public function update($id){

     $category=DB::table('ajax')->where('id',$id)->first();
   return view('listitem',compact('category')); 
  	
  }

  //edit data
     public function Edit(Request $request,$id)
     {  
     
        $data = array();
      $data['name']=$request->name;
    $category = DB::table('ajax')->where('id',$id)->update($data);
    if ($category) {
      Session::flash('success','Data successfully Updated!');
      return Redirect()->route('listitem');
    }
    else{
      Session::flash('error','Data Not Updated!');
      return redirect()->back();
    }

 
    
  }











 
}