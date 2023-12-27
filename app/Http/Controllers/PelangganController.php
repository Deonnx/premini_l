<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
                ->route('pelanggan')
                ->withInput()  // Menyimpan input sebelumnya
                ->with('error', 'Foto pelanggan wajib diunggah.');
        }


        pelanggan::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'no_telephone' => $request->no_telephone,
            'foto_pelanggan' => $foto_pelanggan,
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

            $foto_pelanggan = $pelanggan->foto_pelanggan;

            if ($request->hasFile('foto_pelanggan')) {
                $foto_pelanggan = $request->file('foto_pelanggan')->store('gambar', 'public');

                if ($pelanggan->foto_pelanggan && trim($pelanggan->foto_pelanggan) !== trim($request->input('current_foto'))) {
                    Storage::disk('public')->delete($pelanggan->foto_pelanggan);
                }
            }

            $pelanggan->update([
                'nama_pelanggan' => $request->nama_pelanggan,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'no_telephone' => $request->no_telephone,
                'foto_pelanggan' => $foto_pelanggan,
            ]);

            return redirect()->route('pelanggan')->with('success', 'Data berhasil di edit');
        } else {
            return redirect()->route('pelanggan')->with('error', 'Data tidak ditemukan');
        }
    }






    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $pelanggan = Pelanggan::findOrFail($id); // Menemukan dan mendapatkan data pelanggan berdasarkan ID

            // Hapus foto di folder
            if ($pelanggan->foto_pelanggan) {
                Storage::disk('public')->delete($pelanggan->foto_pelanggan);
            }

            $pelanggan->delete(); // Menghapus data pelanggan

            return redirect()->route('pelanggan')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) { // Menangkap pengecualian
            // Tambahkan pernyataan ini untuk melihat informasi pengecualian
            return redirect()->back()->with('error', 'Pelanggan sedang digunakan');

            // Komentari baris ini untuk melihat pesan error
            // return redirect()->back()->with('error', 'Buku sedang digunakan');
        }
    }

}
