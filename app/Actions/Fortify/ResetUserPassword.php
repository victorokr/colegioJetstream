<?php

namespace App\Actions\Fortify;

// use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\ResetsUserPasswords;

class ResetUserPassword implements ResetsUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and reset the user's forgotten password.
     *
     * @param  array<string, string>  $input
     */
   

    public function reset($user, array $input): void  // Eliminamos la tipificación explícita User
        {
            Validator::make($input, [
                'password' => $this->passwordRules(),
            ])->validate();

            // Verificamos que el usuario sea un modelo permitido (Docente o Responsable)
            if ($user instanceof \App\Models\Docente || $user instanceof \App\Models\Responsable) {
                $user->forceFill([
                    'password' => Hash::make($input['password']),
                ])->save();
            } else {
                // Manejo de error si el usuario no es de los tipos esperados
                throw new \Exception('Tipo de usuario no soportado.');
            }
        }
}
