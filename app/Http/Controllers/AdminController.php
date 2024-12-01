<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $notification = ['message'=> 'User Logout Successfully','alert-type'=>'success'];

        return redirect('/login')->with($notification);
    }

    public function Profile(){
        
        $id = Auth::user()->id;
        $adminData = User::find($id);

        return view('admin.admin_profile_view',compact('adminData'));
    }

    public function EditProfile(){
        $id = Auth::user()->id;
        $editData = User::find($id);

        return view('admin.admin_profile_edit',compact('editData'));
    }

    public function storeProfile(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);

        $data->name = $request->input( 'name' );
        $data->email = $request->input( 'email' );

        if($request->file("profile_image")){
            $file = $request->file('profile_image');

            $fileName = date('Y-m-d') . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_image'),$fileName);
            $data['profile_image'] = $fileName;
        }
        $data->save();
        $notification = ['message'=> 'Admin Profile Updated Successfully','alert-type'=>'success'];
        
        return redirect()->route('admin.profile')->with($notification);
    }

    public function changePassword(){
        return view('admin.admin_change_password');
    }

    public function updatePassword(Request $request){
        $validateData = $request->validate([
            'old_password' => 'required',
            'new_password'=>'required',
            'confirm_password' => 'required|same:new_password'
        ]);

        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->old_password,$hashedPassword)){
            $user = User::find(Auth::id());
            $user->password = bcrypt($request->new_password);
            $user->save();

            session()->flash('message', 'Password Updated Successfully');
            return redirect()->back();
        }else{
            session()->flash('message', 'Old Password is not match');
            return redirect()->back();
        }
    }
}