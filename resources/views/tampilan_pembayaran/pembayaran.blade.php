@extends('auth.layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header" style="background-color: #fad0d7; text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h4>Pembayaran</h4>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambah">
                        +Tambah Pembayaran
                    </button>
                </div>
            </div>
            <div class="table-responsive mt-4 mt-xl-0">
                <table class="table table-pink table-striped table-nowrap align-middle mb-0"> <!-- Change table-success to table-pink -->
                    <thead style="background-color:  #fad0d7"> <!-- Light pink background color -->
                            <tr>
                                <th class="text-center">Nomer</th>
                                <th class="text-center">Nama Pelanggan</th>
                                <th class="text-center">Total Tagihan</th>
                                <th class="text-center">Tanggal Pembayaran</th>
                                <th class="text-center">Metode Pembayaran</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $nomor = 1;
                            @endphp
                            @foreach ($pembayaran  as $pb)
                                <tr>
                                    <td class="text-center">{{ $nomor++ }}</td>
                                    <td class="text-center">{{ $pb->Pelanggan->nama_pelanggan }}</td>
                                    <td class="text-center">{{ $pb->total_tagihan }}</td>
                                    <td class="text-center">{{ $pb->tanggal_pembayaran }}</td>
                                    <td class="text-center">{{ $pb->metode_pembayaran }}</td>
                                    <td>
                                        <div class="hstack gap-3 flex-wrap">
                                            <button type="button" data-bs-toggle="modal"
                                            data-bs-target="#editPembayaran{{ $pb->id }}" class="btn btn-label"><i
                                                class="ri-edit-2-line"></i></button>

                                                    <form id="delete-form-{{ $pb->id }}" action="{{ route('pembayaran.destroy', $pb->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger" onclick="hapus({{ $pb->id }})" style="border: none;">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </button>

                                                    </form>

                                                    <div class="modal" tabindex="-1" id="editPembayaran{{ $pb->id }}">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit Pelanggan</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="post" action="{{ route('pembayaran.update', $pb->id) }}">
                                                                        @csrf
                                                                        @method('post')  <!-- Metode HTTP untuk update -->

                                                                        <div class="mb-3">
                                                                            <label for="nama_pelanggan{{ $pb->id }}" class="form-label">Nama Pelanggan</label>
                                                                            <select class="form-select" id="nama_pelanggan{{ $pb->id }}" name="pelanggan_id">
                                                                                <option value="">Pilih Nama Pelanggan</option>
                                                                                @foreach ($pelanggan as $p)
                                                                                    <option value="{{ $p->id }}" {{ $p->id === $pb->pelanggan_id ? 'selected' : '' }}>
                                                                                        {{ $p->nama_pelanggan }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                            <div class="text-danger"></div>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label for="total_tagihan" class="form-label">Total Tagihan</label>
                                                                            <input type="number" class="form-control" id="total_tagihan" name="total_tagihan" value="{{ old('total_tagihan', $pb->total_tagihan) }}">
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label for="tanggal_pembayaran" class="form-label">Tanggal Pembayaran</label>
                                                                            <input type="date" class="form-control" id="tanggal_pembayaran" name="tanggal_pembayaran" value="{{ old('tanggal_pembayaran', $pb->tanggal_pembayaran) }}">
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                                                                            <select class="form-control" id="metode_pembayaran" name="metode_pembayaran">
                                                                                <option value="transfer" {{ old('metode_pembayaran') == 'transfer' ? 'selected' : '' }}>Transfer</option>
                                                                                <option value="kredit" {{ old('metode_pembayaran') == 'kredit' ? 'selected' : '' }}>Kredit</option>
                                                                                <option value="tunai" {{ old('metode_pembayaran') == 'tunai' ? 'selected' : '' }}>Tunai</option>
                                                                                <!-- Tambahkan opsi metode pembayaran lain sesuai kebutuhan -->
                                                                            </select>
                                                                        </div>

                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
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
                <h5 class="modal-title">Tambah Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('pembayaran.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                        <select class="form-select" id="nama_pelanggan" name="pelanggan_id">
                            <option value="">Pilih Nama Pelanggan</option>
                            @foreach ($pelanggan as $p)
                                <option value="{{ $p->id }}">{{ $p->nama_pelanggan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="total_tagihan" class="form-label">Total Tagihan</label>
                        <input type="number" class="form-control" id="total_tagihan" name="total_tagihan">
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_pembayaran" class="form-label">Tanggal Pembayaran</label>
                        <input type="date" class="form-control" id="tanggal_pembayaran" name="tanggal_pembayaran">
                    </div>
                    <div class="mb-3">
                        <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                        <select class="form-control" id="metode_pembayaran" name="metode_pembayaran">
                            <option value="transfer">Transfer</option>
                            <option value="kredit">Kredit</option>
                            <option value="tunai">Tunai</option>
                            <!-- Tambahkan opsi metode pembayaran lain sesuai kebutuhan -->
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
</div>

@endsection
