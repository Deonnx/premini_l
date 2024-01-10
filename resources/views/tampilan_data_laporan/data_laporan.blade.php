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
                <th class="text-center">Status</th>
                <th class="text-center">Aksi</th> <!-- Tambah kolom untuk aksi -->
            </tr>
        </thead>
        <tbody>
            @php
                $nomor = 1;
            @endphp
            @foreach ($data_pengeluaran as $dp)
                <tr>
                    <td class="text-center">{{ $nomor++ }}</td>
                    <td class="text-center">
                        {{ \Carbon\Carbon::parse($dp->tanggal)->formatLocalized('%d %B %Y') }}
                    </td>
                    <td class="text-center">{{ $dp->catatan }}</td>
                    <td class="text-center">Rp {{ number_format($dp->pengeluaran, 0, ',', '.') }}</td>
                    <td class="text-center">{{ ucfirst($dp->status) }}</td>
                <td class="text-center">
                    <div class="btn-group">
                        @if ($dp->status === 'pending')
                            <form method="POST" action="{{ route('pengeluaran.approve', $dp->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-success mx-1">Terima</button>
                            </form>
                            <form method="POST" action="{{ route('pengeluaran.reject', $dp->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-danger mx-1">Tolak</button>
                            </form>
                        @else
                            @if ($dp->status === 'approved')
                                <span class="text-success">Sudah Di terima</span>
                            @elseif ($dp->status === 'rejected')
                                <span class="text-danger">Sudah Di tolak</span>
                            @endif
                        @endif
                    </div>
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
