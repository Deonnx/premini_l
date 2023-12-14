<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelanggan = Pelanggan::all();

        return view('tampilan_pelanggan.pelanggan' , compact('pelanggan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string', // Menghapus aturan in:Laki-laki,Perempuan
            'alamat' => 'required|string|max:255',
            'no_telephone' => 'required|string|digits:12',

        ], [
            'nama_pelanggan.required' => 'Nama pelanggan wajib diisi.',
            'nama_pelanggan.max' => 'Nama pelanggan maksimal :max karakter.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.max' => 'Alamat maksimal :max karakter.',
            'no_telephone.required' => 'Nomor telepon wajib diisi.',
            'no_telephone.max' => 'Nomor telepon maksimal :max karakter.',
            'no_telephone.digits' => 'Nomor telepon harus terdiri dari :digits digit.',
        ]);

        pelanggan::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'no_telephone' => $request->no_telephone,
        ]);

        return redirect()->route('pelanggan')->with('success', 'Data berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Pelanggan $pelanggan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelanggan $pelanggan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::find($id);

        if ($pelanggan) {
            $validasi = $request->validate([
                'nama_pelanggan' => 'required',
                'jenis_kelamin' => 'required',
                'alamat' => 'required',
                'no_telephone' => 'required',
            ]);

            $pelanggan->update([
                'nama_pelanggan' => $request->nama_pelanggan,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'no_telephone' => $request->no_telephone,
            ]);

            return redirect()->route('pelanggan')->with('success', 'Data berhasil di edit');
        } else {
            // Redirect dengan pesan flash
            return redirect()->route('pelanggan')->with('error', 'Data tidak ditemukan');
        }
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $pelanggan = Pelanggan::find($id);

    if (!$pelanggan) {
        return redirect()->back()->with('error', 'Data tidak ditemukan');
    }

    $pelanggan->delete();
    return redirect()->back()->with('success', 'Berhasil menghapus data');
}
}

