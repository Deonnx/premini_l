<?php

namespace App\Http\Controllers;

use App\Models\Jenis_laundry;
use Exception;
use Illuminate\Http\Request;

class JenisLaundryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenis_laundry = Jenis_laundry::all();

        return view('tampilan_jenis_laundry.jenis_laundry' , compact('jenis_laundry'));
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
            'jenis_laundry' => 'required',
            'lama_proses' => 'required',
            'tarif' => 'required|numeric|min:0', // Validasi untuk angka tidak boleh negatif
        ], [
            'jenis_laundry.required' => 'Data jenis laundry harus diisi.',
            'lama_proses.required' => 'Data lama proses harus diisi.',
            'tarif.required' => 'Data tarif harus diisi.',
            'tarif.numeric' => 'Tarif harus berupa angka.',
            'tarif.min' => 'Tarif tidak boleh negatif.',
        ]);



        Jenis_laundry::create([
            'jenis_laundry' => $request->jenis_laundry,
            'lama_proses' => $request->lama_proses,
            'tarif' => $request->tarif,
        ]);

        return redirect()->route('jenis_laundry')->with('success','Data Berhasil Ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show(Jenis_laundry $jenis_laundry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jenis_laundry $jenis_laundry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $jenis_laundry = Jenis_laundry::find($id);

        $request->validate([
            'jenis_laundry' => 'required',
            'lama_proses' => 'required',
            'tarif' => 'required|numeric|min:0', // Validation to ensure "tarif" is not negative
        ], [
            'jenis_laundry.required' => 'Data jenis laundry harus diisi.',
            'lama_proses.required' => 'Data lama proses harus diisi.',
            'tarif.required' => 'Data tarif harus diisi.',
            'tarif.numeric' => 'Tarif harus berupa angka.',
            'tarif.min' => 'Tarif tidak boleh negatif.',
        ]);

        // ...


            $jenis_laundry->update([
                'jenis_laundry' => $request->jenis_laundry,
                'lama_proses' => $request->lama_proses,
                'tarif' => $request->tarif,
            ]);

            return redirect()->route('jenis_laundry')->with('success', 'Data berhasil di edit');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $jenis_laundry = Jenis_laundry::find($id);

            if (!$jenis_laundry) {
                return redirect()->route('jenis_laundry')->with('error', 'Data not found');
            }

            $jenis_laundry->delete();

            return redirect()->route('jenis_laundry')->with('success', 'Data berhasil dihapus');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data');
        }
    }
    }
