<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function getSandi($id)
    {
        $sandi = User::where('id', '=', $id)->select('users.*')->first();
        return response()->json($sandi);
    }
}
