<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Traits\FileUploadTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    use FileUploadTraits;
    public function ClientLogin()
    {
        return view('client.client_login');
    }
    public function ClientRegister()
    {
        return view('client.client_register');
    }
    public function ClientRegisterSubmit(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:200'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
        Client::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'role' => 'client',
            'status' => '0',
        ]);
        $notification = [
            'message' => 'Client Register Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('client.login')->with($notification);
    }
    public function ClientLoginSubmit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $check = $request->all();
        $data = [
            'email' => $check['email'],
            'password' => $check['password'],
        ];
        if (Auth::guard('client')->attempt($data)) {
            return redirect()->route('client.dashboard')->with('success', 'Login Successfully');
        } else {
            return redirect()->route('client.login')->with('error', 'Login Failure');
        }
    }
    public function ClientDashboard(){
        return view('client.index');
    }
    public function ClientLogout()
    {
        Auth::guard('client')->logout();
        return redirect()->route('client.login')->with('success', 'Logout Successfully');
    }
    public function ClientProfile()
    {
        $id = Auth::guard('client')->id();
        $profileData = Client::find($id);
        if (!$profileData) {
            abort('404', 'Profile not found');
        }
        return view('client.client_profile', compact('profileData'));
    }
    public function ClientProfileStore(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email']
        ]);
        $id = Auth::guard('client')->id();
        $data = Client::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        if ($request->hasFile('photo')) {
            $data->photo = $this->updateFile($request, 'photo', 'user/photo', $data->photo);
        }
        $data->save();
        $notification = [
            'message' => 'Profile updated successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }
    public function ClientChangePassword(){
        $id = Auth::guard('client')->id();
        $profileData = Client::find($id);
        if (!$profileData) {
            abort('404', 'Profile not found');
        }
        return view('client.client_change_password', compact('profileData'));
    }
    public function ClientPasswordUpdate(Request $request){
        $client = Auth::guard('client')->user();
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
        Client::whereId($client->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        $notification = [
            'message' => 'Password updated successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }
}
