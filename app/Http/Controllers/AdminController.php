<?php

namespace App\Http\Controllers;

use App\User;
use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index(){
        return view('admin.home');
    }
    public function admin_profile(){
        $id = auth()->user()->id;
        $data = User::FindOrFail($id);
        return view('admin.admin_profile')->with('data',$data);
    }
    public function user_account(){
        return view('admin.user_account');
    }
    public function manage_premium(){
        $data = User::get();
        return view('admin.premium_user')->with('data',$data);
    }
    public function admin_contact(){
        $result =  Contact::orderBy('id','desc')->get();
       
        return view('admin.contact')->with('data',$result);
    }

    //delete Contact
    public function delete_contact($id){
        Contact::FindOrFail($id)->delete();
        return back()->with('delete_success','Delele contact successfully');
    }

    //update Contact
    function update_contact_page($id){
        $data = Contact::FindOrFail($id);
        return view('admin.update_contact')->with('info',$data);
    }
    function update_contact(Request $request){
        $id = $request->user_id;

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('update_contact_page/'.$id)
                        ->withErrors($validator)
                        ->withInput();
        }
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ];
        Contact::FindOrFail($id)->update($data);
        return redirect()->route('admin_contact')->with('update_success','Update successfully!');
    }

    //delete user
    function delete_user($id){
        User::FindOrFail($id)->delete();
        return back()->with('delete_user','Delete user success!');
    }

    //update User page
    function update_user_page($id){
        $data = User::FindOrFail($id);
        return view('admin.update_user_page')->with('data',$data);
    }
    function update_user(Request $request){
        $id = $request->user_id;

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'isAdmin' => 'required',
            'isPremium' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('update_user_page/'.$id)
                        ->withErrors($validator)
                        ->withInput();
        }
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'isAdmin' => $request->isAdmin,
            'isPremium' => $request->isPremium
        ];
        $isAdmin = $request->isAdmin;
        $isPremium = $request->isPremium;

        if(($isAdmin == 0 || $isAdmin == 1) && ($isPremium == 0 || $isPremium == 1)){
        User::FindOrFail($id)->update($data);
        return redirect('manage_premium')->with('update_user','Update Successfully!!');
        }
        else{
            return redirect('update_user_page/'.$id)->with('validation_error','isAdmin and isPremium must be 0 or 1!!');
        }
    }

    //Update Admin info
    function update_admin_info(Request $request){
        $id = $request->id;
        $data = [
            'name' => $request->name,
            'email' => $request->email
        ];
        User::FindOrFail($id)->update($data);
        return back()->with('update_admin',' Update Admin Info Success!');
    }

    //Update Admin Password
    function update_admin_password(Request $request){
        $id = auth()->user()->id;
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('admin_profile')
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
