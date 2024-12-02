<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\FileUploadTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use FileUploadTraits;
    public function Index(){
        return view('frontend.index');
    }
    public function ProfileStore(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email']
        ]);
        $id = Auth::guard('web')->id();
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        if ($request->hasFile('photo')) {
            $data->photo = $this->updateFile($request, 'photo', 'client/photo', $data->photo);
        }
        $data->save();
        $notification = [
            'message' => 'Profile updated successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }
    public function UserLogout(Request $request){
        Auth::guard('web')->logout();
        return redirect()->route('login')->with('success', 'Logout Successfully');
    }
    public function ChangePassword(){
        return view('frontend.dashboard.changer_password');
    }
    public function UserPasswordUpdate(Request $request){
        $client = Auth::guard('web')->user();
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);
        if (!Hash::check($request->old_password, $client->password)) {
            $notification = [
                'message' => 'Old Password does not match',
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }
        User::whereId($client->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        $notification = [
            'message' => 'Password updated successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }
}

