<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\UserRequest;
use App\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    { //injection
        $this->userService = $userService; //gọi kiểu hướng đối tượng
    }

    /**
     * Display the user profile.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userService->getUserById($id);

        return view('client.profile', ['user' => $user]);
    }

    /**
     * Display the password update site.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editPassword($id)
    {
        $user = $this->userService->getUserById($id);

        return view('client.password', ['user' => $user]);
    }

    /**
     * Update the user profile(without password).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $data = $request->only([
            'name',
            'email'
        ]);

        $updateUser = $this->userService->update($id, $data);

        if ($updateUser) {
            return back()->with('success', 'Update success!');
        } else {
            return back()->with('error', 'Update failed!');
        }
    }

    /**
     * Update the user password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(PasswordRequest $request, $id)
    {
        if (!(Hash::check($request->current_password, auth()->user()->password))) {
            // The passwords matches
            return back()->with('error', 'Your current password does not matches with the password you provided. Please try again.');
        }

        if (strcmp($request->current_password, $request->new_password) == 0) {
            //Current password and new password are same
            return back()->with('error', 'New Password cannot be same as your current password. Please choose a different password.');
        }

        //Change Password
        $newPassword = bcrypt($request->new_password);

        $updatePassword = $this->userService->update($id, ['password' => $newPassword]);

        if ($updatePassword) {
            return back()->with('success', 'Update success!');
        } else {
            return back()->with('error', 'Update failed!');
        }
    }

    /**
     * Confirm deleting account.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmDestroy($id)
    {
        $user = $this->userService->getUserById($id);

        return view('client.destroy', ['user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if (!(Hash::check($request->confirm_password, Auth::user()->password))) {
            // The passwords matches
            return back()->with('error', 'Your current password does not matches with the password you provided. Please try again.');
        }

        $deleteUser = $this->userService->delete($id);

        if ($deleteUser) {
            return redirect('/')->with('status', 'User has been deleted!');
        } else {
            return back()->with('error', 'Delete user failed!');
        }
    }
}
