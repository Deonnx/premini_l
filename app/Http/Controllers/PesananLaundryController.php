<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Pesanan_laundry;
use Illuminate\Http\Request;

class PesananLaundryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pesanan_laundry = Pesanan_laundry::with(['pelanggan'])->get();
        $pelanggan = Pelanggan::all();

        return view('tampilan_laundry.pesanan_laundry',compact('pesanan_laundry','pelanggan'));
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
        'pelanggan_id' => 'required',
        'berat' => 'required',
        'tanggal_terima' => 'required', // 1
        'tanggal_selesai' => 'required', // 1
        'status' => 'required',
    ]);

    $harga_per_kg = 1000; // Ganti dengan harga per kilogram sesuai kebijakan Anda
    $total_tagihan = $request->berat * $harga_per_kg;

    Pesanan_laundry::create([
           'pelanggan_id' => $request->pelanggan_id,
            'berat' => $request->berat,
            'tanggal_terima' => $request->tanggal_terima,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => $request->status,
    ]);
    return redirect()->route('pesanan_laundry')->with('success,data berhasil di tambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(Pesanan_laundry $pesanan_laundry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pesanan_laundry $pesanan_laundry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $pesanan_laundry = Pesanan_laundry::find($id);

        if ($pesanan_laundry) {
            $validasi = $request->validate([
                'pelanggan_id' => 'required',
                'berat' => 'required',
                'tanggal_terima' => 'required',
                'tanggal_selesai' => 'required',
                'status' => 'required',
            ]);

         $harga_per_kg = 1000; // Ganti dengan harga per kilogram sesuai kebijakan Anda
        $total_tagihan = $request->berat * $harga_per_kg;

            $pesanan_laundry->update([
                'pelanggan_id' => $request->pelanggan_id,
                'berat' => $request->berat,
                'tanggal_terima' => $request->tanggal_terima,
                'tanggal_selesai' => $request->tanggal_selesai,
                'status' => $request->status,
            ]);

            return redirect()->route('pesanan_laundry')->with('success', 'Data berhasil di edit');
        } else {
            // Redirect dengan pesan flash
            return redirect()->route('pesanan_laundry')->with('error', 'Data tidak ditemukan');
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pesanan_laundry = Pesanan_laundry::find($id);

        if (!$pesanan_laundry) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $pesanan_laundry->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}
