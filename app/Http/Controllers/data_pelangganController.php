<?php

namespace App\Http\Controllers;

use App\Models\data_pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class data_pelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_pelanggan = Data_pelanggan::all();

        return view('tampilan_data_pelanggan.data_pelanggan' , compact('data_pelanggan'));
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
        // dd($request->all());
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|in:laki_laki,perempuan',
            'alamat' => 'required|string|max:255',
            'no_telephone' => 'required|string|digits:12',
            'foto_pelanggan' => 'required',
        ], [
            'nama_pelanggan.required' => 'Nama pelanggan wajib diisi.',
            'nama_pelanggan.max' => 'Nama pelanggan maksimal :max karakter.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.max' => 'Alamat maksimal :max karakter.',
            'no_telephone.required' => 'Nomor telepon wajib diisi.',
            'no_telephone.max' => 'Nomor telepon maksimal :max karakter.',
            'no_telephone.digits' => 'Nomor telepon harus terdiri dari :digits digit.',
            'foto_pelanggan.required' => 'Foto pelanggan harus di isi',
            // 'foto_pelanggan.mimes' => 'Format gambar harus jpeg, png, atau jpg',
            // 'foto_pelanggan.max' => 'Ukuran gambar maksimum 2MB',
        ]);

        if ($request->hasFile('foto_pelanggan')) {
            $foto_pelanggan = $request->file('foto_pelanggan')->store('gambar', 'public');

        } else {
            return redirect()
                ->route('data_pelanggan')
                ->withInput()  // Menyimpan input sebelumnya
                ->with('error', 'Foto pelanggan wajib diunggah.');
        }


        data_pelanggan::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'no_telephone' => $request->no_telephone,
            'foto_pelanggan' => $foto_pelanggan,
        ]);


        return redirect()->route('data_pelanggan')->with('success', 'Data berhasil ditambahkan.');
    }



    /**
     * Display the specified resource.
     */
    public function show(Data_pelanggan $data_pelanggan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Data_pelanggan $data_pelanggan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data_pelanggan = Data_pelanggan::find($id);

        if ($data_pelanggan) {
            $request->validate([
                'nama_pelanggan' => 'required|string|max:255',
                'jenis_kelamin' => 'required|string',
                'alamat' => 'required|string|max:255',
                'no_telephone' => 'required|string|digits:12',
                'foto_pelanggan' => 'nullable|mimes:jpeg,png,jpg|max:2048', // Allow null for cases when no new file is uploaded
            ], [
                'nama_pelanggan.required' => 'Nama pelanggan wajib diisi.',
                'nama_pelanggan.max' => 'Nama pelanggan maksimal :max karakter.',
                'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
                'alamat.required' => 'Alamat wajib diisi.',
                'alamat.max' => 'Alamat maksimal :max karakter.',
                'no_telephone.required' => 'Nomor telepon wajib diisi.',
                'no_telephone.max' => 'Nomor telepon maksimal :max karakter.',
                'no_telephone.digits' => 'Nomor telepon harus terdiri dari :digits digit.',
                'foto_pelanggan.mimes' => 'Format gambar harus jpeg, png, atau jpg',
                'foto_pelanggan.max' => 'Ukuran gambar maksimum 2MB',
            ]);

            $foto_pelanggan = $data_pelanggan->foto_pelanggan;

        if ($request->hasFile('foto_pelanggan')) {
            // Hapus foto lama jika ada
            if ($data_pelanggan->foto_pelanggan) {
                Storage::disk('public')->delete($data_pelanggan->foto_pelanggan);
            }

            // Simpan foto baru
            $foto_pelanggan = $request->file('foto_pelanggan')->store('gambar', 'public');
        }

            $data_pelanggan->update([
                'nama_pelanggan' => $request->nama_pelanggan,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'no_telephone' => $request->no_telephone,
                'foto_pelanggan' => $foto_pelanggan,
            ]);

            return redirect()->route('data_pelanggan')->with('success', 'Data berhasil di edit');
        } else {
            return redirect()->route('data_pelanggan')->with('error', 'Data tidak ditemukan');
        }
    }






    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $data_pelanggan = Data_pelanggan::findOrFail($id);

            if ($data_pelanggan->foto_pelanggan) {
                // Ensure that the foto_pelanggan is a valid file name
                $fotoPelangganPath =  $data_pelanggan->foto_pelanggan;

                if (Storage::disk('public')->exists($fotoPelangganPath)) {
                    // Delete the photo file from the folder
                    Storage::disk('public')->delete($fotoPelangganPath);
                }
            }

            $data_pelanggan->delete();

            return redirect()->route('data_pelanggan')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            // Handle exceptions and show an appropriate message
            return redirect()->route('data_pelanggan')->with('error', 'Terjadi kesalahan saat menghapus data pelanggan');
        }
    }
}