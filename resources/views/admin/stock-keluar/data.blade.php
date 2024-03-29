@extends('admin.layout')

@section('css')
@endsection

@section('content')
    @if (\Illuminate\Support\Facades\Session::has('success'))
        <script>
            Swal.fire("Berhasil!", '{{\Illuminate\Support\Facades\Session::get('success')}}', "success")
        </script>
    @endif
    <div class="container-fluid pt-3">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Persediaan Keluar</p>
            <ol class="breadcrumb breadcrumb-transparent mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Daftar Persediaan Keluar
                </li>
            </ol>
        </div>
        <div class="w-100 p-2">
            <p class="font-weight-bold mb-0">Filter Tanggal</p>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center w-50">
                    <input type="date" class="form-control" name="tgl1" id="tgl1" value="{{ date('Y-m-d') }}">
                    <span class="font-weight-bold mr-2 ml-2">S/D</span>
                    <input type="date" class="form-control" name="tgl2" id="tgl2" value="{{ date('Y-m-d') }}">
                </div>
                <div class="text-right">
                    <a href="#" class="btn btn-primary" id="btn-cetak">
                        <i class="fa fa-print mr-2"></i>
                        <span>Cetak</span>
                    </a>
                </div>
            </div>
            <table id="table-data" class="display w-100 table table-bordered">
                <thead>
                <tr>
                    <th width="5%" class="text-center f12">#</th>
                    <th width="15%" class="f12">Ruangan</th>
                    <th class="f12">Sarana / Prasarana</th>
                    <th width="15%" class="f12">Qty</th>
                    <th width="15%" class="f12">Keterangan</th>
                    <th width="15%" class="f12">Status</th>
                    <th width="15%" class="f12">Deskripsi</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script type="text/javascript">
        var table;

        function reload() {
            table.ajax.reload();
        }


        $(document).ready(function () {
            table = DataTableGenerator('#table-data', '/persediaan-keluar/data', [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                {data: 'ruangan.nama'},
                {data: 'sarana.name'},
                {data: 'qty'},
                {data: 'keterangan'},
                {
                    data: null, render: function (data) {
                        return data['status'] === 9 ? 'Terima' : 'Tolak';
                    }
                },
                {data: 'deskripsi'},
            ], [
                {
                    targets: '_all',
                    className: 'f12'
                }
            ], function (d) {
                d.tgl1 = $('#tgl1').val();
                d.tgl2 = $('#tgl2').val();
            }, {
                dom: 'ltipr',
            });
            $('#tgl1').on('change', function (e) {
                reload();
            });
            $('#tgl2').on('change', function (e) {
                reload();
            });
            $('#btn-cetak').on('click', function (e) {
                e.preventDefault();
                let tgl1 = $('#tgl1').val();
                let tgl2 = $('#tgl2').val();
                window.open('/persediaan-keluar/cetak?tgl1=' + tgl1 + '&tgl2=' + tgl2, '_blank');
            })
        });
    </script>
@endsection
