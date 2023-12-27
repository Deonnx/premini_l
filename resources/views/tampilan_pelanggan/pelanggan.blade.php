@extends('auth.layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header" style="background-color: #fad0d7; text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h4>Data Pelanggan</h4>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambah">
                        +Tambah Pelanggan
                    </button>
                </div>
            </div>
            <div class="table-responsive mt-4 mt-xl-0">
                <table class="table table-pink table-striped table-nowrap align-middle mb-0"> <!-- Change table-success to table-pink -->
                    <thead style="background-color:  #fad0d7"> <!-- Light pink background color -->
                            <tr>
                                <th class="text-center">Nomer</th>
                                <th class="text-center">Nama Pelanggan</th>
                                <th class="text-center">Jenis Kelamin</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">No Telephone</th>
                                <th class="text-center">Foto Pelanggan</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $nomor = 1;
                            @endphp
                            @foreach ($pelanggan  as $p)
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
                                    <td>
                                        <div class="hstack gap-3 flex-wrap">
                                            <button type="button" data-bs-toggle="modal"
                                            data-bs-target="#editPelanggan{{ $p->id }}" class="btn btn-label"><i
                                                class="ri-edit-2-line"></i></button>

                                                <form id="delete-form-{{ $p->id }}" action="{{ route('pelanggan.destroy', $p->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Yakin ingin menghapus data?')" style="border: none;">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </button>
                                                </form>


                                                    </form>

                                                    <div class="modal" tabindex="-1" id="editPelanggan{{ $p->id }}">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit Pelanggan</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="post" action="{{ route('pelanggan.update', $p->id) }}" enctype="multipart/form-data">
                                                                        @csrf
                                                                        @method('post')  <!-- Metode HTTP untuk update -->

                                                                            <div class="mb-3">
                                                                                <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                                                                                <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" value="{{ old('nama_pelanggan', $p->nama_pelanggan) }}">
                                                                                <div class="text-danger"></div>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="perempuan" {{ old('jenis_kelamin', $p->jenis_kelamin) == 'perempuan' ? 'checked' : '' }}>
                                                                                    <label class="form-check-label" for="perempuan">
                                                                                        Perempuan
                                                                                    </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki_laki" value="laki_laki" {{ old('jenis_kelamin', $p->jenis_kelamin) == 'laki_laki' ? 'checked' : '' }}>
                                                                                    <label class="form-check-label" for="laki_laki">
                                                                                        Laki-laki
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="alamat" class="form-label">Alamat</label>
                                                                                <textarea class="form-control" id="alamat" name="alamat">{{ old('alamat', $p->alamat) }}</textarea>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="no_telephone" class="form-label">No Telephone</label>
                                                                                <input type="number" class="form-control" id="no_telephone" name="no_telephone" value="{{ old('no_telephone', $p->no_telephone) }}">
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="foto_pelanggan{{ $p->id }}">Foto pelanggan</label>
                                                                                <input type="file" class="form-control" id="foto_pelanggan{{ $p->id }}" name="foto_pelanggan">
                                                                                <div>
                                                                                    <div>
                                                                                        <p><strong>Foto Sebelumnya:</strong></p>
                                                                                        <img src="{{ asset('storage/' . $p->foto_pelanggan) }}" id="foto_pelanggan" width="90" height="80">
                                                                                        <input type="hidden" name="current_foto" value="{{ $p->foto_pelanggan }}">
                                                                                </div>
                                                                                <div class="text-danger">
                                                                                    @error('foto_pelanggan')
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
                <h5 class="modal-title">Tambah Pelanggan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('pelanggan.store') }} " enctype="multipart/form-data" >
                    @csrf
                    <div class="mb-3">
                        <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                        <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan">
                        <div class="text-danger">
                            @error('nama_pelanggan')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <div class="form-check">
                            <input class="form-check-input @error('jenis_kelamin') is-invalid @enderror" type="radio" name="jenis_kelamin" id="perempuan" value="perempuan" {{ old('jenis_kelamin') == 'perempuan' ? 'checked' : '' }}>
                            <label class="form-check-label" for="perempuan">Perempuan</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input @error('jenis_kelamin') is-invalid @enderror" type="radio" name="jenis_kelamin" id="laki_laki" value="laki_laki" {{ old('jenis_kelamin') == 'laki_laki' ? 'checked' : '' }}>
                            <label class="form-check-label" for="laki_laki">Laki-laki</label>
                        </div>
                        <div class="text-danger">
                            @error('jenis_kelamin')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat"></textarea>
                        <div class="text-danger">
                            @error('alamat')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="no_telephone" class="form-label">No Telephone</label>
                        <input type="number" class="form-control" id="no_telephone" name="no_telephone">
                        <div class="text-danger">
                            @error('no_telephone')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class ="mb-3">
                        <label for="foto_pelanggan" class="form-label">Foto pelanggan</label>
                        <input type="file" class="form-control"id="foto_pelanggan" name="foto_pelanggan">
                        <div class="text-danger">
                            @error('foto_pelanggan')
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

{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function hapus(id) {
        Swal.fire({
            title: 'Yakin?',
            text: 'Data akan dihapus',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script> --}}

