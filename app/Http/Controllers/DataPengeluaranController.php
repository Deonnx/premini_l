<?php

namespace App\Http\Controllers;

use App\Models\Data_pengeluaran;
use Exception;
use Illuminate\Http\Request;

class DataPengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_pengeluaran = Data_pengeluaran::all();

        return view('tampilan_pengeluaran.pengeluaran', compact('data_pengeluaran'));
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
        $validasi = $request->validate([
            'tanggal' => 'required|date|date_format:Y-m-d',
            'catatan' => 'required',
            'pengeluaran' => 'required|numeric|min:0', // Validasi untuk angka tidak boleh negatif
        ], [
            'tanggal.required' => 'Tanggal harus diisi.',
            'tanggal.date' => 'Format tanggal tidak valid.',
            'tanggal.date_format' => 'Format tanggal harus YYYY-MM-DD.',
            'catatan.required' => 'Catatan harus diisi.',
            'pengeluaran.required' => 'Pengeluaran harus diisi.',
            'pengeluaran.numeric' => 'Pengeluaran harus berupa angka.',
            'pengeluaran.min' => 'Pengeluaran tidak boleh negatif.',
        ]);



        Data_pengeluaran::create([
            'tanggal' => $request->tanggal,
            'catatan' => $request->catatan,
            'pengeluaran' => $request->pengeluaran,
        ]);

        return redirect()->route('pengeluaran')->with('success','Data Berhasil Ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show(Data_pengeluaran $data_pengeluaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Data_pengeluaran $data_pengeluaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $data_pengeluaran = Data_pengeluaran::find($id);
         $request->validate([
            'tanggal' => 'required|date|date_format:Y-m-d',
            'catatan' => 'required',
            'pengeluaran' => 'required|numeric|min:0', // Validasi untuk angka tidak boleh negatif
        ], [
            'tanggal.required' => 'Tanggal harus diisi.',
            'tanggal.date' => 'Format tanggal tidak valid.',
            'tanggal.date_format' => 'Format tanggal harus YYYY-MM-DD.',
            'catatan.required' => 'Catatan harus diisi.',
            'pengeluaran.required' => 'Pengeluaran harus diisi.',
            'pengeluaran.numeric' => 'Pengeluaran harus berupa angka.',
            'pengeluaran.min' => 'Pengeluaran tidak boleh negatif.',
        ]);

        // ...


            $data_pengeluaran->update([
                'tanggal' => $request->tanggal,
                'catatan' => $request->catatan,
                'pengeluaran' => $request->pengeluaran,
            ]);

            return redirect()->route('pengeluaran')->with('success', 'Data berhasil di edit');
    }

    /**
     * Remove the specified resource from storage.
     */
   /**
 * Remove the specified resource from storage.
 */
public function destroy($id)
{
    try {
        $data_pengeluaran = Data_pengeluaran::find($id);

        if (!$data_pengeluaran) {
            return redirect()->route('pengeluaran')->with('error', 'Data not found');
        }

        $data_pengeluaran->delete();

        return redirect()->route('pengeluaran')->with('success', 'Data berhasil dihapus');
    } catch (Exception $e) {
        return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data');
    }
}
}
