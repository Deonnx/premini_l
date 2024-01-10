<?php

namespace App\Http\Controllers;

use App\Models\Data_pengeluaran;
use App\Models\Pelanggan;
use App\Models\Saldo;
use App\Models\Transaksi_laundry;
use Illuminate\Http\Request;

class DahboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Calculate total transaksi laundry
        $totalTransaksiLaundry = Transaksi_laundry::sum('total_bayar');

        // Calculate total pengeluaran
        $totalPengeluaran = Data_pengeluaran::sum('pengeluaran');

        // Calculate saldo
        $saldoAkhir = max(0, $totalTransaksiLaundry - $totalPengeluaran);

        // Get counts for other data
        $pesananL = Transaksi_laundry::count();
        $pengeluaran = Data_pengeluaran::count();
        $pelanggan = Pelanggan::count();

        return view('dasbroad', compact('pesananL', 'pengeluaran', 'pelanggan', 'saldoAkhir'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}





