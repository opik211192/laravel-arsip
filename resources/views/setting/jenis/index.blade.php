@extends('layouts.back')

@section('content')
@if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

<div class="card mb-3">
    <div class="card-header text-white mystyle">Tambah Jenis</div>
        <div class="card-body">
            <form action="{{ route('jenis.create') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="role">Nama Jenis Arsip</label>
                        <input type="text" class="form-control" id="name" name="name">
                    @error('jenis')
                        <div class="text-danger mt-2 d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="descripion">Keterangan</label>
                    <input type="text" class="form-control" id="description" name="description">
                    @error('description')
                        <div class="text-danger mt-2 d-block">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
</div>

<div class="card">
    <div class="card-header text-white mystyle">Data Jenis Arsip</div>
    <div class="card-body">
        <table class="table table-striped">
            <tr>
                <th>#</th>
                <th>Nama Jenis</th>
                <th>Keterangan</th>
                <th>Action</th>
            </tr>
            @foreach ($datas as $index => $jenis)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $jenis->name }}</td>
                    <td>{{ $jenis->description }}</td>
                    <td>
                        <div class="d-flex">
                        <a href="{{ route('jenis.edit', $jenis) }}" class="btn btn-success btn-sm" data-toggle="Update"    data-placement="top" title="Update"><i class="fa-solid fa-user-pen"></i></a>&nbsp;
                        <form action="{{ route('jenis.delete', $jenis) }}" method="post">
                        @csrf
                        @method('DELETE')
                            <button type="submit" class="btn btn-secondary btn-sm" data-toggle="Delete" data-placement="top" title="Delete" onclick="return confirm('Hapus data ini')"><i class="fa-solid fa-trash-can"></i></button>
                        </form>
                        </div>
                        
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection