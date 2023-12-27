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
        $data_pengeluaran = Data_pengeluaran::all();

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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Data_laporan $data_laporan)
    {
        //
    }
}
