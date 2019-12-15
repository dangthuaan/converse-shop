<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService) { //injection
        $this->userService = $userService; //gọi kiểu hướng đối tượng
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function showPassword($id)
    {
        $user = $this->userService->getUserById($id);
        return view('client.password', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the user profile(without password).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->only([
            'name',
            'email'
        ]);

        $updateUser = $this->userService->update($id, $data);

        if ($updateUser) {
            return back()->with('status', 'Update success!');
        } else {
            return back()->with('status', 'Update failed!');
        }

    }

    /**
     * Update the user password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, $id)
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:8|confirmed',
        ]);

        //Change Password
        $newPassword = bcrypt($request->get('new-password'));

        $updatePassword = $this->userService->update($id, ['password' => $newPassword]);

        if ($updatePassword) {
            return back()->with('success', 'Update success!');
        } else {
            return back()->with('error', 'Update failed!');
        }
    }

    /**
     * Confirm site for deleting account.
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
        if (!(Hash::check($request->get('confirm-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }

        $deleteUser = $this->userService->delete($id);

        if ($deleteUser) {
            return redirect('/')->with('status', 'User has been deleted!');
        } else {
            return back()->with('error', 'Delete user failed!');
        }
    }
}
