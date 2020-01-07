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
        $users = User::all();

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
        $user_id = $request->user_id;

        $bannedData = [
            'is_ban' => !$bannedFlag,
        ];

        $banUser = $this->userService->banUser($user_id, $bannedData);

        if ($banUser) {
            $result = [
                'status' => true,
            ];

            return response()->json($result);
        }

        $result = [
            'status' => false,
        ];

        return response()->json($result);
    }
}
