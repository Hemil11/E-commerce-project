<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\mailSend;
use App\Jobs\SendMailJob;
use App\Mail\ForgotPasswordMail;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\userDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class Logincontroller extends Controller
{
    // welcome page
    public function welcome(Request $request)
    {
        return view("welcome");
    }
    // login page show
    public function login_form(Request $request)
    {

        if (Auth::check()) {
            return redirect('/feedback');
        }
        return view('login');
    }
    // login 
    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        if (!Auth::attempt(['email' => $email, 'password' => $password])) {
            $request->session()->regenerate();
            return back();
        }
        if (Auth::user()->user_type == 1) {
            return redirect('admin/index');
        }
        return redirect('user/index');
    }
    // user index page 
    public function userIndex(Request $request)
    {
        $categories = Category::all();
        $products = Product::all();
        return view('user.dashboard', compact('categories', 'products'));
    }

    // Admin index page 
    public function adminIndex(Request $request)
    {
        $pagetitle = session('title');
        return view('dashboard', compact('pagetitle'));
    }

    // register page show 
    public function register_form(Request $request)
    {
        return view('register');
    }
    // register new user
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'unique:users,email|required',
            'password' => 'required',
            'mo_no' => 'required',
            'gender' => 'required',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->gender = $request->gender;
        $user->mo_no = $request->mo_no;
        $user->save();
        $userdetails = new userDetails;
        $userdetails->user_id = $user->id;
        $userdetails->save();

        return redirect('/');
    }

    // logout user
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }

    // feedback by user
    public function feedback(Request $request)
    {
        return view("feedback");
    }
    public function forgetPasswordpage (Request $request)
    {
        return view("forget-password");
    }

    public function forgetPassword(Request $request)
    {
        // Generate a random OTP
        $otp = rand(100000, 999999);

        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->otp = $otp;
            $user->save();

            $details = [
                'email' => $request->email,
                'otp' => $otp,
            ];

            try {
                Mail::to("hemilsojitra69@gmail.com")->send(new ForgotPasswordMail($details));
                Log::alert('mail sent successfully');
            } catch (\Exception $e) {
                // Log or handle the error appropriately
                Log::alert($e->getMessage());
                return redirect()->back()->with('error', 'Failed to send email. Please try again.');
            }

            return redirect()->route('login');
        } else {
            return redirect()->back()->with('error', 'User not found');
        }
    }

    public function changePasswordPage(Request $request)
    {
        $email = $request->email;
        return view('change-password',compact('email'));
    }

    public function changePassword(Request $request)
    {
        $email = $request->email;
        $user = User::where('email', $email)->first();
        if ($user) {    
            // Update the user's password
            $user->password = Hash::make($request->password);
            $user->save();
            
            // Redirect to a success page or login page
            return redirect()->route('login')->with('success', 'Password changed successfully. Please login.');
        } else {
            // Redirect back with an error if the user is not found
            return redirect()->route('forget.password.page')->with('error', 'User not found');
        }
    }

}