<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, array $input)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'path_image' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ];

        if ($input['tab'] == 'bank') {
            $rules = [
                'bank_id' => 'required|exists:banks,id|unique:bank_users,bank_id',
                'account_number' => 'required|unique:bank_users,account_number',
                'account_name' => 'required',
            ];
        }

        $validated = Validator::make($input, $rules);

        if ($validated->fails()) {
            return back()
                ->withInput()
                ->withErrors($validated->errors());
        }

        if (isset($input['path_image'])) {
            if (!empty($user->path_image)) {
                if (Storage::disk('public')->exists($user->path_image)) {
                    Storage::disk('public')->delete($user->path_image);
                }
            }
            $input['path_image'] = upload('user', $input['path_image'], 'user');
        }

        $user->update($input);

        if ($input['tab'] == 'bank') {
            $user->bank_users()->attach($input['bank_id'], [
                'account_number' => $input['account_number'],
                'account_name' => $input['account_name'],
            ]);
        }

        return redirect()->back()->with('success', 'Data Profil berhasil diupdate.');
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
