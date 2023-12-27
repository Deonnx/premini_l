@extends('auth.layouts.app')

@section('content')

<div class="table-responsive mt-4 mt-xl-0">
    <table class="table table-pink table-striped table-nowrap align-middle mb-0">
        <thead style="background-color: #fad0d7">
            <tr>
                <th class="text-center">Nomer</th>
                <th class="text-center">Tanggal</th>
                <th class="text-center">Catatan</th>
                <th class="text-center">Pengeluaran</th>
            </tr>
        </thead>
        <tbody>
            @php
                $nomor = 1;
            @endphp
            @foreach ($data_pengeluaran as $dp)
                <tr>
                    <td class="text-center">{{ $nomor++ }}</td>
                    <td class="text-center">{{ $dp->tanggal }}</td>
                    <td class="text-center">{{ $dp->catatan }}</td>
                    <td class="text-center">Rp {{ number_format($dp->pengeluaran, 0, ',', '.') }}</td>
                  
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection
