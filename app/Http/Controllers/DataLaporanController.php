<?php

namespace App\Http\Controllers;

use App\Models\Data_laporan;
use App\Models\Data_pengeluaran;
use Illuminate\Http\Request;

class DataLaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

        // Mengambil data laporan dengan data pengeluaran
        public function index()
        {
            $data_pengeluaran = Data_pengeluaran::orderBy('created_at', 'desc')->get();
    
            return view('tampilan_data_laporan.data_laporan', compact('data_pengeluaran'));
        }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data_laporan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Data_laporan $data_laporan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Data_laporan $data_laporan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Data_laporan $data_laporan)
    {
        //
    }

    public function approve(Request $request, $id)
    {
        $data_pengeluaran = Data_pengeluaran::find($id);

        if (!$data_pengeluaran) {
            return redirect()->route('data_laporan.index')->with('error', 'Data not found');
        }

        // Lakukan logika bisnis atau aksi yang sesuai dengan persetujuan
        // Misalnya, tambahkan saldo atau lakukan operasi lain sesuai kebutuhan

        // Set status menjadi 'approved'
        $data_pengeluaran->update(['status' => 'approved']);

        return redirect()->route('data_laporan.index')->with('success', 'Request berhasil disetujui.');
    }

    /**
     * Reject the specified resource.
     */
    public function reject(Request $request, $id)
    {
        $data_pengeluaran = Data_pengeluaran::find($id);

        if (!$data_pengeluaran) {
            return redirect()->route('data_laporan.index')->with('error', 'Data not found');
        }

        // Lakukan logika bisnis atau aksi yang sesuai dengan penolakan
        // Misalnya, kirim notifikasi atau lakukan operasi lain sesuai kebutuhan

        // Set status menjadi 'rejected'
        $data_pengeluaran->update(['status' => 'rejected']);

        return redirect()->route('data_laporan.index')->with('success', 'Request berhasil ditolak.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Data_laporan $data_laporan)
    {
        //
    }
}
