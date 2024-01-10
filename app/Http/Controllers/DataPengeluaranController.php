<?php

namespace App\Http\Controllers;

use App\Models\Data_pengeluaran;
use App\Models\Saldo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataPengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
   {
       $data_pengeluaran = Data_pengeluaran::orderBy('created_at', 'desc')->get();
   
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
        'pengeluaran' => 'required|numeric|min:0',
    ]);

    Data_pengeluaran::create([
        'tanggal' => $request->tanggal,
        'catatan' => $request->catatan,
        'pengeluaran' => $request->pengeluaran,
        'status' => 'pending', // Default status for new entry
    ]);

    return redirect()->route('pengeluaran')->with('success', 'Data Berhasil Ditambahkan');
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
    public function update(Request $request, $id)
{
    $data_pengeluaran = Data_pengeluaran::find($id);

    $request->validate([
        'tanggal' => 'required|date|date_format:Y-m-d',
        'catatan' => 'required',
        'pengeluaran' => 'required|numeric|min:0',
        'status' => 'required|in:pending,approved,rejected', // Validasi status
    ]);

    $data_pengeluaran->update([
        'tanggal' => $request->tanggal,
        'catatan' => $request->catatan,
        'pengeluaran' => $request->pengeluaran,
        'status' => $request->status,
    ]);

    return redirect()->route('pengeluaran')->with('success', 'Data berhasil di edit');
}

public function approve($id)
{
    $data_pengeluaran = Data_pengeluaran::find($id);

    if (!$data_pengeluaran) {
        return redirect()->route('pengeluaran')->with('error', 'Data not found');
    }

    $data_pengeluaran->update(['status' => 'approved']);

    return redirect()->route('pengeluaran')->with('success', 'Pengeluaran berhasil disetujui.');
}
    

    /**
     * Reject the specified resource.
     */
    public function reject($id)
{
    $data_pengeluaran = Data_pengeluaran::find($id);

    if (!$data_pengeluaran) {
        return redirect()->route('pengeluaran')->with('error', 'Data not found');
    }

    $data_pengeluaran->update(['status' => 'rejected']);

    return redirect()->route('pengeluaran')->with('success', 'Pengeluaran berhasil ditolak.');
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
