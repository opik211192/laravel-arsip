@extends('layouts.back')

@section('content')

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif


<div class="card mb-4">
    <div class="card-header text-white" style="background-color: slategray">Create Arsip</div>
    <div class="card-body">

        <form action="{{ route('arsip.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <label for="jenis_arsip_id" class="col-sm-2 col-form-label">Jenis Arsip</label>
                <div class="col-sm-4">
                    <select name="jenis_arsip_id" id="jenis_arsip_id" class="form-control">
                        <option value="" selected disabled>Pilih Jensi Arsip</option>
                        @foreach ($jenis_arsip as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>

                </div>
            </div>

            {{-- <div class="form-group row">
                <label for="judul_arsip" class="col-sm-2 col-form-label">Judul Arsip</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="judul_arsip" name="judul_arsip" required>
                    @error('judul_arsip')
                    <div class="text-danger mt-2 d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div> --}}

            <div class="form-group row">
                <label for="lokasi_arsip" class="col-sm-2 col-form-label">Lokasi Arsip</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="lokasi_arsip" name="lokasi_arsip" required>
                    @error('lokasi_arsip')
                    <div class="text-danger mt-2 d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="jenis_id" class="col-sm-2 col-form-label">Jenis Klasifikasi</label>
                <div class="col-sm-4">
                    <select name="jenis_id" id="jenis_id" class="form-control" required>
                        <option value="" selected disabled>Pilih Jenis Klasifikasi</option>
                        @foreach ($jeniss as $jenis)
                        <option value="{{ $jenis->id }}">{{ $jenis->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="no_berkas" class="col-sm-2 col-form-label">No. Berkas</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="no_berkas" id="no_berkas" required>
                    @error('no_berkas')
                    <div class="text-danger mt-2 d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="judul_arsip" class="col-sm-2 col-form-label">No. Box</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="no_box" name="no_box" required>
                    @error('no_box')
                    <div class="text-danger mt-2 d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="tahun" class="col-sm-2 col-form-label">Tahun</label>
                <div class="col-sm-4">
                    <select name="tahun" id="tahun" class="form-control" required>
                        <option value="" selected disabled>Pilih Tahun</option>
                        @for ($i = 1985; $i <= date("Y") ; $i++) <option value="{{ $i }}"> {{ $i }}</option>
                            @endfor
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="pencipta_arsip" class="col-sm-2 col-form-label">Pencipta Arsip</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="pencipta_arsip" id="pencipta_arsip" required>
                    @error('pencipta_arsip')
                    <div class="text-danger mt-2 d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            <div class="form-group row">
                <label for="uraian_arsip" class="col-sm-2 col-form-label">Uraian</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="uraian_arsip" id="uraian_arsip" cols="30" rows="5"
                        required></textarea>
                    @error('uraian_arsip')
                    <div class="text-danger mt-2 d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="file_arsip" class="col-sm-2 col-form-label">Unggah File</label>
                <div class="col-sm-10">
                    <input type="file" name="file_arsip" id="file_arsip" class="form-control">
                </div>
            </div>

            @if ($user->hasRole('super admin') || $user->hasRole('admin'))
            <div class="form-group row">
                <label for="user_id" class="col-sm-2 col-form-label">User</label>
                <div class="col-sm-4">
                    <select name="user_id" id="user_id" class="form-control" required>
                        <option value="" selected disabled>Pilih User</option>
                        @foreach ($alluser as $user)
                        <option value="{{ $user->id }}">{{ $user->name." || {$user->unit->name}" }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @else
            <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
            @endif



            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-2">
                    <button class="btn btn-primary mt-3">Simpan</button>
                </div>
            </div>
        </form>

        {{-- <form action="{{ route('arsip.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="judul_arsip">Judul Arsip</label>
                <input type="text" class="form-control" name="judul_arsip" id="judul_arsip" required>
            </div>
            @error('judul_arsip')
            <div class="text-danger mt-2 d-block">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="lokasi_arsip">Lokasi Arsip</label>
                <input type="text" class="form-control" name="lokasi_arsip" id="lokasi_arsip" required>
            </div>
            @error('lokasi_arsip')
            <div class="text-danger mt-2 d-block">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="jenis_arsip">Jenis</label>
                <select name="jenis_arsip" id="jenis_arsip" class="form-control" required>
                    <option value="" selected disabled>Pilih Jenis</option>
                    <option value="ku">KU</option>
                    <option value="hk">HK</option>
                    <option value="pl">PL</option>
                    <option value="um">UM</option>
                    <option value="pr">PR</option>
                    <option value="tn">TN</option>
                </select>
            </div>

            <div class="form-group">
                <label for="no_berkas">No. Berkas</label>
                <input type="text" class="form-control" name="no_berkas" id="no_berkas" required>
            </div>
            @error('no_berkas')
            <div class="text-danger mt-2 d-block">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="tahun">Tahun</label>
                <select name="tahun" id="tahun" class="form-control" required>
                    <option value="" selected disabled>Pilih Tahun</option>
                    @for ($i = 1985; $i <= date("Y") ; $i++) <option value="{{ $i }}"> {{ $i }}</option>
                        @endfor
                </select>
            </div>

            <div class="form-group">
                <label for="pencipta_arsip">Pencipta Arsip</label>
                <input type="text" class="form-control" name="pencipta_arsip" id="pencipta_arsip" required>
            </div>
            @error('pencipta_arsip')
            <div class="text-danger mt-2 d-block">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="uraian_arsip">Uraian</label>
                <textarea class="form-control" name="uraian_arsip" id="uraian_arsip" cols="30" rows="5"
                    required></textarea>
            </div>
            @error('uraian')
            <div class="text-danger mt-2 d-block">{{ $message }}</div>
            @enderror --}}
            {{-- <div class="form-group">
                <label for="user_id">User ID</label>
                <input type="text" class="form-control" name="user_id" id="user_id" value="{{ $user->id }}">
            </div> --}}
            {{-- <div class="form-group">
                <label for="arsip">Unggah File</label>
                <input type="file" name="file_arsip" id="file_arsip" class="form-control">
            </div>
            <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">

            <button class="btn btn-primary mt-3">Simpan</button>

        </form> --}}


    </div>
</div>
@endsection