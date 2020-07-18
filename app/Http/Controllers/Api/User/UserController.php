<?php
namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    const LEVEL_NEW = 1;
    const LEVEL_ROOKIE = 2;
    const LEVEL_OWNER = 10;

//    public function showDefault(Request $request, $id)
//    {
//        $result = User::findOrFail($id);
//        return Response()->
//    }

    public function storeDefault(Request $request)
    {
        $user = new User;
        $is_phone = $request->get('phone');
        $user->name = $request->get('name');
        $user->username = $request->get('username');
        $user->password = bcrypt($request->get('password'));
        $user->phone = $is_phone ? $is_phone : 0;
        $user->level = $is_phone ? self::LEVEL_ROOKIE : self::LEVEL_NEW;
        $user->save();
    }
}
