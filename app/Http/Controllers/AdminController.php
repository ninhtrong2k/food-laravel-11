<?php

namespace App\Http\Controllers;

use App\Mail\WebsiteEmail;
use App\Models\Admin;
use App\Traits\FileUploadTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    use FileUploadTraits;
    public function AdminLogin()
    {
        return view('admin.login');
    }
    public function AdminDashboard()
    {
        return view('admin.index');
    }
    public function AdminLoginSubmit(Request $request)
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
        if (Auth::guard('admin')->attempt($data)) {
            return redirect()->route('admin.dashboard')->with('success', 'Login Successfully');
        } else {
            return redirect()->route('admin.login')->with('error', 'Login Failure');
        }
    }
    public function AdminLogout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success', 'Logout Successfully');
    }
    public function AdminForgetPassword()
    {
        return view('admin.forgot_password');
    }
    public function AdminPasswordSubmit(Request $request)
    {
        $request->validate(
            [
                'email' => ['required', 'email'],
            ]
        );
        $admin_data = Admin::where('email', $request->email)->first();
        if (!$admin_data) {
            return redirect()->route('admin.forgot_password')->with('error', 'Email not found');
        }
        $token = hash('sha256', time());
        $admin_data->token = $token;
        $admin_data->save();
        $reset_link = url('admin/reset-password/' . $token . '/' . $request->email);
        $subject = "Reset Password";
        $message = "Please Click on below link to reset password <hr>";
        $message .= '<a href="' . $reset_link . '">Click Here</a>';
        Mail::to($request->email)->send(new WebsiteEmail($subject, $message));
        return redirect()->route('admin.login')->with('success', 'Reset Password Link sent to your email');
    }
    public function AdminResetPassword($token, $email)
    {
        $admin_data = Admin::where('email', $email)->where('token', $token)->first();
        if (!$admin_data) {
            return redirect()->route('admin.login')->with('error', 'Invalid Token or Email');
        }
        return view('admin.reset_password', compact('token', 'email'));
    }
    public function AdminResetPasswordSubmit(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);
        $admin_data = Admin::where('email', $request->email)->where('token', $request->token)->first();
        if (!$admin_data) {
            return redirect()->route('admin.login')->with('error', 'Invalid Token or Email');
        }
        $admin_data->password =  Hash::make($request->password);
        $admin_data->token = null;
        $admin_data->save();
        return redirect()->route('admin.login')->with('success', 'Password Reset Successfully');
    }
    public function AdminProfile()
    {
        $id = Auth::guard('admin')->id();
        $profileData = Admin::find($id);
        if (!$profileData) {
            abort('404', 'Profile not found');
        }
        return view('admin.admin_profile', compact('profileData'));
    }
    public function AdminProfileStore(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email']
        ]);
        $id = Auth::guard('admin')->id();
        $data = Admin::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        if ($request->hasFile('photo')) {
            $data->photo = $this->updateFile($request, 'photo', 'admin/photo', $data->photo);
        }
        $data->save();
        $notification = [
            'message' => 'Profile updated successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }
    public function AdminChangePassword()
    {
        $id = Auth::guard('admin')->id();
        $profileData = Admin::find($id);
        if (!$profileData) {
            abort('404', 'Profile not found');
        }
        return view('admin.admin_change_password', compact('profileData'));
    }
    public function AdminPasswordUpdate(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);
        if (!Hash::check($request->old_password, $admin->password)) {
            $notification = [
                'message' => 'Old Password does not match',
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }
        Admin::whereId($admin->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        $notification = [
            'message' => 'Password updated successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }
}
