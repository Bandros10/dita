@extends('layouts.app')
@section('title')
ABSEN
@endsection
@section('content')
<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" href="#tawasul" role="tab" data-toggle="tab">Tadarus </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#buzz" role="tab" data-toggle="tab">ramah lingkungan</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#references" role="tab" data-toggle="tab">literasi</a>
    </li>
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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($edit_taw as $data_taw)
                    <tr>
                        <td>{{ $data_taw->nama_siswa }}</td>
                        <td>{{ $data_taw->kelas }}</td>
                        <td>{{ $data_taw->wali_kelas }}</td>
                        <td>@if (!empty($data_taw->tugas))
                            <img src="{{asset('/uploads/product/'.$data_taw->tugas)}}"
                                alt="{{ $data_taw->nama_siswa }}" width="50px" height="50px">
                        @else
                            {{ $data_taw->absen }}
                        @endif
                        </td>
                        <td><a href="{{route('siswa.edit',$data_taw->id)}}" class="btn btn-warning">Edit</a></td>
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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($edit_ber as $data_ber)
                    <tr>
                        <td>{{ $data_ber->nama_siswa }}</td>
                        <td>{{ $data_ber->kelas }}</td>
                        <td>{{ $data_ber->wali_kelas }}</td>
                        <td>@if (!empty($data_ber->tugas))
                            <img src="{{asset('/uploads/product/'.$data_ber->tugas)}}"
                                alt="{{ $data_ber->nama_siswa }}" width="50px" height="50px">
                        @else
                            {{ $data_ber->absen }}
                        @endif
                        </td>
                        <td><a href="{{route('siswa.edit.bersih',$data_ber->id)}}" class="btn btn-warning">Edit</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="references">
        <table id="bersih" class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Wali Kelas</th>
                    <th>Tugas</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($edit_lit as $data_lit)
                    <tr>
                        <td>{{ $data_lit->nama_siswa }}</td>
                        <td>{{ $data_lit->kelas }}</td>
                        <td>{{ $data_lit->wali_kelas }}</td>
                        <td>@if (!empty($data_lit->tugas))
                            <img src="{{asset('/uploads/product/'.$data_lit->tugas)}}"
                                alt="{{ $data_lit->nama_siswa }}" width="50px" height="50px">
                        @else
                            {{ $data_lit->absen }}
                        @endif
                        </td>
                        <td><a href="{{route('siswa.edit.literasi',$data_lit->id)}}" class="btn btn-warning">Edit</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
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
