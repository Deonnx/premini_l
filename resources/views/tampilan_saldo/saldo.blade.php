@extends('auth.layouts.app')

@section('content')

<div class="table-responsive mt-4 mt-xl-0">
    <table class="table table-pink table-striped table-nowrap align-middle mb-0">
        <thead style="background-color: #fad0d7">
            <tr>
                <th class="text-center">Saldo Information</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <p><strong>Total Transaksi Laundry:</strong> Rp. {{ number_format($totalTransaksiLaundry, 0, ',', '.') }}</p>
                    <p><strong>Total Pengeluaran:</strong> Rp. {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
                    <p><strong>Saldo Akhir:</strong> Rp. {{ number_format($saldoAkhir, 0, ',', '.') }}</p>
                </td>
            </tr>
        </tbody>
    </table>

    {{-- <form action="{{ route('saldo.update') }}" method="post">
        @csrf
        <button type="submit" class="btn btn-primary">Update Saldo</button>
    </form> --}}
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection
