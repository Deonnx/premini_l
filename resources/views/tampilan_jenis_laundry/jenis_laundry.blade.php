@extends('auth.layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header" style="background-color: #fad0d7; text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h4>Jenis Layanan Laundry</h4>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambah">
                        +Tambah Jenis Layanan
                    </button>
                </div>
            </div>
            <div class="table-responsive mt-4 mt-xl-0">
                <table class="table table-pink table-striped table-nowrap align-middle mb-0">
                    <thead style="background-color:  #fad0d7"> 
                            <tr>
                                <th class="text-center">Nomer</th>
                                <th class="text-center">Jenis Layanan Laundry</th>
                                <th class="text-center">Lama Proses</th>
                                <th class="text-center">Tarif</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $nomor = 1;
                            @endphp
                            @foreach ($jenis_laundry  as $jl)
                            <tr>
                                <td class="text-center">{{ $nomor++ }}</td>
                                <td class="text-center">{{ $jl['jenis_laundry'] }}</td>
                                <td class="text-center">{{ $jl['lama_proses'] }} Hari</td>
                                <td class="text-center">Rp. {{ number_format($jl['tarif']) }}</td>
                                <td>
                                        <div class="hstack gap-3 flex-wrap">
                                            <button type="button" data-bs-toggle="modal"
                                            data-bs-target="#editJenis_laundry{{ $jl->id }}" class="btn btn-label"><i
                                                class="ri-edit-2-line"></i></button>

                                                <form id="delete-form-{{ $jl->id }}" action="{{ route('jenis_laundry.destroy', $jl->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Yakin ingin menghapus data?')" style="border: none;">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </button>
                                                </form>


                                                    </form>

                                                    <div class="modal" tabindex="-1" id="editJenis_laundry{{ $jl->id }}">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit Jenis Layanan Laundry</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="post" action="{{ route('jenis_laundry.update', $jl->id) }}" >
                                                                        @csrf
                                                                        @method('post')  <!-- Metode HTTP untuk update -->

                                                                            <div class="mb-3">
                                                                                <label for="jenis_laundry" class="form-label">Jenis Layanan Laundry</label>
                                                                                <input type="text" class="form-control" id="jenis_laundry" name="jenis_laundry" value="{{ old('jenis_laundry', $jl->jenis_laundry) }}">
                                                                                <div class="text-danger">
                                                                                    @error('jenis_laundry')
                                                                                        {{ $message }}
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="lama_proses" class="form-label">Lama Proses (Hari) </label>
                                                                                <input type="number" class="form-control" id="lama_proses" name="lama_proses" value="{{ old('lama_proses', $jl->lama_proses) }}">
                                                                                <div class="text-danger">
                                                                                    @error('lama_proses')
                                                                                        {{ $message }}
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="tarif" class="form-label">Tarif (kg) </label>
                                                                                <input type="number" class="form-control" id="tarif" name="tarif" value="{{ old('tarif', $jl->tarif) }}">
                                                                                <div class="text-danger">
                                                                                    @error('tarif')
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
                <h5 class="modal-title">Tambah Jenis Layanan Laundry</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('jenis_laundry.store') }} " >
                    @csrf
                    <div class="mb-3">
                        <label for="jenis_laundry" class="form-label">Jenis Layanan Laundry</label>
                        <input type="text" class="form-control" id="jenis_laundry" name="jenis_laundry">
                        <div class="text-danger">
                            @error('jenis_laundry')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="lama_proses" class="form-label">Lama Proses (Hari) </label>
                        <input type="number" class="form-control" id="lama_proses" name="lama_proses">
                        <div class="text-danger">
                            @error('lama_proses')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="tarif" class="form-label">Tarif (kg) </label>
                        <input type="number" class="form-control" id="tarif" name="tarif">
                        <div class="text-danger">
                            @error('tarif')
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
