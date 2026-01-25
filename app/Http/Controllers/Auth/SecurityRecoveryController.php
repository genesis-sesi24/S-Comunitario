<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class SecurityRecoveryController extends Controller
{
    /**
     * Get the security question for a given email
     */
    public function getQuestion(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ], [
            'email.required' => 'El correo es obligatorio',
            'email.email' => 'Formato de correo inválido'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['No encontramos un usuario con este correo.']
            ]);
        }

        if (!$user->securityAnswer) {
            return response()->json([
                'error' => 'Este usuario no tiene configurada una pregunta de seguridad.'
            ], 422);
        }

        return response()->json([
            'question' => $user->securityAnswer->securityQuestion->question
        ]);
    }

    /**
     * Verify the answer and generate a reset token
     */
    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'security_answer' => 'required|string'
        ], [
            'security_answer.required' => 'La respuesta es obligatoria'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !$user->securityAnswer) {
            return back()->with('error', 'Usuario inválido.');
        }

        if ($user->securityAnswer->verifyAnswer($request->security_answer)) {
            // Answer is correct! Generate token
            $token = Password::createToken($user);
            
            // Redirect to password reset form
            return redirect()->route('password.reset', [
                'token' => $token, 
                'email' => $user->email
            ]);
        }

        return back()->with('error', 'La respuesta de seguridad es incorrecta.');
    }
}
