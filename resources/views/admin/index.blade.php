@extends('layouts.app')
@section('title')
Data User
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <form action="{{ route('add.user') }}" method="POST">
            {{ csrf_field() }}
            <div class="card-body">
                <div class="form-group mb-3">
                    <label for="exampleInputName">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="masukan nama">
                </div>
                <div class="form-group mb-3">
                    <label for="exampleInputRole">Role</label>
                    <select name="role" id="role" class="form-control">
                        <option disabled>-pilih Role-</option>
                        <option value="siswa">Siswa</option>
                        <option value="Kurikulum">Kurikulum</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="exampleInputEmail">Email Address</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="masukan email">
                </div>
                <div class="form-group mb-3">
                    <label for="exampleInputPassword">Password</label>
                    <input type="password" name="password" id="password" class="form-control"
                        placeholder="masukan password">
                    <input type="checkbox" id="checkbox">Show Password
                </div>
            </div>
            <!-- /.card-body -->

            <div class="row">
                <!-- /.col -->
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">Tambah User</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
    </div>
</div>
<br>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data User</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        @php
                            $no = 1;
                        @endphp
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user as $User)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $User->name }}</td>
                                <td>{{ $User->role }}</td>
                                <td>{{ $User->email }}</td>
                                <td>
                                    <a href="{{ route('user.destroy',$User->id) }}"><button
                                            class="btn btn-md btn-danger">Hapus</button></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@endsection
@push('js')
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
        });
        $(document).ready(function () {
            $('#checkbox').on('change', function () {
                $('#password').attr('type', $('#checkbox').prop('checked') == true ? "text" : "password");
            });
        });

    </script>
@endpush
