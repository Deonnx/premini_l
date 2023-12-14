@extends('auth.layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header" style="background-color: #fad0d7; text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h4>Pesanan Laundry</h4>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambah">
                        +Tambah Pesanan
                    </button>
                </div>
            </div>
            <div class="table-responsive mt-4 mt-xl-0">
                <table class="table table-pink table-striped table-nowrap align-middle mb-0">
                    <thead style="background-color: #fad0d7">
                        <tr>
                            <th class="text-center">Nomer</th>
                            <th class="text-center">Nama Pelanggan</th>
                            <th class="text-center">Berat</th>
                            <th class="text-center">Tanggal Terima</th>
                            <th class="text-center">Tanggal Selesai</th>
                            <th class="text-center">Status Baju
                            </th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $nomor = 1;
                        @endphp
                        @foreach ($pesanan_laundry as $pl)
                            <tr>
                                <td class="text-center">{{ $nomor++ }}</td>
                                <td class="text-center">{{ $pl->Pelanggan->nama_pelanggan }}</td>
                                <td class="text-center">{{ $pl->berat }}</td>
                                <td class="text-center">{{ $pl->tanggal_terima }}</td>
                                <td class="text-center">{{ $pl->tanggal_selesai }}</td>
                                <td class="text-center">{{ $pl->status }}</td>
                                <td>
                                    <div class="hstack gap-3 flex-wrap">
                                        <button type="button" data-bs-toggle="modal"
                                            data-bs-target="#editlaundry{{ $pl->id }}" class="btn btn-label"><i
                                                class="ri-edit-2-line"></i></button>

                                        <form id="delete-form-{{ $pl->id }}"
                                            action="{{ route('pesanan_laundry.destroy', $pl->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger"
                                                onclick="hapus({{ $pl->id }})" style="border: none;">
                                                <i class="ri-delete-bin-line"></i>
                                            </button>
                                        </form>

                                        <div class="modal" tabindex="-1" id="editlaundry{{ $pl->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Pesanan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post"
                                                            action="{{ route('pesanan_laundry.update', $pl->id) }}">
                                                            @csrf
                                                            @method('post') <!-- Metode HTTP untuk update -->

                                                            <div class="mb-3">
                                                                <label for="nama_pelanggan{{ $pl->id }}"
                                                                    class="form-label">Nama Pelanggan</label>
                                                                <select class="form-select" id="{{ $pl->id }}"
                                                                    name="pelanggan_id">
                                                                    <option value="">Pilih Nama Pelanggan</option>
                                                                    @foreach ($pelanggan as $p)
                                                                        <option value="{{ $p->id }}"
                                                                            {{ $p->id === $pl->pelanggan_id ? 'selected' : '' }}>
                                                                            {{ $p->nama_pelanggan }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="berat" class="form-label">Berat</label>
                                                                <input type="number" class="form-control" id="berat"
                                                                    name="berat" value="{{ old('berat', $pl->berat) }}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="tanggal_terima" class="form-label">Tanggal
                                                                    Terima</label>
                                                                <input type="date" class="form-control"
                                                                    id="tanggal_terima" name="tanggal_terima"
                                                                    value="{{ old('tanggal_terima', $pl->tanggal_terima) }}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="tanggal_selesai" class="form-label">Tanggal
                                                                    Selesai</label>
                                                                <input type="date" class="form-control"
                                                                    id="tanggal_selesai" name="tanggal_selesai"
                                                                    value="{{ old('tanggal_selesai', $pl->tanggal_selesai) }}">
                                                            </div>

                                                            <div class="mb-5">
                                                                <label for="status" class="form-label">Status Baju </label>
                                                                <select class=" form-select form-control" id="status_pembayaran" name="status">
                                                                    <option value="" {{ old('status', $pl->status) == '' ? 'selected' : '' }}>Pilih Status Baju</option>
                                                                    <option value="belum_selesai" {{ old('status', $pl->status) == 'belum_selesai' ? 'selected' : '' }}>
                                                                       Sudah Diambil
                                                                    </option>
                                                                    <option value="selesai" {{ old('status', $pl->status) == 'selesai' ? 'selected' : '' }}>
                                                                       Belum Diambil
                                                                    </option>
                                                                </select>
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
                    <h5 class="modal-title">Tambah Pesanan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('pesanan_laundry.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                            <select class="form-select form-control" id="nama_pelanggan" name="pelanggan_id">
                                <option value="">Pilih Nama Pelanggan</option>
                                @foreach ($pelanggan as $p)
                                    <option value="{{ $p->id }}">{{ $p->nama_pelanggan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="berat" class="form-label">Berat</label>
                            <input type="number" class="form-control" id="berat" name="berat">
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_terima" class="form-label">Tanggal Terima</label>
                            <input type="date" class="form-control" id="tanggal_terima" name="tanggal_terima">
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                            <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai">
                        </div>
                        <div class="mb-3">
                            <label for="status_pembayaran" class="form-label">Status Baju</label>
                            <select class=" form-select form-control" id="status_pembayaran" name="status" onchange="updateStatusStyle()">
                                <option value="" disabled selected>Pilih Status Baju</option>
                                <option value="sudah_diambil">Sudah Diambil</option>
                                <option value="belum_diambil">Belum Diambil</option>
                            </select>
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
@endsection
