@extends('admin.cetak.index')

@section('content')
    <div class="text-center report-title">LAPORAN STOCK SARANA DAN PRASARANA {{ strtoupper($data_ruangan->nama) }}</div>
    <table id="my-table" class="table display" style="margin-top: 10px">
        <thead>
        <tr>
            <td width="5%" class="text-center text-body">#</td>
            <th class="text-body">Sarana / Prasarana</th>
            <th width="15%" class="text-center text-body">Jumlah</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $v)
            <tr>
                <td width="5%" class="text-center text-body">{{ $loop->index + 1 }}</td>
                <td class="text-body">{{ $v->sarana->name }}</td>
                <td class="text-center text-body">{{ $v->qty }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
