<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\ProfileCv;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Jrean\UserVerification\Traits\VerifiesUsers;
use Jrean\UserVerification\Facades\UserVerification;
use App\Http\Requests\Front\UserFrontRegisterFormRequest;
use Illuminate\Auth\Events\Registered;
use App\Events\UserRegistered;

class RegisterController extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | Register Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users as well as their
      | validation and creation. By default this controller uses a trait to
      | provide this functionality without requiring any additional code.
      |
     */

    use RegistersUsers;
    use VerifiesUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['getVerification', 'getVerificationError']]);
    }

    public function register(UserFrontRegisterFormRequest $request)
    {
        // Validate CV file if provided
        if ($request->hasFile('cv_file')) {
            $request->validate([
                'cv_file' => 'required|file|mimes:pdf,doc,docx|max:5120', // 5MB max
            ]);
        }
    
        $user = new User();
        $user->first_name = $request->input('first_name');
        $user->middle_name = $request->input('middle_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->is_active = 1;
        $user->verified = 0;
        $user->save();
        
        /*         * *********************** */
        $user->name = $user->getName();
        $user->update();
        /*         * *********************** */
    
        if ($request->hasFile('cv_file')) {
            $this->storeRegistrationCv($request, $user->id);
        }
        
        event(new Registered($user));
        event(new UserRegistered($user));
        $this->guard()->login($user);
        UserVerification::generate($user);
        UserVerification::send($user, 'User Verification', config('mail.recieve_to.address'), config('mail.recieve_to.name'));
        
        // Redirect to verification notice instead of home
        return redirect()->route('email-verification.error');
    }
    
    /**
     * Store CV uploaded during registration     
     */
    private function storeRegistrationCv(Request $request, $user_id) {

        $profileCv = new ProfileCv();
    
        if ($request->hasFile('cv_file')) {
            $cvFile = $request->file('cv_file');
            $fileName = time() . '_' . $cvFile->getClientOriginalName();
        
            $cvFile->move(public_path('cvs'), $fileName);
        
            $profileCv->user_id = $user_id;
            $profileCv->cv_file = $fileName; 
            $profileCv->title = 'Registration CV'; // Default title
            $profileCv->is_default = 1; // Set as default CV
            $profileCv->save();
        }
    }

    public function resendVerificationEmail(Request $request){

        // Check if already verified
        if ($request->user()->verified) {
            return redirect()->route('home')->with('success', 'Your email is already verified!');
        }

        // Generate and send new verification email
        UserVerification::generate($request->user());
        UserVerification::send(
            $request->user(), 
            'User Verification', 
                config('mail.recieve_to.address'), 
                config('mail.recieve_to.name')
        );

        return back()->with('success', 'Verification email has been resent! Please check your inbox.');
    }


}


