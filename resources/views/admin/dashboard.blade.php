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
            <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Dashboard</p>
            <ol class="breadcrumb breadcrumb-transparent mb-0">
                <li class="breadcrumb-item active" aria-current="page">Dashboard
                </li>
            </ol>
        </div>
        <div class="d-flex justify-content-center align-items-center" style="height: 400px;">
            <div class="text-center">
                <img src="{{ asset('assets/icon/logo.png') }}" height="300" alt="logo">
                <p class="font-weight-bold">Sistem Informasi Sarana dan Prasarana STMIK AUB SURAKARTA</p>
            </div>

        </div>
    </div>

@endsection

@section('js')
    <script type="text/javascript">
    </script>
@endsection
