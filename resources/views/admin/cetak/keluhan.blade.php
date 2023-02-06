@extends('admin.cetak.index')

@section('content')
    <div class="text-center report-title">LAPORAN KELUHAN MAHASISWA</div>
    <div class="text-center text-body font-weight-bold">Periode {{ $tgl1 }} - {{ $tgl2 }}</div>
    <table id="my-table" class="table display" style="margin-top: 10px">
        <thead>
        <tr>
            <th width="5%" class="text-center f12 text-body-small">#</th>
            <th width="10%" class="f12 text-body-small text-center">Tanggal</th>
            <th class="f12 text-body-small">Nama Mahasiswa</th>
            <th width="10%" class="f12 text-body-small text-center">Kelas</th>
            <th class="f12 text-body-small">Keluhan</th>
            <th width="10%" class="f12 text-body-small text-center">Status</th>
            <th class="f12 text-body-small">Keterangan</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $v)
            <tr>
                <td width="5%" class="text-center text-body-small">{{ $loop->index + 1 }}</td>
                <td class="text-body-small text-center">{{ $v->tanggal }}</td>
                <td class="text-body-small">{{ $v->user->mahasiswa->nama }}</td>
                <td class="text-body-small text-center">{{ $v->user->mahasiswa->kelas->nama }}</td>
                <td class="text-body-small">{{ $v->deskripsi }}</td>
                <td class="text-center text-body-small">{{ $v->status == 9 ? 'Terima' : 'Tolak' }}</td>
                <td class="text-body-small">{{ $v->keterangan }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
