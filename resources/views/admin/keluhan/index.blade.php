@extends('admin.layout')

@section('css')
@endsection

@section('content')
    @if (\Illuminate\Support\Facades\Session::has('success'))
        <script>
            Swal.fire("Berhasil!", '{{\Illuminate\Support\Facades\Session::get('success')}}', "success")
        </script>
    @endif
    <div class="d-flex align-items-center justify-content-between mb-3">
        <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Keluhan Mahasiswa</p>
        <ol class="breadcrumb breadcrumb-transparent mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Keluhan Mahasiswa
            </li>
        </ol>
    </div>
    <hr>
    <div class="w-100 p-2">
        <table id="table-data" class="display w-100 table table-bordered">
            <thead>
            <tr>
                <th width="5%" class="text-center">#</th>
                <th width="15%">Tanggal</th>
                <th width="20%">Nama Mahasiswa</th>
                <th width="10%" class="text-center">Kelas</th>
                <th>Keluhan</th>
                <th width="10%" class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $v)
                <tr>
                    <td width="5%" class="text-center">{{ $loop->index + 1 }}</td>
                    <td>{{ $v->tanggal }}</td>
                    <td>{{ $v->user->mahasiswa->nama }}</td>
                    <td class="text-center">{{ $v->user->mahasiswa->kelas->nama }}</td>
                    <td>{{ $v->deskripsi }}</td>
                    <td class="text-center">
                        <a href="{{ route('keluhan.detail', ['id' => $v->id]) }}"
                           data-id="{{ $v->id }}">Detail</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection

@section('js')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script type="text/javascript">
        function destroy(id) {
            let url = '{{ route('sarana.destroy') }}';
            AjaxPost(url, {id}, function () {
                window.location.reload();
            });
        }

        function eventDestroy() {
            $('.btn-delete').on('click', function (e) {
                e.preventDefault();
                let id = this.dataset.id;
                AlertConfirm('Apakah anda yakin menghapus?', 'Data yang dihapus tidak dapat dikembalikan!', function () {
                    destroy(id);
                })
            });
        }

        $(document).ready(function () {
            $('#table-data').DataTable({
                "fnDrawCallback": function (setting) {
                    eventDestroy();
                }
            });
            eventDestroy();
        });
    </script>
@endsection
