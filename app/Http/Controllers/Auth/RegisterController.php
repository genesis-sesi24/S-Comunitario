<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserSecurityAnswer;
use App\Models\PasswordHistory;
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

    use RegistersUsers;

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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'security_question_id' => ['required', 'exists:security_questions,id'],
            'security_answer' => ['required', 'string', 'min:2'],
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'Ingresa un correo válido.',
            'email.unique' => 'Este correo ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'security_question_id.required' => 'Selecciona una pregunta de seguridad.',
            'security_answer.required' => 'La respuesta de seguridad es obligatoria.',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Save security answer
        UserSecurityAnswer::create([
            'user_id' => $user->id,
            'security_question_id' => $data['security_question_id'],
            'answer' => $data['security_answer'], // Auto-hashed by model mutator
        ]);

        // Save initial password to history
        PasswordHistory::create([
            'user_id' => $user->id,
            'password' => Hash::make($data['password']),
            'status' => 1, // Active
        ]);

        return $user;
    }
}
