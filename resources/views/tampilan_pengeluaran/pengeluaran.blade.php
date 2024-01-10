@extends('auth.layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header" style="background-color: #fad0d7; text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h4>Data Pengeluaran</h4>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambah">
                        +Tambah Pengeluaran
                    </button>
                </div>
            </div>
            <div class="table-responsive mt-4 mt-xl-0">
                <table class="table table-pink table-striped table-nowrap align-middle mb-0"> <!-- Change table-success to table-pink -->
                    <thead style="background-color:  #fad0d7"> <!-- Light pink background color -->
                            <tr>
                                <th class="text-center">Nomer</th>
                                <th class="text-center">tanggal</th>
                                <th class="text-center">catatan</th>
                                <th class="text-center">pengeluaran</th>
                                <th class="text-center">Status</th>
                                
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
                                    {{-- <td>
                                        <div class="hstack gap-3 flex-wrap">
                                            <button type="button" data-bs-toggle="modal"
                                            data-bs-target="#editPengeluaran{{ $dp->id }}" class="btn btn-label"><i
                                                class="ri-edit-2-line"></i></button>

                                                <form id="delete-form-{{ $dp->id }}" action="{{ route('pengeluaran.destroy', $dp->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Yakin ingin menghapus data?')" style="border: none;">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </button>
                                                </form> --}}


                                                    </form>

                                                    <div class="modal" tabindex="-1" id="editPengeluaran{{ $dp->id }}">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit Pelanggan</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="post" action="{{ route('pengeluaran.update', $dp->id) }}" >
                                                                        @csrf
                                                                        @method('post')  <!-- Metode HTTP untuk update -->

                                                                            <div class="mb-3">
                                                                                <label for="tanggal" class="form-label">Tanggal</label>
                                                                                <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal', $dp->tanggal) }}">
                                                                                <div class="text-danger">
                                                                                    @error('tanggal')
                                                                                        {{ $message }}
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="catatan" class="form-label">Catatan</label>
                                                                                <textarea class="form-control" id="catatan" name="catatan">{{ old('catatan', $dp->catatan) }}</textarea>
                                                                                <div class="text-danger">
                                                                                    @error('catatan')
                                                                                        {{ $message }}
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="pengeluaran" class="form-label">Pengeluaran</label>
                                                                                <input type="number" class="form-control" id="pengeluaran" name="pengeluaran" value="{{ old('pengeluaran', $dp->pengeluaran) }}">
                                                                                <div class="text-danger">
                                                                                    @error('pengeluaran')
                                                                                        {{ $message }}
                                                                                    @enderror
                                                                                </div>
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
                <h5 class="modal-title">Tambah Pengeluaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('pengeluaran.store') }} " >
                    @csrf
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal">
                        <div class="text-danger">
                            @error('tanggal')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="catatan" class="form-label">Catatan</label>
                        <textarea class="form-control" id="catatan" name="catatan"></textarea>
                        <div class="text-danger">
                            @error('catatan')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="pengeluaran" class="form-label">Pengeluaran</label>
                        <input type="number" class="form-control" id="pengeluaran" name="pengeluaran">
                        <div class="text-danger">
                            @error('pengeluaran')
                                {{ $message }}
                            @enderror
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

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection
