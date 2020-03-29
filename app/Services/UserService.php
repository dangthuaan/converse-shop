<?php

namespace App\Services;

use App\User;
use App\Mail\BanUser;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class UserService
{
    /**
     * Get list of users.
     *
     * @param  $option, $key
     *
     * @return Array
     */
    public function getList($option = [], $key)
    {
        $query = new User;

        if (isset($option['key'])) {
            $query = $query->where('name', 'like', '%' . $key . '%');
        }

        if (isset($option['order_by'])) {
            $query = $query->orderBy($option['order_by'], 'DESC');
        }

        return $query->get();
    }

    /**
     * Get user by Id.
     *
     * @param  int  $id
     * @return Model
     */
    public function getUserById($id)
    {
        return User::findOrFail($id);
    }

    /**
     * Ban a user.
     *
     * @param  int  $id
     * @return Boolean
     */
    public function banUser($id)
    {
        $user = User::findOrFail($id);

        try {
            $user->increment('is_ban');
        } catch (\Throwable $th) {
            Log::error($th);

            return false;
        }

        return true;
    }

    /**
     * Send ban user reason email.
     *
     * @param  int $user
     */
    public function sendBanUserEmail($userId, $reason)
    {
        try {
            Mail::to(User::findOrFail($userId))->send(new BanUser($reason));
        } catch (\Throwable $th) {
            Log::error($th);

            return false;
        }

        return true;
    }

    /**
     * Un-Ban a user.
     *
     * @param  int  $id
     * @return Boolean
     */
    public function unBanUser($id)
    {
        $user = User::findOrFail($id);

        try {
            $user->decrement('is_ban', 1);
        } catch (\Throwable $th) {
            Log::error($th);

            return false;
        }

        return true;
    }

    /**
     * Send un-ban user reason email.
     *
     * @param  int $user
     */
    public function sendUnBanUserEmail($userId, $reason)
    {
        try {
            Mail::to(User::findOrFail($userId))->send(new BanUser($reason));
        } catch (\Throwable $th) {
            Log::error($th);

            return false;
        }

        return true;
    }

    /**
     * Get user by Id.
     *
     * @param  Array $data
     * @return Boolean
     */
    public function create($data)
    {
        try {
            User::create($data);
        } catch (\Throwable $th) {
            Log::error($th);

            return false;
        }

        return true;
    }

    /**
     * Update user by Id.
     *
     * @param  int $id
     * @param  array $data
     * @return Boolean
     */
    public function update($id, $data)
    {
        $user = User::findOrFail($id);

        try {
            $user->update($data);
        } catch (\Throwable $th) {
            Log::error($th);

            return false;
        }

        return true;
    }

    /**
     * Delete user by Id.
     *
     * @param  int $id
     * @return Boolean
     */
    public function delete($id)
    {
        $user = User::findOrFail($id);

        try {
            $user->delete();
        } catch (\Throwable $th) {
            Log::error($th);

            return false;
        }

        return true;
    }
}
