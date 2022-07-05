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
                <form action="{{ route('arsip.edit', $arsip) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="jenis_arsip_id" class="col-sm-2 col-form-label">Jenis Arsip</label>
                        <div class="col-sm-4">
                            <select name="jenis_arsip_id" id="jenis_arsip_id" class="form-control">
                                <option value="" selected disabled>Pilih Jensi Arsip</option>
                                @foreach ($jenis_arsip as $item)
                                    <option {{ $arsip->jenis_arsip_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="judul_arsip" class="col-sm-2 col-form-label">Judul Arsip</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="judul_arsip" name="judul_arsip" value="{{ old('judul_arsip') ?? $arsip->judul_arsip }}" required>
                            @error('judul_arsip')
                            <div class="text-danger mt-2 d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                 
                    <div class="form-group row">
                        <label for="lokasi_arsip" class="col-sm-2 col-form-label">Lokasi Arsip</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="lokasi_arsip" name="lokasi_arsip" value="{{ old('lokasi_arsip') ?? $arsip->lokasi_arsip }}" required>
                            @error('lokasi_arsip')
                            <div class="text-danger mt-2 d-block">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="jenis_id" class="col-sm-2 col-form-label">Jenis Arsip</label>
                        <div class="col-sm-4">
                            <select name="jenis_id" id="jenis_id" class="form-control" required>
                                <option value="" selected disabled>Pilih Jenis</option>
                                @foreach ($jenis as $item)
                                    <option {{ $arsip->jenis_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="no_berkas" class="col-sm-2 col-form-label">No. Berkas</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="no_berkas" id="no_berkas" value="{{ old('no_berkas') ?? $arsip->no_berkas }}" required>
                            @error('no_berkas')
                            <div class="text-danger mt-2 d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tahun" class="col-sm-2 col-form-label">Tahun</label>
                        <div class="col-sm-4">
                            <select name="tahun" id="tahun" class="form-control" required>
                                <option value="" selected disabled >Pilih Tahun</option>
                                @for ($i = 1980; $i <= date('Y'); $i++)
                                <option {{ $arsip->tahun == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="pencipta_arsip" class="col-sm-2 col-form-label">Pencipta Arsip</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="pencipta_arsip" id="pencipta_arsip" value="{{ old('pencipta_arsip') ?? $arsip->pencipta_arsip }}" required>
                            @error('pencipta_arsip')
                            <div class="text-danger mt-2 d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="uraian_arsip" class="col-sm-2 col-form-label">Uraian</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="uraian_arsip" id="uraian_arsip" cols="30" rows="5" required>{{ old('uraian_arsip') ?? $arsip->uraian_arsip }}</textarea>
                            @error('uraian_arsip')
                            <div class="text-danger mt-2 d-block">{{ $message }}</div>
                             @enderror
                        </div>
                    </div>

                   
                    <div class="form-group row">
                        <label for="file_arsip" class="col-sm-2 col-form-label">Unggah File</label>
                        <div class="col-sm-10">
                            <input type="file" name="file_arsip" id="file_arsip" class="form-control">
                            <span class="text-danger"><i>Kosongkan jika tidak ubah file</i></span>
                        </div>
                    </div>

                    @if ($user->hasRole('super admin'))
                        <div class="form-group row">
                            <label for="user_id" class="col-sm-2 col-form-label">User</label>
                            <div class="col-sm-4">
                                <select name="user_id" id="user_id" class="form-control" required>
                                    <option value="" selected disabled>Pilih User</option>
                                    @foreach ($alluser as $item)
                                        <option {{ $arsip->user_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name." || {$item->unit->name}" }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @else
                        <input type="text" name="user_id" id="user_id" value="{{ $user->id }}">
                    @endif

                    

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-6 d-flex">
                            <button class="btn btn-primary btn-sm mt-3 mr-2">Simpan</button>
                            <a href="{{ route('arsip.data') }}" class="btn btn-danger btn-sm mt-3 mr-2">Kembali</a>
                        </div>
                    </div>
                </form>

{{-- 
    <div class="card mb-4">
        <div class="card-header text-white" style="background-color: slategray">Create Arsip</div>
            <div class="card-body">
                <form action="{{ route('arsip.edit', $arsip) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="">
                        <div class="form-group">
                            <label for="judul_arsip">Judul Arsip</label>
                            <input type="text" class="form-control" name="judul_arsip" id="judul_arsip" value="{{ old('judul_arsip') ?? $arsip->judul_arsip }}" required>
                        </div>
                        @error('judul_arsip')
                            <div class="text-danger mt-2 d-block">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="lokasi_arsip">Lokasi Arsip</label>
                            <input type="text" class="form-control" name="lokasi_arsip" id="lokasi_arsip" value="{{ old('lokasi_arsip') ?? $arsip->lokasi_arsip }}" required>
                        </div>
                        @error('lokasi_arsip')
                        <div class="text-danger mt-2 d-block">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="jenis_arsip">Jenis</label>
                            <select name="jenis_arsip" id="jenis_arsip" class="form-control" required>
                                <option value="" disabled>Pilih Jenis</option>
                                <option value="ku"{{ old('jenis_arsip') ?? $arsip->jenis_arsip == 'ku' ? 'selected' : '' }}>KU</option>
                                <option value="hk"{{ old('jenis_arsip') ?? $arsip->jenis_arsip == 'hk' ? 'selected' : '' }}>HK</option>
                                <option value="pl"{{ old('jenis_arsip') ?? $arsip->jenis_arsip == 'pl' ? 'selected' : '' }}>PL</option>
                                <option value="um"{{ old('jenis_arsip') ?? $arsip->jenis_arsip == 'um' ? 'selected' : '' }}>UM</option>
                                <option value="pr"{{ old('jenis_arsip') ?? $arsip->jenis_arsip == 'pr' ? 'selected' : '' }}>PR</option>
                                <option value="tn"{{ old('jenis_arsip') ?? $arsip->jenis_arsip == 'tn' ? 'selected' : '' }}>TN</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="no_berkas">No. Berkas</label>
                            <input type="text" class="form-control" name="no_berkas" id="no_berkas" value="{{ $arsip->no_berkas }}" required>
                        </div>
                        @error('no_berkas')
                        <div class="text-danger mt-2 d-block">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="tahun">Tahun</label>
                            <select name="tahun" id="tahun" class="form-control" required>
                                <option value="" selected disabled >Pilih Tahun</option>
                                @for ($i = 1987; $i <= date('Y'); $i++)
                                <option {{ $arsip->tahun == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="pencipta_arsip">Pencipta Arsip</label>
                            <input type="text" class="form-control" name="pencipta_arsip" id="pencipta_arsip" value="{{ $arsip->pencipta_arsip }}" required>
                        </div>
                        @error('pencipta_arsip')
                        <div class="text-danger mt-2 d-block">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="uraian_arsip">Uraian</label>
                            <textarea class="form-control" name="uraian_arsip" id="uraian_arsip" cols="30" rows="5">{{ $arsip->uraian_arsip }}</textarea>
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
                        <input type="hidden" name="user_id" id="user_id" value="{{ $arsip->user->id }}"> --}}
{{-- 
                        <button class="btn btn-primary mt-3">Simpan</button>
                    </div>
                </form>
            </div>
    </div> --}}
@endsection