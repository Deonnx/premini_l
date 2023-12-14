<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembayaran= Pembayaran::with(['pelanggan'])->get();
        $pelanggan = Pelanggan::all();

        return view('tampilan_pembayaran.pembayaran',compact('pembayaran','pelanggan'));
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
            'total_tagihan' => 'required',
            'tanggal_pembayaran' => 'required', // 1
            'metode_pembayaran' => 'required', // 1
        ]);
        Pembayaran::create([
            'pelanggan_id' => $request->pelanggan_id,
             'total_tagihan' => $request->total_tagihan,
             'tanggal_pembayaran' => $request->tanggal_pembayaran,
             'metode_pembayaran' => $request->metode_pembayaran,
     ]);
     return redirect()->route('pembayaran');

     }

    /**
     * Display the specified resource.
     */
    public function show(Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $pembayaran = Pembayaran::find($id);

        if ($pembayaran) {
            $validasi = $request->validate([
                'pelanggan_id' => 'required',
                'total_tagihan' => 'required',
                'tanggal_pembayaran' => 'required',
                'metode_pembayaran' => 'required',
            ]);

            $pembayaran->update([
                'pelanggan_id' => $request->pelanggan_id,
                'total_tagihan' => $request->total_tagihan,
                'tanggal_pembayaran' => $request->tanggal_pembayaran,
                'metode_pembayaran' => $request->metode_pembayaran,
            ]);

            return redirect()->route('pembayaran')->with('success', 'Data berhasil di edit');
        } else {
            // Redirect dengan pesan flash
            return redirect()->route('pembayaran')->with('error', 'Data tidak ditemukan');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pembayaran = Pembayaran::find($id);

        if (!$pembayaran) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $pembayaran->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}
