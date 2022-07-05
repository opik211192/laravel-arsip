@extends('layouts.back')

@section('content')
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
@if (session('pesan'))
<div class="alert alert-danger">
    {{ session('pesan') }}
</div>
@endif
<div class="card">
    <div class="card-header text-white mystyle">Data User</div>
    <div class="card-body">
        <table class="table table-hover">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            @foreach ($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <div class="d-flex">
                        @if ($user->hasRole('super admin'))
                            <a href="{{ route('register.edit', $user) }}" class="btn btn-success btn-sm" data-toggle="Update"    data-placement="top" title="Update"><i class="fa-solid fa-user-pen"></i></a>
                        @else
                            <a href="{{ route('register.edit', $user) }}" class="btn btn-success btn-sm" data-toggle="Update"    data-placement="top" title="Update"><i class="fa-solid fa-user-pen"></i></a>&nbsp;
                            <form action="{{ route('register.delete', $user) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-secondary btn-sm" data-toggle="Delete" data-placement="top" title="Delete" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash-can"></i></button>
                            </form>
                        @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
    </di
@endsection