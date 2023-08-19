<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailVerifyController extends Controller
{
    public function index(){
        return view('email.verifyMail');
    }

    public function sendMail(Request $request){
        $email= Auth()->user()->email;

        if($email!=$request->email){
            return redirect()->back()->with('error',"Your email not matched. Please enter email registered in your account.");
        }
        $data['email']=$email;
        $sent=Mail::send('emailVerifyMail',$data,function($message) use($data){
            $message->to($data['email']);
            $message->subject("Verify email");
        });

        if($sent){
            return redirect()->back()->with('success',"We sent an mail to your email. Please check your email to verify your email.");
        }

    }

    public function verify($id){
        $user=User::where('id',$id)->first();


        $user->update([
            'email_verified_at'=>now(),
        ]);

        return redirect()->route('home')->with('success',"Your email verified successfully.");
    }
}
