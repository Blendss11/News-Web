<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAllUser()
    {
        $users = User::all();

        if($users)
        {
            return ResponseFormatter::success($users, 'Data User Berhasil Diambil');
        } else {
            return ResponseFormatter::error(null, 'Data User Tidak Ada');
        }
    }

    public function getUserbyId($id)
    {
        $user = User::find($id);

        if($user)
        {
            return ResponseFormatter::success($user, 'Data User Berhasil Diambil');
        } else {
            return ResponseFormatter::error(null, 'Data User Tidak Ada', 404);
        }
    }
}
