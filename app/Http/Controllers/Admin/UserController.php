<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Services\UserService;
use App\Http\Requests\BanRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(config('pagination.user_page_size'));

        return view('admin.users.index', compact('users'));
    }

    /**
     * Confirm ban user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmBan($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.confirmBan', compact('user'));
    }

    /**
     * Confirm ban user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmUnBan($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.confirmUnBan', compact('user'));
    }

    /**
     * Ban a specific user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     */
    public function banUser(Request $request, $id)
    {
        $banReason = $request->ban_reason;

        $banUser = $this->userService->banUser($id);

        if ($banUser) {
            $this->userService->sendBanUserEmail($id, $banReason);
            return redirect('admin/users')->with('success', 'User has been banned!');
        }

        return back()->with('error', 'Ban failed!');
    }

    /**
     * Un-Ban a specific user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unBanUser(Request $request, $id)
    {
        $unBanReason = $request->un_ban_reason;

        $unBanUser = $this->userService->unBanUser($id);

        if ($unBanUser) {
            $this->userService->sendUnBanUserEmail($id, $unBanReason);
            return redirect('admin/users')->with('success', 'User has been un-banned!');
        }

        return back()->with('error', 'Un-Ban failed!');
    }
}
