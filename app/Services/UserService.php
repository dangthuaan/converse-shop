<?php

namespace App\Services;

use App\User;
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
     * @param  Array $data
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
