<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class AuthController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function processLogin(Request $request)
    {
        $fields = $request->validate([
            'email' => ['required', 'max:255', 'email'],
            'password' => ['required',],
        ]);
        if (Auth::attempt($fields, $request->remember)) {
            // $request->session()->regenerate();
            return redirect()->intended('dashboards');
        } else {
            return back()->withErrors([
                'fieled' => 'Email hoặc mật khẩu sai, vui lòng nhập lại'
            ]);
        }

    }

    public function processRegister(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required', 'string', 'max:100', 'min:6'],
            'hinh' => ['nullable', 'file', 'max:3000', 'mimes:webp,png,jpg'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'max:70', 'min:6'],
            'level' => ['required'],
        ]);
        // validate
        $path = null;
        if ($request->hasFile('hinh')) {
            $path = Storage::disk('public')->putFile('image_admin', $request->file('hinh'));
        }
       // $path = Storage::disk('public')->putFile('image_admin', $request->file('hinh'));
        //$arr = $request->validated();
        $arr = $fields;
        $arr['hinh'] = $path;
        $arr['password'] = Hash::make($arr['password']);
        User::create($arr);



        // Warehouse::create($arr);
        return redirect()
            ->route('login')
            ->with('success', 'Đã thêm thành công');
        // User::query()->create([


        //     'name'=> $request->get('name'),
        //     'email'=> $request->get('email'),
        //     'password'=> Hash::make($request->get('password')), // mã hoá mật khẩu
        //     'level'=> $request->get('level'),
        // ]);

    }

}
