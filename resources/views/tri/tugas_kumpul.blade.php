@extends('layouts.app')
@section('title')
ABSEN
@endsection
@section('content')
<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" href="#tawasul" role="tab" data-toggle="tab">Tawasul </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#buzz" role="tab" data-toggle="tab">Bersih</a>
    </li>
    {{-- <li class="nav-item">
        <a class="nav-link" href="#references" role="tab" data-toggle="tab">Setting</a>
    </li> --}}
</ul>

<!-- Tab panes -->
<br>
<div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="tawasul">
        <table id="itikab" class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Wali Kelas</th>
                    <th>Tugas</th>
                </tr>
            </thead>
            <tbody>
                @foreach($edit_taw as $data)
                    <tr>
                        <td>{{ $data->nama_siswa }}</td>
                        <td>{{ $data->kelas }}</td>
                        <td>{{ $data->wali_kelas }}</td>
                        <td>@if (!empty($data->tugas))
                            <img src="{{asset('/uploads/product/'.$data->tugas)}}"
                                alt="{{ $data->nama_siswa }}" width="50px" height="50px">
                        @else
                            {{ $data->absen }}
                        @endif
                        </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="buzz">
        <table id="bersih" class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Wali Kelas</th>
                    <th>Tugas</th>
                </tr>
            </thead>
            <tbody>
                @foreach($edit_ber as $data)
                    <tr>
                        <td>{{ $data->nama_siswa }}</td>
                        <td>{{ $data->kelas }}</td>
                        <td>{{ $data->wali_kelas }}</td>
                        <td>@if (!empty($data->tugas))
                            <img src="{{asset('/uploads/product/'.$data->tugas)}}"
                                alt="{{ $data->nama_siswa }}" width="50px" height="50px">
                        @else
                            {{ $data->absen }}
                        @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- <div role="tabpanel" class="tab-pane fade" id="references">Ini Halaman Setting</div> --}}
</div>
@endsection
@push('js')
    <script>
        $('#itikab').DataTable({
            "responsive": true,
            "autoWidth": false,
        });
        $('#bersih').DataTable({
            "responsive": true,
            "autoWidth": false,
        });

    </script>
@endpush
