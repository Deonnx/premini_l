<?php

namespace App\Http\Controllers;

// use App\Models\Data_penarikan;
use App\Models\Saldo;
use App\Models\Transaksi_laundry;
use App\Models\Data_pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaldoController extends Controller
{
    public function index()
    {
        // Get the authenticated user
        $user = auth()->user();

        // Get or create the saldo entry for the user
        $saldo = $user->saldo ?? new Saldo();

        // Calculate total transaksi laundry
        $totalTransaksiLaundry = Transaksi_Laundry::sum('total_bayar');

        // Calculate total pengeluaran
        $totalPengeluaran = Data_pengeluaran::sum('pengeluaran');

        // Calculate total penarikan yang sudah diapprove
        // $totalPenarikan = Data_penarikan::where('status', 'acc')->sum('jumlah_penarikan');

        // Calculate saldo
        $saldoAkhir = max(0, $totalTransaksiLaundry - $totalPengeluaran );

        // Pass the calculated values to the view
        return view('tampilan_saldo.saldo', compact('saldo', 'totalTransaksiLaundry', 'totalPengeluaran', 'saldoAkhir'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('saldo.create');
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
    public function show(Saldo $saldo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Saldo $saldo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateSaldo()
    {
        try {
            // Begin a database transaction
            DB::beginTransaction();

            // Calculate total transaksi laundry
            $totalTransaksiLaundry = TransaksiLaundry::sum('total_bayar');

            // Calculate total pengeluaran
            $totalPengeluaran = DataPengeluaran::sum('pengeluaran');

            // Calculate total penarikan yang sudah diapprove
            $totalPenarikan = DataPenarikan::where('status', 'acc')->sum('jumlah_penarikan');

            // Calculate saldo
            $saldoAkhir = $totalTransaksiLaundry - $totalPengeluaran - $totalPenarikan;

            // Get the authenticated user
            $user = auth()->user();

            // Get or create the saldo entry for the user
            $saldo = $user->saldo ?? new Saldo();

            // Update or create a new saldo entry
            $saldo->update([
                'jumlah' => $saldoAkhir,
                'user_id' => $user->id,
            ]);

            // Commit the database transaction
            DB::commit();

            // Redirect or show success message
            return redirect()->route('saldo')->with('success', 'Saldo berhasil diperbarui.');
        } catch (\Exception $e) {
            // Rollback the database transaction in case of an error
            DB::rollback();

            // Redirect or show error message
            return redirect()->route('saldo')->with('error', 'Terjadi kesalahan saat memperbarui saldo.');
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Saldo $saldo)
    {
        //
    }
}