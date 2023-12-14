<?php


namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    function index()
    {
        return view('sesi.index');
    }

    function login(Request $request)
    {
    $this->validate($request, [
        'name' => 'required|exists:users,name',
        'password' => 'required|min:6|max:255',
    ], [
        'name.required' => 'Nama Wajib Diisi',
        'name.exists' => 'Nama yang Anda Masukkan Belum Terdaftar !!',
        'password.required' => 'Password harus di isi',
        'password.min' => 'Password minimal 6 karakter',
        'password.max' => 'Maksimal panjang password adalah 255 karakter',
    ]);



        if (Auth::attempt($request->only('name', 'password'))) {
            $user = Auth::user();
            // if ($user->role === 'admin') {
            //     return redirect('/dashboardadmin');
            // } else if ($user->role === 'user') {
            //     return redirect('/user');
            // }
            // return to_route('dasbroad');
            return redirect()->route('dasbroad')->with('success', 'Berhasil Login');
        }

        return redirect()->back()->withInput($request->only('name'))->withErrors(['password' => 'Password Salah !!']);
    }

    function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Berhasil LogOut');
    }

    function register()
    {
        return view('sesi/register');
    }

    public function create(Request $request)
    {

        $request->validate([
            'username' => 'required|unique:users,name',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
            // Add validation rules for other fields if needed
        ], [
            'username.required' => 'Username Tidak Boleh Kosong',
            'username.unique' => 'Username Sudah Di Gunakan',
            'email.required' => 'Email Tidak Boleh Kosong',
            'email.email' => 'Email Tidak Valid',
            'email.unique' => 'Email Sudah Di Gunakan',
            'password.required' => 'Password Tidak Boleh Kosong',
            'password.confirmed' => 'Password Tidak Sama',
            'password.min' => 'Password Minimal 8 Karakter',
        ]);

        if (User::where('name', $request->name)->exists()) {
            return redirect('sesi/register')->withErrors('Email Sudah DI Gunakan');
        }

        if (empty($request->password)) {
            return redirect('sesi/register')->withErrors('Password Tidak Boleh Kosong');
        }
        // $data = [
        //     'name' => $request->name,
        //     'no_telp'=>$request->no_telp,
        //     'email' => $request->email,
        //     'role' => 'user',
        //     'password' => Hash::make($request->password),
        //     'jk'=>$request->jk,
        //     'alamat'=>$request->alamat,
        // ];

        // dd($request);
        $user = new User;
        $user->name = $request->username;
        // $user->no_telp = $request->no_telp;
        $user->email = $request->email;
        // $user->role = 'user';
        $user->password = Hash::make($request->password);
    //  $user->jk = $request->jk;
     // $user->alamat = $request->alamat;
        $user->save();

        // User::create($data);
        return redirect()->route('login.page')->with('success', 'Berhasil Register');
    }
}

