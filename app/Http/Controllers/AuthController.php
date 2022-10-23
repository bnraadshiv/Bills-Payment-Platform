<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\ActivationMail;
use Illuminate\Http\Request;
use App\ServiceProviders\Termii;
use App\ServiceProviders\SmsClone;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Notifications\ActivationNotification;

class AuthController extends Controller
{
    //
    protected $smsClone;

    public function __construct(SmsClone $smsClone, Termii $Termii) {

        $this->smsClone = $smsClone;

        $this->Termii = $Termii;

        $this->smsservice = "termii";

    }

    public function login() {

        $data['title'] = "Login";
        return view('template.auth.login', $data);
    }

    public function register() {

        $data['title'] = "Register";
        return view('template.auth.register', $data);
    }

    public function registerAction(Request $request) {

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'phone_number' => 'required|string|max:50|unique:users',
            'email' => 'required|string|max:50|unique:users',
            'password' => 'required|string|max:6|confirmed',
        ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();
        }

        //Run a few checks 

        //Create user account (Include role: Admin/Customer)
        
        DB::beginTransaction(); 

        $user = new User();

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone_number = $request->phone_number;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();



        if(!$user) {

            return redirect()->back()->withError($user)->withInput();
        }

        //Create customer instance (customer_type: regular)

        $customer = $user->customer()->create([

            'cutsomer_type' => "regular"

        ]);

        //Create wallet instance
         $wallet = $customer->wallet()->create([

             'balance' => "0.6"
         ]);

         

        //Send activation email

        //Methid Three - using notifictaion
        $user->notify(( new ActivationNotification($user))->delay(now()->addSeconds(30)));
        

        // //Method Two
        // Mail::to($user->email)->send(new ActivationMail($user));

        //Method One
        // $mail_details = [
        //     //This pass parametrs to the veiw
        //     'name' => $user->first_name,
        //     'email' => $user->email,
        //     'subject' => "Account activation",
        //     'mailmessage' => "Your account has been succesfully created",
        //     'link' => 'http://localhost/welcome'
        // ];



        // Mail::send('emails.welcome', $mail_details, function($m) use ($user){

        //     $m->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        //     $m->to($user->email);
        //     $m->subject('welcome to' .env('APP_NAME'));
        
        // });

        /**********
         * 
         * Send SMS
         ***********/

        $sms = "Welcome to our Bills payment platform. Regards.";

        if ($this->smsservice == "smsclone") {


            //Send SMS with SMSclone
            $sms_action = $this->smsClone->sendSMS($user->phone_number, $sms);


        } else {


            //Send SMS with Termii
            // $sms2 = new Termii();
            // $sms_action2 = $sms2->sendSMS($user->phone_number, $sms);
            
            $sms_action = $this->Termii->sendSMS($user->phone_number, $sms);


        }


         if($sms_action['status'] == "failed") {

            return redirect()->back()->withErrors($sms_action['message'])->withInput();
        }



        DB::commit();
        //Retrun success message

        //Write test



    }

    public function forgotpassword() {

        $data['title'] = "Forgot Password";
        return view('template.auth.forgotpassword', $data);
    }
}
