<?php

namespace App\Http\Controllers;

use App\News;
use App\User;
use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    function index(){
        $result = News::orderBy('id','desc')->get();

        return view('user.home')->with('data',$result);
    }
    function contact_page(){
        return view('user.contact');
    }
    function user_profile(){
        $id = auth()->user()->id;
        $data = User::FindOrFail($id);

        return view('user.user_profile')->with('data',$data);
    }

    //create news
    function insert_news(Request $request){
        
        $validator = Validator::make($request->all(), [
            'new_title' => 'required',
            'new_photo' => 'required',
            'new_content' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('user_profile')
                        ->withErrors($validator)
                        ->withInput();
        }

        $file = $request->file('new_photo');
        $filename = uniqid()."_".$file->getClientOriginalName(); 
        $file->move(public_path().'/photos/',$filename);
        $data = [
             'user_id' => $request->user_id,
             'new_title' => $request->new_title,
             'new_photo' => $filename,
             'new_content' => $request->new_content
         ];
         News::create($data);

        return back()->with('success','Insert Success!');
    }
    //create Contact
    function insert_contact(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('contact_page')
                        ->withErrors($validator)
                        ->withInput();
        }

        $data = [
            'name' =>$request->name,
            'email' =>$request->email,
            'message' =>$request->message

        ];
        Contact::create($data);
        return back()->with('success','Contact Success!');
    }

    //Look New Info
    function look_newInfo($id){
       $result = DB::table('news')
                ->join('users','users.id','=','news.user_id')
                ->where('news.id','=',$id)
                ->select('users.*','news.*','users.id as user_ID','news.id as news_ID')
                ->get();
       return view('user.look_newInfo')->with('data',$result);
    }

    //delete News
    function delete_news($id){
        News::FindOrFail($id)->delete();
        return redirect()->route('user_homepage')->with('delete','Delete Success');
    }
    //update News
    function update_news(Request $request){
        $id = $request->id;

        $validator = Validator::make($request->all(), [
            'new_title' => 'required',
            'new_photo' => 'required',
            'new_content' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('look_newInfo/'.$id)
                        ->withErrors($validator)
                        ->withInput();
        }

        $file = $request->file('new_photo');
        $filename = uniqid()."_".$file->getClientOriginalName();
        $file->move(public_path().'/photos/',$filename);

        $data = [
            'new_title' => $request->new_title,
            'new_photo' => $filename,
            'new_content' => $request->new_content
        ];
        
        News::FindOrFail($id)->update($data);
        return back()->with('update','Update Success!');
    }

    //update Account Info
    function update_account(Request $request){
        $id = $request->user_id;
        $data = [
            'name' => $request->name,
            'email' => $request->email
        ];
        User::FindOrFail($id)->update($data);
        return back()->with('update_success','Update successfully!');
    }

    //change password
    function change_password(Request $request){
        $id = auth()->user()->id;
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $old_password = $request->old_password;
        $new_password = $request->new_password;
        $confirm_password = $request->confirm_password;

        $data = User::FindOrFail($id);
        if(!Hash::check($old_password,$data->password)){
            return back()->with('password','Old Password Is Wrong!!');
        }
        else if(!(strlen($new_password) >= 8 && strlen($confirm_password) >= 8)){
            return back()->with('password','Length must be at least 8!!');
        }
        else if(!($new_password == $confirm_password)){
            return back()->with('password','Passwords are different!!');
        }
        else{
            $hash_password = Hash::make($new_password);
            $pass = [
                'password' =>$hash_password
            ];
            User::FindOrFail($id)->update($pass);
            return back()->with('password_success','Password change Successfully!');
        }
    }
}