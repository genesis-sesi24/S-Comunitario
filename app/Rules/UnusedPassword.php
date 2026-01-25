<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\User;
use App\Models\PasswordHistory;

class UnusedPassword implements ValidationRule
{
    protected $email;

    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $user = User::where('email', $this->email)->first();

        // If user not found, we ignore (other rules handle existence if needed)
        if (!$user) return;

        if (PasswordHistory::passwordExistsInHistory($user->id, $value)) {
            $fail('Esta contraseña ya ha sido utilizada anteriormente o es tu contraseña actual. Elige una nueva.');
        }
    }
}
