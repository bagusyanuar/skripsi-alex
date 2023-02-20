@extends('admin.layout')

@section('css')
    <link href="{{ asset('/adminlte/plugins/select2/select2.css') }}" rel="stylesheet">
    <style>
        .select2-selection {
            height: 40px !important;
            line-height: 40px !important;
        }
    </style>
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
        <div class="row align-items-end">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="form-group w-100">
                    <label for="ruangan">Ruangan</label>
                    <select class="select2" name="ruangan" id="ruangan" style="width: 100%;">
                        @foreach($ruangan as $v)
                            <option value="{{ $v->id }}">{{ $v->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-9 col-md-6 col-sm-12">
                <div class="text-right mb-2 pr-3">
                    <a href="#" target="_blank" class="btn btn-success" id="btn-cetak"><i
                            class="fa fa-print mr-1"></i><span
                            class="font-weight-bold">Cetak</span></a>
                </div>
            </div>
        </div>
        <table id="table-data" class="display w-100 table table-bordered">
            <thead>
            <tr>
                <th width="5%" class="text-center">#</th>
                <th>Sarana / Prasarana</th>
                <th width="12%" class="text-center">Jumlah</th>
            </tr>
            </thead>
            <tbody>
            {{--            @foreach($data as $v)--}}
            {{--                <tr>--}}
            {{--                    <td width="5%" class="text-center">{{ $loop->index + 1 }}</td>--}}
            {{--                    <td>{{ $v->ruangan->nama }}</td>--}}
            {{--                    <td>{{ $v->sarana->name }}</td>--}}
            {{--                    <td class="text-center">{{ $v->qty }}</td>--}}
            {{--                </tr>--}}
            {{--            @endforeach--}}
            </tbody>
        </table>
    </div>

@endsection

@section('js')
    <script src="{{ asset('/adminlte/plugins/select2/select2.js') }}"></script>
    <script src="{{ asset('/adminlte/plugins/select2/select2.full.js') }}"></script>
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

        let table;

        function reload() {
            table.ajax.reload();
        }

        $(document).ready(function () {
            $('.select2').select2({
                width: 'resolve'
            });
            table = DataTableGenerator('#table-data', '/{{ request()->path() }}', [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                {data: 'sarana.name'},
                {data: 'qty'},
            ], [
                {
                    targets: '_all',
                    className: 'f12'
                }
            ], function (d) {
                d.ruangan = $('#ruangan').val();
            }, {
                dom: 'ltipr',
            });
            $('#ruangan').on('change', function () {
                reload();
            });

            $('#btn-cetak').on('click', function (e) {
                e.preventDefault();
                let ruangan = $('#ruangan').val();
                let url = '{{ route('stock.cetak') }}?ruangan=' + ruangan;
                window.open(url, '_blank');
            });
        });
    </script>
@endsection
