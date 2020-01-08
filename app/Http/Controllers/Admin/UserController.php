<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Services\UserService;
use App\Http\Requests\BanRequest;
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
     * Ban a specific user.
     *
     * @return \Illuminate\Http\Response
     */
    public function banUser(BanRequest $request)
    {
        $bannedFlag = $request->is_ban;
        $userId = $request->user_id;

        $bannedData = [
            'is_ban' => !$bannedFlag,
        ];

        $banUser = $this->userService->banUser($userId, $bannedData);

        $status = false;

        if ($banUser) {
            $status = true;
        }

        $result = [
            'status' => $status,
        ];

        return response()->json($result);
    }
}
