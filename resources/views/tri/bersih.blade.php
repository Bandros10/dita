@extends('layouts.app')
@section('title')
Input Kegiatan
@endsection
@section('content')
@if(session('success'))
    @alert(['type' => 'success'])
        {!! session('success') !!}
    @endalert
@endif
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Absen siswa kegiatan bersih</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('bersih.add')}}" method="POST"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama_siswa">Nama Siswa</label>
                                <input type="text" class="form-control" id="nama_siswa" name="nama_siswa"
                                    placeholder="masukan nama">
                            </div>
                            <div class="form-group">
                                <label for="kelas">Kelas</label>
                                <input type="text" class="form-control" id="kelas" name="kelas"
                                    oninput="this.value = this.value.toUpperCase()" placeholder="masukan kelas">
                                <small style="color: red">contoh penulisan:&ensp;"XII-IPA-1"</small>
                            </div>
                            <div class="form-group">
                                <label for="kelas">Wali Kelas</label>
                                <input type="text" class="form-control" id="kelas" name="wali_kelas"
                                    placeholder="masukan wali kelas">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Input Tugas</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="tugas" id="tugas">
                                        <label class="custom-file-label" for="tugas">Input tugas</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="absen">Keterangan</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="absen" value="hadir">
                                    <label class="form-check-label">Hadir</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="absen" value="sakit">
                                    <label class="form-check-label">Sakit</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="absen" value="izin">
                                    <label class="form-check-label">izin</label>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.container-fluid -->
        </div>
    </div>
</section>
@endsection
