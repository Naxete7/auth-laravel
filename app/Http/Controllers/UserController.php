<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    const SUPER_ADMIN_ROLE_ID = 3;

    function addSuperAdminRoleByIdUser($id)
    {
        try {

            $userId = $id;
            $user = User::find($userId);

            if (!$user) {

                return response()->json([
                    'succes' => true,
                    'message' => 'No existe el usuario'

                ], 400);
            }


            $user->roles()->attach(self::SUPER_ADMIN_ROLE_ID);

            return response()->json([
                'succes' => true,
                'message' => 'Se ha añadido el role al usuario '

            ], 200);
        } catch (\Throwable $th) {

            Log::error("message");("Error add super Admin role:" . $th->getMessage());
            return response()->json([
                'succes' => false,
                'message' => 'Ups, ha ocurrido un error'

            ], 500);
        }
    }
}
