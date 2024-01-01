<?php

namespace App\Http\Controllers;

use App\Models\Jenis_laundry;
use App\Models\Pelanggan;
use App\Models\Transaksi_laundry;
use Exception;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class TransaksiLaundryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $transaksi_laundry = Transaksi_laundry::with(['pelanggan', 'jenis_laundry'])->get();
    $pelanggan = Pelanggan::all();
    $jenis_laundry = Jenis_laundry::all();
    return view('tampilan_transaksi_laundry.transaksi_laundry', compact('transaksi_laundry', 'pelanggan', 'jenis_laundry'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $pelanggan = Pelanggan::all();
    $jenis_laundry = Jenis_laundry::all(); // Fix variable name here

    return view('transaksi_laundry.create', compact('pelanggan', 'jenis_laundry'));
}

public function autofill(Request $request)
{
    try {
        $jenis_laundry_id = $request->get('jenis_laundry_id');
        $jenis_laundry = Jenis_laundry::find($jenis_laundry_id);

        if ($jenis_laundry) {
            $lama_proses = $jenis_laundry->lama_proses;
            $lama_proses = intval($lama_proses);

            // Pastikan $lama_proses adalah bilangan bulat atau dalam format yang benar
            $tanggal_selesai = now()->addDays($lama_proses)->toDateString();

            $data = [
                'success' => [
                    'tarif' => $jenis_laundry->tarif,
                    'tanggal_selesai' => $tanggal_selesai
                ]
            ];
        } else {
            $data = [
                'error' => 'Jenis laundry tidak ditemukan'
            ];
        }
    } catch (Exception $e) {
        $data = [
            'error' => 'Terjadi kesalahan'
        ];
    }

    return response()->json($data);
}
    // ... kode lain pada controller

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_pelanggan' => 'required|exists:pelanggans,id',
            'jenis_laundry' => 'required|exists:jenis_laundries,id',
            'tanggal_selesai' => 'required|date',
            'jumlah_kelo' => 'required|integer|min:1',
            'total_bayar' => 'required|numeric|min:0',
            'tarif' => 'required|numeric|min:0', // Tambahkan aturan validasi untuk tarif
            'catatan' => 'required|string',
            'status' => 'required|in:lunas,belum lunas',
            // 'status_baju' => 'required|in:sudah diambil,belum diambil',
        ], [
            'nama_pelanggan.required' => 'Kolom pelanggan harus diisi.',
            'jenis_laundry.required' => 'Kolom jenis laundry harus diisi.',
            'tarif.required' => 'Kolom tarif harus diisi.',
            'tarif.numeric' => 'Tarif harus berupa angka.',
            'tarif.min' => 'Tarif tidak boleh kurang dari 0.',
            'tanggal_selesai.required' => 'Kolom tanggal selesai harus diisi.',
            'jumlah_kelo.required' => 'Kolom jumlah kelo harus diisi.',
            'total_bayar.required' => 'Kolom total bayar harus diisi.',
            'catatan.required' => 'Kolom catatan harus diisi.',
            'status.required' => 'Kolom status harus diisi.',
            'status_baju.required' => 'Kolom status baju harus diisi.',
        ]);




        // Tentukan kondisi untuk status
        $status = $request->input('total_bayar') > 0 ? 'lunas' : 'belum lunas';

        // Tentukan kondisi untuk status_baju
        // $statusBaju = $request->input('status_baju') === 'sudah diambil' ? 'sudah diambil' : 'belum diambil';

        // $catatan = $request->input('catatan', '');

        // Create new transaksi laundry with status, status_baju, and catatan
        Transaksi_laundry::create([
            'pelanggan_id' => $request->input('nama_pelanggan'),
            'jenis_laundry_id' => $request->input('jenis_laundry'),
            'tarif' => $request->input('tarif'),
            'tanggal_selesai' => $request->input('tanggal_selesai'),
            'jumlah_kelo' => $request->input('jumlah_kelo'),
            'total_bayar' => $request->input('total_bayar'),
            // 'catatan' => $catatan,  // Use the modified 'catatan' variable
            'status' => $status,
            // 'status_baju' => $statusBaju,
        ]);

        // Redirect atau tampilkan pesan sukses
        return redirect()->route('transaksi_laundry')->with('success', 'Transaksi laundry berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Transaksi_laundry $transaksi_laundry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi_laundry $transaksi_laundry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $transaksi_laundry = Transaksi_laundry::findOrfail($id);

        if ($transaksi_laundry) {
            $request->validate([
                    'pelanggan_id' => 'required|exists:pelanggans,id',
                    'jenis_laundry_id' => 'required|exists:jenis_laundries,id',
                    'tanggal_selesai' => 'required|date',
                    'jumlah_kelo' => 'required|integer|min:1',
                    'total_bayar' => 'required|numeric|min:0',
                    'catatan' => 'required|string',
                    'status' => 'required|in:lunas,belum lunas',
                    // 'status_baju' => 'required|in:sudah diambil,belum diambil',
                ], [
                    'pelanggan_id.required' => 'Kolom pelanggan harus diisi.',
                    'jenis_laundry_id.required' => 'Kolom jenis laundry harus diisi.',
                    'tanggal_selesai.required' => 'Kolom tanggal selesai harus diisi.',
                    'jumlah_kelo.required' => 'Kolom jumlah kelo harus diisi.',
                    'total_bayar.required' => 'Kolom total bayar harus diisi.',
                    'catatan.required' => 'Kolom catatan harus diisi.',
                    'status.required' => 'Kolom status harus diisi.',
                    // 'status_baju.required' => 'Kolom status baju harus diisi.',
                ]);

                // Logika update data di sini

                // Redirect atau tampilkan pesan sukses
                return redirect()->route('transaksi_laundry')->with('success', 'Data berhasil diperbarui.');
            }
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
        $transaksi_laundry = Transaksi_laundry::find($id);

        if (!$transaksi_laundry) {
            return redirect()->route('transaksi_laundry')->with('error', 'Data not found');
        }

        $transaksi_laundry->delete();

        return redirect()->route('transaksi_laundry')->with('success', 'Data berhasil dihapus');
    } catch (Exception $e) {
        return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data');
    }
}
}
