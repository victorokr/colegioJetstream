<?php

namespace App\Actions\Fortify;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

class UpdateUserPassword implements UpdatesUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and update the user's password based on the authenticated guard.
     *
     * @param  array<string, string>  $input
     */
    public function update($user, array $input): void
    {
        // Get the current guard (docente or acudiente)
        $guard = Auth::getDefaultDriver();
        
        // Modify the current_password validation rule to match the guard
        $currentPasswordRule = 'current_password:' . $guard;

        Validator::make($input, [
            'current_password' => ['required', 'string', $currentPasswordRule],
            'password' => $this->passwordRules(),
        ], [
            'current_password.current_password' => __('La contraseña proporcionada no coincide con tu contraseña actual.'),
        ])->validateWithBag('updatePassword');

        // Update the password based on the user type
        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();
    }
}
