@extends('admin.layout')

@section('css')
@endsection

@section('content')
    @if (\Illuminate\Support\Facades\Session::has('success'))
        <script>
            Swal.fire("Berhasil!", '{{\Illuminate\Support\Facades\Session::get('success')}}', "success")
        </script>
    @endif

    @if (\Illuminate\Support\Facades\Session::has('failed'))
        <script>
            Swal.fire("Gagal", '{{\Illuminate\Support\Facades\Session::get('failed')}}', "error")
        </script>
    @endif
    <div class="d-flex align-items-center justify-content-between mb-3">
        <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Keluhan Mahasiswa</p>
        <ol class="breadcrumb breadcrumb-transparent mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('keluhan.index') }}">Keluhan Mahasiswa</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Detail
            </li>
        </ol>
    </div>
    <div class="w-100 p-2 mt-2">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-10 col-sm-11">
                <div class="card">
                    <div class="card-body">
                        <div class="w-100 mb-1">
                            <label for="mahasiswa" class="form-label">Nama Mahasiswa</label>
                            <input type="text" class="form-control" id="mahasiswa"
                                   name="mahasiswa" readonly value="{{ $data->user->mahasiswa->nama }}">
                        </div>
                        <div class="w-100 mb-1">
                            <label for="kelas" class="form-label">Kelas</label>
                            <input type="text" class="form-control" id="kelas" placeholder=""
                                   name="kelas" readonly value="{{ $data->user->mahasiswa->kelas->nama }}">
                        </div>
                        <div class="w-100 mb-1">
                            <label for="deskripsi" class="form-label">Keterangan</label>
                            <textarea rows="3" class="form-control" id="deskripsi" placeholder=""
                                      name="deskripsi" readonly>{{ $data->deskripsi }}</textarea>
                        </div>
                        <div class="w-100 mb-1">
                            <label for="file" class="form-label">Lampiran Gambar</label>
                            @if($data->file !== null)
                            @else
                                <div class="text-center" style="height: 200px;">
                                    <p class="font-weight-bold">Tidak Ada Lampiran Gambar</p>
                                </div>
                            @endif
                        </div>

                        <hr>

                        <form method="post">
                            @csrf
                            <div class="form-group w-100 mt-2">
                                <label for="status">Proses Permintaan</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="terima">Terima</option>
                                    <option value="tolak">Tolak</option>
                                </select>
                            </div>
                            <div class="form-group w-100 d-none" id="reason">
                                <label for="keterangan">Alasan</label>
                                <textarea class="form-control" rows="3" name="keterangan" id="keterangan"></textarea>
                            </div>
                            <div class="w-100 mb-2 mt-3 text-right">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#table-data').DataTable();
            $('#status').on('change', function () {
                let val = this.value;
                if (val === 'tolak') {
                    $('#reason').removeClass('d-none')
                    $('#reason').addClass('d-block')
                } else {
                    $('#reason').removeClass('d-block')
                    $('#reason').addClass('d-none')
                }
            })
        });
    </script>
@endsection
