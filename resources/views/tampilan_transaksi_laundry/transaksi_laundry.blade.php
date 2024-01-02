@extends('auth.layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header" style="background-color: #fad0d7; text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h4>Transaksi Laundry</h4>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambah">
                        +Tambah Transksi Laundry
                    </button>
                </div>
            </div>
            <div class="table-responsive mt-4 mt-xl-0">
                <table class="table table-pink table-striped table-nowrap align-middle mb-0">
                    <!-- Change table-success to table-pink -->
                    <thead style="background-color:  #fad0d7"> <!-- Light pink background color -->
                        <tr>
                            <th class="text-center">Nomer</th>
                            <th class="text-center">Nama Pelanggan</th>
                            <th class="text-center">Jenis Laundry</th>
                            <th class="text-center">Tarif</th>
                            <th class="text-center">Tanggal Selesai</th>
                            <th class="text-center">Jumlah (kg) </th>
                            <th class="text-center">Total Bayar </th>

                            <th class="text-center">Status </th>

                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $nomor = 1;
                        @endphp
                        @foreach ($transaksi_laundry as $tl)
                            <tr>
                                <td class="text-center">{{ $nomor++ }}</td>
                                <td class="text-center">{{ $tl->pelanggan->nama_pelanggan }}</td>
                                <td class="text-center">{{ $tl->jenis_laundry->jenis_laundry }}</td>
                                <td class="text-center">{{ $tl->jenis_laundry->tarif }}</td>
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
                                <td class="text-center">
                                    @if ($tl->status == 'lunas')
                                        <span class="badge badge-success text-black">Lunas</span>
                                    @else
                                        <span class="badge badge-warning text-black">Belum Lunas</span>
                                    @endif
                                </td>
                                {{-- <td class="text-center">
                                        @if ($tl->status_baju == 'sudah diambil')
                                            <span class="badge badge-success">Sudah Diambil</span>
                                        @else
                                            <span class="badge badge-warning">Belum Diambil</span>
                                        @endif
                                    </td> --}}

                                <td>
                                    {{-- <div class="hstack gap-3 flex-wrap">
                                            <button type="button" data-bs-toggle="modal"
                                            data-bs-target="#editTransaksilaundry{{ $tl->id }}" class="btn btn-label"><i
                                                class="ri-edit-2-line"></i></button> --}}

                                    <form id="delete-form-{{ $tl->id }}"
                                        action="{{ route('transaksi_laundry.destroy', $tl->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger"
                                            onclick="return confirm('Yakin ingin menghapus data?')" style="border: none;">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </form>


                                    </form>

                                    <div class="modal" tabindex="-1" id="editTransaksilaundry{{ $tl->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Transaksi Laundry</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post"
                                                        action="{{ route('transaksi_laundry.update', $tl->id) }}">
                                                        @csrf
                                                        @method('post') <!-- Metode HTTP untuk update -->

                                                        <div class="mb-3">
                                                            <label for="pelanggan_id" class="form-label">Nama
                                                                Pelanggan</label>
                                                            <select class="form-select" id="pelanggan_id"
                                                                name="pelanggan_id">
                                                                <option value="">Pilih Nama Pelanggan</option>
                                                                @foreach ($pelanggan as $p)
                                                                    <option value="{{ $p->id }}"
                                                                        {{ old('pelanggan_id', $tl->pelanggan_id) == $p->id ? 'selected' : '' }}>
                                                                        {{ $p->pelanggan_id }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <div class="text-danger">
                                                                @error('pelanggan_id')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="jenis_laundry_id" class="form-label">Jenis
                                                                Layanan</label>
                                                            <select class="form-select" id="jenis_laundry_id"
                                                                name="jenis_laundry_id">
                                                                <option value="">Pilih Jenis Layanan Laundry</option>
                                                                @foreach ($jenis_laundry as $jl)
                                                                    <option value="{{ $jl->id }}"
                                                                        {{ old('jenis_laundry_id', $tl->jenis_laundry_id) == $jl->id ? 'selected' : '' }}>
                                                                        {{ $jl->jenis_laundry_id }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <div class="text-danger">
                                                                @error('jenis_laundry_id')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="tarif" class="form-label">Tarif (kg)</label>
                                                            <input type="text" class="form-control tarif" name="tarif"
                                                                value="{{ old('tarif', $tl->tarif) }}" required readonly>
                                                            <div class="text-danger">
                                                                @error('tarif')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="tanggal_selesai" class="form-label">Tanggal
                                                                Selesai</label>
                                                            <input type="text" class="form-control tanggal_selesai"
                                                                name="tanggal_selesai"
                                                                value="{{ old('tanggal_selesai', $tl->tanggal_selesai) }}"
                                                                required readonly>
                                                            <div class="text-danger">
                                                                @error('tanggal_selesai')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </div>



                                                        <div class="form-group row">
                                                            <label for="jumlah_kelo" class="col-sm-2 col-form-label">Jumlah
                                                                (Kg)</label>
                                                            <div class="col-sm-10">
                                                                <input
                                                                    class="form-control @error('jumlah_kelo') is-invalid @enderror"
                                                                    type="text" name="jumlah_kelo"
                                                                    value="{{ old('jumlah_kelo', $tl->jumlah_kelo) }}"
                                                                    oninput="sum()" required />
                                                                @error('jumlah_kelo')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="total_bayar" class="form-label">Total Bayar</label>
                                                            <input type="number" class="form-control total_bayar"
                                                                name="total_bayar"
                                                                value="{{ old('total_bayar', $tl->total_bayar) }}"
                                                                required readonly>
                                                            <div class="text-danger">
                                                                @error('total bayar')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="catatan" class="form-label">Catatan</label>
                                                            <textarea class="form-control" id="catatan" name="catatan">{{ old('catatan', $tl->catatan) }}</textarea>
                                                            <div class="text-danger">
                                                                @error('catatan')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="status"
                                                                class="col-sm-2 col-form-label">Status</label>
                                                            <div class="col-sm-10">
                                                                <select name="status" class="select2 form-control">
                                                                    <option value="1"
                                                                        {{ old('status', $tl->status) == 1 ? 'selected' : '' }}>
                                                                        Lunas</option>
                                                                    <option value="0"
                                                                        {{ old('status', $tl->status) == 0 ? 'selected' : '' }}>
                                                                        Belum lunas</option>
                                                                </select>
                                                            </div>
                                                        </div>


                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Kembali</button>
                                                            <button type="submit" class="btn btn-primary">Simpan
                                                                Perubahan</button>

                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
            </div>

        </div>
        </td>
        </tr>
        @endforeach
        </tbody>
        </table>
    </div>
    </div>





    <!-- Modal Tambah -->
    <div class="modal" tabindex="-1" id="tambah">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Transaksi Laundry</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('transaksi_laundry.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                            <select class="form-select" id="nama_pelanggan" name="nama_pelanggan">
                                <option value="">Pilih Nama Pelanggan</option>
                                @foreach ($pelanggan as $p)
                                    <option value="{{ $p->id }}"
                                        {{ old('nama_pelanggan') == $p->id ? 'selected' : '' }}>
                                        {{ $p->nama_pelanggan }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="text-danger">
                                @error('nama_pelanggan')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="jenis_laundry" class="form-label">Jenis Layanan</label>
                            <select class="form-select" id="jenis_laundry" name="jenis_laundry"
                                onchange="jenis_layanan()">
                                <option value="">Pilih Jenis Layanan Laundry</option>
                                @foreach ($jenis_laundry as $jl)
                                    <option value="{{ $jl->id }}"
                                        {{ old('jenis_laundry') == $jl->id ? 'selected' : '' }}>
                                        {{ $jl->jenis_laundry }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="text-danger">
                                @error('jenis_laundry')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="tarif" class="form-label">Tarif (kg)</label>
                            <input type="text" class="form-control" id="tarif" name="tarif" required readonly>
                            <div class="text-danger">
                                @error('tarif')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                            <input type="text" class="form-control" id="tanggal_selesai" name="tanggal_selesai"
                                required readonly>
                            <div class="text-danger">
                                @error('tanggal_selesai')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jumlah_kelo" class="col-sm-2 col-form-label">Jumlah (Kg)</label>
                            <div class="col-sm-10">
                                <input class="form-control @error('jumlah_kelo') is-invalid @enderror" type="text" id="jumlah_kelo" name="jumlah_kelo" value="{{ old('jumlah_kelo') }}" required />
                                @error('jumlah_kelo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="total_bayar" class="form-label">Total Bayar</label>
                            <input type="text" class="form-control" id="total_bayar" name="total_bayar" required
                                readonly>
                            <div class="text-danger">
                                @error('total bayar')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="status" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <select name="status" class="select2 form-control">
                                    <option value="1">Lunas</option>
                                    <option value="0">Belum lunas</option>
                                </select>
                            </div>
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- resources/views/nama_view.blade.php -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#jenis_laundry').change(function() {
                var jenisLaundryId = $(this).val();

                $.ajax({
                    type: 'GET',
                    url: '/autofill',
                    data: {
                        jenis_laundry_id: jenisLaundryId
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#tarif').val(response.success.tarif);
                            $('#tanggal_selesai').val(response.success.tanggal_selesai);
                        } else {
                            alert(response.error);
                        }
                    },
                    error: function(error) {
                        console.log(error);
                        alert('Terjadi kesalahan saat mengambil data.');
                    }
                });
            });

            $('#jumlah_kelo').on('input', function() {
                sum();
            });

            function sum() {
                var jumlah_kelo = $('#jumlah_kelo').val();
                var tarif = $('#tarif').val();
                var total_bayar = parseInt(jumlah_kelo) * parseFloat(tarif);

                if (!isNaN(total_bayar)) {
                    $('#total_bayar').val(total_bayar);
                } else {
                    $('#total_bayar').val('');
                }
            }
        });
    </script>
    <!-- Pastikan ini tetap ada di akhir file -->
@endsection
