@extends('auth.layouts.app')

@section('content')

<div class="table-responsive mt-4 mt-xl-0">
    <table class="table table-pink table-striped table-nowrap align-middle mb-0">
        <thead style="background-color: #fad0d7">
            <tr>
                <th class="text-center">Nomer</th>
                <th class="text-center">Nama Pelanggan</th>
                <th class="text-center">Jenis Kelamin</th>
                <th class="text-center">Alamat</th>
                <th class="text-center">No Telephone</th>
                <th class="text-center">Foto Pelanggan</th>
            </tr>
        </thead>
        <tbody>
            @php
                $nomor = 1;
            @endphp
            @foreach ($pelanggan as $p)
                <tr>
                    <td class="text-center">{{ $nomor++ }}</td>
                    <td class="text-center">{{ $p->nama_pelanggan }}</td>
                    <td class="text-center">{{ $p->jenis_kelamin }}</td>
                    <td class="text-center">{{ $p->alamat }}</td>
                    <td class="text-center">{{ $p->no_telephone }}</td>
                    <td>
                    <img src="{{ asset('storage/' . $p->foto_pelanggan) }}" alt="" width="90"
                    height="80">
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