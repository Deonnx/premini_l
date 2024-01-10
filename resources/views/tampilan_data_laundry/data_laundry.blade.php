@extends('auth.layouts.app')

@section('content')

<div class="table-responsive mt-4 mt-xl-0">
    <table class="table table-pink table-striped table-nowrap align-middle mb-0">
        <thead style="background-color: #fad0d7">
            <tr>
                <th class="text-center">Nomer</th>
                <th class="text-center">Nama Pelanggan</th>
                <th class="text-center">Jenis Laundry</th>
                <th class="text-center">Tarif</th>
                <th class="text-center">Tanggal Selesai</th>
                <th class="text-center">Jumlah (kg) </th>
                <th class="text-center">Total Bayar </th>

                <th class="text-center">Status </th>

            </tr>
        </thead>
        <tbody>
            @php
                $nomor = 1;
            @endphp
            @foreach ($transaksi_laundry as $tl)
                <tr>
                    <td class="text-center">{{ $nomor++ }}</td>
                    <td class="text-center">{{ $tl->data_pelanggan->nama_pelanggan }}</td>
                    <td class="text-center">{{ $tl->jenis_laundry->jenis_laundry }}</td>
                    <td class="text-center">Rp.{{ number_format($tl->jenis_laundry->tarif, 0, ',','.')}}</td>
                    <td class="text-center">
                        {{ \Carbon\Carbon::parse($tl->tanggal_selesai)->formatLocalized('%d %B %Y') }}
                    </td>

                    <td class="text-center">{{ $tl->jumlah_kelo }}</td>
                    <td class="text-center">
                        @php
                            $tarifPerKelo = $tl->jenis_laundry->tarif; // Ambil tarif dari jenis laundry terkait
                            $totalBayar = $tarifPerKelo * $tl->jumlah_kelo;
                            echo 'Rp ' . number_format($totalBayar, 0, ',', '.');
                        @endphp
                    </td>
                    {{-- <td class="text-center">{{ $tl->catatan }}</td> --}}
                    <td class=" fs-4 text-center">
                        @if ($tl->status == 'lunas')
                            <span class="badge badge-success text-black">Lunas</span>
                        @else
                            <span class="badge badge-warning text-black">Belum Lunas</span>
                        @endif
                    </td>
                </tr>
        @endforeach
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection
