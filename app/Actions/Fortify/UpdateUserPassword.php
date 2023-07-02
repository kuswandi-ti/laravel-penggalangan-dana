<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

class UpdateUserPassword implements UpdatesUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and update the user's password.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, array $input)
    {
        $validated = Validator::make($input, [
            'current_password' => ['required', 'string', 'current_password:web'],
            'password' => ['required', 'string', 'confirmed'],
        ], [
            'current_password.current_password' => __('The provided password does not match your current password.'),
        ]);

        if ($validated->fails()) {
            return back()->withErrors($validated->errors());
        }

        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();

        return redirect()->back()->with('success', 'Data Profil berhasil diupdate.');
    }
}
