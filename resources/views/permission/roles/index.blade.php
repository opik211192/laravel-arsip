@extends('layouts.back')

@section('content')
    <div class="card mb-4">
        <div class="card-header">Create New Role</div>
            <div class="card-body">
               <form action="{{ route('roles.create') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label for="guard_name">Guard Name</label>
                        <input type="text" class="form-control" name="guard_name" id="guard_name" placeholder='Default to "Web"'>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form> 
            </div>
    </div>

    <div class="card">
        <div class="card-header">Table Of Role</div>
        <div class="card-body">
            <table class="table table-hover">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Guard Name</th>
                    <th>Create At</th>
                    <th>Act</th>
                </tr>
                @foreach ($roles as $index => $role)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->guard_name }}</td>
                        <td>{{ $role->created_at->format("d F Y") }}</td>
                        <td>
                            <div class="d-flex">
                            <a href="{{ route('roles.edit', $role) }}" class="btn btn-success btn-sm" data-toggle="Update"    data-placement="top" title="Update"><i class="fa-solid fa-user-pen"></i></a>&nbsp;
                            <form action="{{ route('roles.delete', $role) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-secondary btn-sm" data-toggle="Delete" data-placement="top" title="Delete" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash-can"></i></button>
                            </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection