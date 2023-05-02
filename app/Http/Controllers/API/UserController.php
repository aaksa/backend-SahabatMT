<?php

namespace App\Http\Controllers\API;


use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //


    public function login(Request $request)
    {

        try {
            $request->validate(
                [
                    'email' => 'required',
                    'password' => 'required'
                ]
            );
            $credentials = request([
                'email',
                'password'
            ]);

            if (!Auth::attempt($credentials)) {
                return ResponseFormatter::error([
                    'massage' => 'Unauthorized'
                ], 'Authentication Failed', 500);
            }

            $user = User::where('email', $request->email)->first();

            if (!Hash::check($request->password, $user->password, [])) {
                throw new Exception('Invalid Credentials');
            }

            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'tokenType' => 'Bearer',
                'user' => $user
            ], 'Authenticated');

        } catch (Exception $error) {
            return ResponseFormatter::error([
                'massage' => 'Something went wrong',
                'error' => $error,
            ], 'Authentication Failed', 500);
        }
    }


    public function register(Request $request)
    {
        try {
            $request->validate(
                [
                    'nama' => ['required'],
                    'email'=> ['required'],
                    'nomor_hp'=> ['required'],
                    'password' => ['required'],
                ],
            );

            User::create([
                'nama' => $request->nama,
                'email'=>$request->email,
                'nomor_hp'=>$request->nomor_hp,
                'password' => Hash::make($request->password),
            ]);


            $user = User::where('email', $request->email)->first();

            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return ResponseFormatter::success(['access_token' => $tokenResult, 'token_type' => 'Bearer', $user], 'Data berhasil dibuat');
        } catch (\Exception $error) {
            return ResponseFormatter::error(['message' => 'something went wrong', 'error' => $error], "Data gagal ditambahkan", '500');
        }

    }

    public function fetch(Request $request)
    {
        return ResponseFormatter::success($request->user(), 'Data user berhasil diambil');
    }

    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken()->delete();

        return ResponseFormatter::success($token, 'Token Revoked');
    }



}
