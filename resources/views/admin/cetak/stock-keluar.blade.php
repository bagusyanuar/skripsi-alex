@extends('admin.cetak.index')

@section('content')
    <div class="text-center report-title">LAPORAN SARANA DAN PRASARANA KELUAR</div>
    <div class="text-center text-body font-weight-bold">Periode {{ $tgl1 }} - {{ $tgl2 }}</div>
    <table id="my-table" class="table display" style="margin-top: 10px">
        <thead>
        <tr>
            <th width="5%" class="text-center f12 text-body-small">#</th>
            <th width="10%" class="f12 text-body-small">Tanggal</th>
            <th class="f12 text-body-small">Ruangan</th>
            <th class="f12 text-body-small">Sarana / Prasarana</th>
            <th width="10%" class="f12 text-body-small text-center">Qty</th>
            <th class="f12 text-body-small">Keterangan</th>
            <th width="10%" class="f12 text-body-small text-center">Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $v)
            <tr>
                <td width="5%" class="text-center text-body-small">{{ $loop->index + 1 }}</td>
                <td class="text-body-small">{{ $v->tanggal }}</td>
                <td class="text-body-small">{{ $v->ruangan->nama }}</td>
                <td class="text-body-small">{{ $v->sarana->name }}</td>
                <td class="text-center text-body-small">{{ $v->qty }}</td>
                <td class="text-body-small">{{ $v->keterangan }}</td>
                <td class="text-center text-body-small">{{ $v->status == 9 ? 'Terima' : 'Tolak' }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
