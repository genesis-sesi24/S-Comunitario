<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PasswordHistory;
use App\Models\UserSecurityAnswer;
use App\Models\SecurityQuestion;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Show the profile editing form
     */
    public function index()
    {
        $securityQuestions = SecurityQuestion::all();
        
        return view('profile.index', [
            'user' => auth()->user(),
            'securityQuestions' => $securityQuestions
        ]);
    }

    /**
     * Update user profile information
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'apellido' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
        ], [
            'name.required' => 'El nombre es obligatorio.',
        ]);

        $user->update($validated);

        return back()->with('success', '¡Perfil actualizado correctamente!');
    }

    /**
     * Update user avatar
     */
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'avatar.required' => 'Debes seleccionar una imagen.',
            'avatar.image' => 'El archivo debe ser una imagen.',
            'avatar.mimes' => 'Solo se permiten archivos JPG, PNG y GIF.',
            'avatar.max' => 'La imagen no puede superar 2MB.',
        ]);

        $user = auth()->user();

        // Delete old avatar if exists
        if ($user->avatar && file_exists(public_path($user->avatar))) {
            unlink(public_path($user->avatar));
        }

        // Store new avatar
        $avatarName = 'avatar_' . $user->id . '_' . time() . '.' . $request->avatar->extension();
        $request->avatar->move(public_path('uploads/avatars'), $avatarName);

        $user->update([
            'avatar' => 'uploads/avatars/' . $avatarName
        ]);

        return back()->with('success', '¡Foto de perfil actualizada!');
    }

    /**
     * Update theme color
     */
    public function updateTheme(Request $request)
    {
        $request->validate([
            'theme_color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/'
        ], [
            'theme_color.required' => 'Debes seleccionar un color.',
            'theme_color.regex' => 'El formato del color no es válido.',
        ]);

        auth()->user()->update([
            'theme_color' => $request->theme_color
        ]);

        return back()->with('success', '¡Tema personalizado aplicado!');
    }

    /**
     * Update user password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ], [
            'current_password.required' => 'La contraseña actual es obligatoria.',
            'new_password.required' => 'La nueva contraseña es obligatoria.',
            'new_password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'new_password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        $user = auth()->user();

        // Verify current password
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual es incorrecta.']);
        }

        // Check if new password exists in history
        if (PasswordHistory::passwordExistsInHistory($user->id, $request->new_password)) {
            return back()->withErrors(['new_password' => 'Esta contraseña ya fue utilizada anteriormente. Por favor elige una diferente.']);
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        // Add to history
        PasswordHistory::addToHistory($user->id, $request->new_password);

        return back()->with('success', '¡Contraseña actualizada exitosamente!');
    }

    /**
     * Update security question
     */
    public function updateSecurity(Request $request)
    {
        $request->validate([
            'security_question_id' => 'required|exists:security_questions,id',
            'security_answer' => 'required|string',
        ], [
            'security_question_id.required' => 'Debes seleccionar una pregunta de seguridad.',
            'security_answer.required' => 'La respuesta de seguridad es obligatoria.',
        ]);

        $user = auth()->user();

        // Update or create security answer
        UserSecurityAnswer::updateOrCreate(
            ['user_id' => $user->id],
            [
                'security_question_id' => $request->security_question_id,
                'answer' => $request->security_answer // Auto-hashed by mutator
            ]
        );

        return back()->with('success', '¡Pregunta de seguridad actualizada!');
    }
}
