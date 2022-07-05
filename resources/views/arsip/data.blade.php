@extends('layouts.back')

@section('styles2')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
@endsection


@section('content')
@if (Auth::user()->roles->pluck('name')->contains('super admin') || Auth::user()->roles->pluck('name')->contains('admin'))
<div class="card">
    <div class="card-header text-white" style="background-color: slategray">Data Arsip</div>
    <div class="card-body">
        <table class="table table-striped table-sm" id="table-datatable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tahun</th>
                    <th>Nama Arsip</th>
                    <th>Jenis</th>
                    <th>User</th>
                    <th>Act</th>
                </tr>     
            </thead>
           {{-- @if ($user->hasRoles('super admin'))
               <h1>INI SUPER ADMIN</h1>
           @endif --}}
            {{-- @forelse ($arsip as $index => $a)
            <tbody>
    
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $a->tahun }}</td>
                    <td>{{ $a->judul_arsip }}</td>
                    <td>{{ $a->jenis->name }}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('arsip.edit', $a) }}" class="btn btn-success btn-sm" data-toggle="edit" data-placement="top" title="Edit"><i class="fa-solid fa-user-pen"></i></a>&nbsp;
                            <a href="#" class="btn btn-warning btn-sm" data-toggle="detail" data-placement="top" title="Detail"><i class="fa-solid fa-book"></i></a>&nbsp;
                            <form action="{{ route('arsip.delete', $a) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-secondary btn-sm" data-toggle="Delete" data-placement="top" title="Delete" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash-can"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            </tbody>
            @empty
                <td colspan="6" class="text-center">Tidak ada data...</td>
            @endforelse --}}
                
           
        </table>
    </div>
    </div>
    @endsection
    
    
    @push('scripts')
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    
    <script type="text/javascript">
    $(function () {
      
      var table = $('#table-datatable').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('arsip.data') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'tahun', name: 'tahun'},
              {data: 'judul_arsip', name: 'judul_arsip'},
              {data: 'jenis.name', name: 'jenis.name'},
              {data: 'user.name', name: 'user.name'},
              {
                  data: 'action', 
                  name: 'action', 
                  orderable: true, 
                  searchable: true
              },
          ]
      });    
    });
    </script>
    @endpush 
@else
<div class="card">
<div class="card-header text-white" style="background-color: slategray">Data Arsip</div>
<div class="card-body">
    <table class="table table-striped table-sm" id="table-datatable">
        <thead>
            <tr>
                <th>#</th>
                <th>Tahun</th>
                <th>Nama Arsip</th>
                <th>Jenis</th>
                <th>Act</th>
            </tr>     
        </thead>
    </table>
</div>
</div>
@endsection


@push('scripts')
<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
$(function () {
  
  var table = $('#table-datatable').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('arsip.data') }}",
      columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
          {data: 'tahun', name: 'tahun'},
          {data: 'judul_arsip', name: 'judul_arsip'},
          {data: 'jenis.name', name: 'jenis.name'},
          {
              data: 'action', 
              name: 'action', 
              orderable: true, 
              searchable: true
          },
      ]
  });    
});
</script>
@endpush
@endif