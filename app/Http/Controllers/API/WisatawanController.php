<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Wisatawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class WisatawanController extends Controller
{
    public function login(Request $request)
    {
        $user = Wisatawan::where(function($query) use ($request) {
            $query->where('email', $request->email)
                  ->orWhere('name', $request->name);
        })->first();
    
        if ($user) {
            if (password_verify($request->input('password'), $user->password)) {
                Session::put('user', $user);
                Session::save();
                return response()->json([
                    'success' => 1,
                    'message' => 'Selamat Datang ' . $user->name,
                    'user' => $user
                ]);
            }
            return $this->error('Password salah');
        }
        return $this->error('Email atau nama tidak terdaftar');
    }
    // {
    //     $user = Wisatawan::where('email', $request->email)->first();
    //     if ($user) {
    //         if (password_verify($request->password, $user->password)) {
    //             Session::put('user', $user);
    //             Session::save();
    //             return response()->json([
    //                 'success' => 1,
    //                 'message' => 'Selamat Datang ' . $user->name,
    //                 'user' => $user
    //             ]);
    //         }
    //         return $this->error('Password salah');
    //     }
    //     return $this->error('Email tidak terdaftar');
    // }

    public function register(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'name' => 'required|unique:wisatawans,name',
            'email' => 'required|email|unique:wisatawans',
            'password' => 'required|min:6',
        ]);

        if ($validasi->fails()) {
            $errors = $validasi->errors();
            
            if ($errors->has('name')) {
                return $this->error('Nama sudah terdaftar.');
            } elseif ($errors->has('email')) {
                return $this->error('Email sudah terdaftar.');
            }
            
            return $this->error('Ada kesalahan dalam pendaftaran.');
        }

        $user = Wisatawan::create(array_merge($request->all(), [
            'password' => bcrypt($request->password)
        ]));

        if ($user) {
            Session::put('user', $user);
            return response()->json([
                'success' => 1,
                'message' => 'Selamat register berhasil',
                'user' => $user
            ]);
        }

        return $this->error('Registrasi gagal');
    }

    public function error($pesan)
    {
        return response()->json([
            'success' => 0,
            'message' => $pesan,
        ]);
    }

    public function logout()
    {
        Session::forget('user');
        return response()->json([
            'success' => 1,
            'message' => 'Logout berhasil',
        ]);
    }

    public function checkLoggedIn()
    {
        if (Session::has('user')) {
            $user = Session::get('user');
            return response()->json([
                'success' => 1,
                'message' => 'Pengguna sudah login',
                'user' => $user
            ]);
        } else {
            return response()->json([
                'success' => 0,
                'message' => 'Pengguna belum login',
            ]);
        }
    }
}
