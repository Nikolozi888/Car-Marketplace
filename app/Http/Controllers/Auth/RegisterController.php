<?php

namespace App\Http\Controllers\Auth;

use App\DTOs\UserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use App\Traits\ChecksForAdminName;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

    use RegistersUsers, ChecksForAdminName;

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
        $this->middleware('guest');
    }

    public function register(RegistrationRequest $request)
    {
        $is_admin = $this->applyAdmin($request->toArray()); 

        $userData = UserDTO::fromRequest($request, $is_admin['is_admin']);

        $user = User::create($userData->toArray());

        $this->guard()->login($user);

        return $this->registered($request, $user) ?: redirect($this->redirectTo);
    }

}
