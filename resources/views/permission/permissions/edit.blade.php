@extends('layouts.back')

@section('content')
    <div class="card mb-4">
        <div class="card-header text-white mystyle">Edit Permission</div>
            <div class="card-body">
               <form action="{{ route('permissions.edit', $permission) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name') ?? $permission->name }}">
                    </div>
                    <div class="form-group">
                        <label for="guard_name">Guard Name</label>
                        <input type="text" class="form-control" name="guard_name" id="guard_name" value="{{ old('guard_name') ?? $permission->guard_name }}" placeholder='Default to "Web"'>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form> 
            </div>
    </div>
@endsection