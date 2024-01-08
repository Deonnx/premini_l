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
        'username' => 'required',
        'password' => 'required|min:6|max:255',
    ], [
        'username.required' => 'Email atau Username Wajib Diisi',
        'password.required' => 'Password harus di isi',
        'password.min' => 'Password minimal 6 karakter',
        'password.max' => 'Maksimal panjang password adalah 255 karakter',
    ]);

    $credentials = [
        'password' => $request->password,
    ];

    // Determine if 'username' is an email or username
    if (filter_var($request->username, FILTER_VALIDATE_EMAIL)) {
        $credentials['email'] = $request->username;
    } else {
        $credentials['name'] = $request->username;
    }

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        return redirect()->route('dasbroad')->with('success', 'Selamat Datang, ' . $user->name . '!');
    }

    return redirect()->back()->withInput($request->only('username'))->withErrors(['password' => ' password salah']);
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
            'password' => 'required|min:8', // Menambahkan aturan minimal 8 karakter
            // Tambahkan aturan validasi untuk field lain jika diperlukan
        ], [
            'username.required' => 'Username Tidak Boleh Kosong',
            'username.unique' => 'Username Sudah Di Gunakan',
            'email.required' => 'Email Tidak Boleh Kosong',
            'email.email' => 'Email Tidak Valid',
            'email.unique' => 'Email Sudah Di Gunakan',
            'password.required' => 'Password Tidak Boleh Kosong',
            'password.min' => 'Password minimal harus terdiri dari 8 karakter', // Pesan khusus untuk aturan min
        ]);

        if (User::where('name', $request->name)->exists()) {
            return redirect('sesi/register')->withErrors('Email Sudah DI Gunakan');
        }

        if (empty($request->password)) {
            return redirect('sesi/register')->withErrors('Password Tidak Boleh Kosong');
        }


        // dd($request);
        $user = new User;
        $user->name = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login.page')->with('success', 'Berhasil Register');
    }
}

