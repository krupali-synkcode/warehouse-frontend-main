<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserProfileRequest;
use App\Http\Requests\UserPasswordRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile()
    {
        $user = auth()->user();
        return view('user.profile', compact('user'));
    }

    public function updateProfile(UserProfileRequest $request)
    {
        DB::beginTransaction();

        try {
            $user = auth()->user();
            $profileData = [
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'email' => $request->get('email'),
                'phone_number' => $request->get('phone_number')
            ];
            $this->userRepository->update($user->id, $profileData);
            DB::commit();

            $notification = response_array('success', __('Your profile has been updated successfully.'));

            return redirect()
                ->back()
                ->with('notification', $notification);
        } catch (\Exception $e) {
            $notification = response_array('danger', $e->getMessage());
            DB::rollBack();

            return redirect()
                ->back()
                ->with('notification', $notification);
        }
    }

    public function updatePassword(UserPasswordRequest $request)
    {
        DB::beginTransaction();

        try {
            $user = $this->userRepository->getByEmail(auth()->user()->email);
            $passwordCheck = Hash::check($request->get('current_password'), $user->password);

            if (! $passwordCheck) {
                return redirect()
                    ->back()
                    ->withErrors(['current_password' => 'Current password does not match.']);
            }

            // Update user password
            $user = $this->userRepository->getByEmail(auth()->user()->email);
            $userData = [
                'password' => Hash::make($request->get('password')),
            ];

            $this->userRepository->update($user->id, $userData);

            $notification = response_array('success', __('Your password has been update successfully.'));
            DB::commit();

            return redirect()
                ->back()
                ->with('notification', $notification);
        } catch (\Exception $e) {
            $notification = response_array('danger', $e->getMessage());
            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with('notification', $notification);
        }
    }
}
