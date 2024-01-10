<?php

namespace App\Http\Controllers;

use App\Models\DataLaundry;
use App\Models\Transaksi_laundry;
use Illuminate\Http\Request;

class DataLaundryController extends Controller
{
    public function index()
    {
        $transaksi_laundry = Transaksi_laundry::all();
        return view('tampilan_data_laundry.data_laundry', compact('transaksi_laundry'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data_laundry.create');
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
    public function show(DataLaundry $datalaundry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataLaundry $datalaundry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataLaundry $datalaundry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataLaundry $datalaundry)
    {
        //
    }
}

