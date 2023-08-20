<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginAdminRequest;
use App\Http\Requests\RegisterAdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function register(RegisterAdminRequest $request) {
        $request['password'] = Hash::make($request['password']);
        $admin = Admin::create($request->all());
        $token = $admin->createToken('authToken')->plainTextToken;
        return response()->json([
            'success' => true,
            'access_token' => $token,
            'admin' => $admin,
            'message' => 'Inscription réussie.'
        ]);
    }

    public function login(LoginAdminRequest $request) {
        $admin = Admin::where('email', $request['login'])
            ->orWhere('phone', $request['login'])
            ->first();
        if (is_null($admin) || !Hash::check($request['password'], $admin->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Les informations de connexion ne sont pas valides.'
            ], 402);
        } else {
            $token = $admin->createToken('authToken')->plainTextToken;
            return response()->json([
                'success' => true,
                'access_token' => $token,
                'admin' => $admin,
                'message' => 'Connexion réussie.'
            ]);
        }
    }

    public function getMyInfo(Request $request) {
        try{
            $admin = Admin::where('email', $request['login'])
                ->orWhere('phone', $request['login'])
                ->first();
            if($admin){
                return response()->json([
                    'success' => true,
                    'admin' => $admin,
                ]);
            }else{
                return response()->json([
                    'success' => false,
                ], 404);
            }
        }catch(\Exception $e) {
            return response()->json([
                'success' => false,
            ], 404);
        }
    }

    public function updatePassword(Request $request) {
        try{
            $admin = Admin::where('email', $request['login'])
                ->orWhere('phone', $request['login'])
                ->first();
            if($admin){
                $admin->password = $request['password'];
                $admin->update();
                return response()->json([
                    'success' => true,
                ]);
            }else{
                return response()->json([
                    'success' => false,
                ], 404);
            }
        }catch(\Exception $e) {
            return response()->json([
                'success' => false,
            ], 404);
        }
    }
}
