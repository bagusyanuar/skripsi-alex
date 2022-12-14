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
        <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Persediaan Sarana / Prasarana</p>
        <ol class="breadcrumb breadcrumb-transparent mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Stock
            </li>
        </ol>
    </div>
    <div class="w-100 p-2">
        <div class="text-right mb-2 pr-3">
            <a href="{{ route('sarana.add_page') }}" class="btn btn-success"><i class="fa fa-print mr-1"></i><span
                    class="font-weight-bold">Cetak</span></a>
        </div>
        <table id="table-data" class="display w-100 table table-bordered">
            <thead>
            <tr>
                <th width="5%" class="text-center">#</th>
                <th>Ruangan</th>
                <th>Sarana / Prasarana</th>
                <th width="12%" class="text-center">Jumlah</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $v)
                <tr>
                    <td width="5%" class="text-center">{{ $loop->index + 1 }}</td>
                    <td>{{ $v->ruangan->nama }}</td>
                    <td>{{ $v->sarana->name }}</td>
                    <td class="text-center">{{ $v->qty }}</td>
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
