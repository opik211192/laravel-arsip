@extends('layouts.back')

@section('content')
    <div class="card">
        <div class="card-header text-white mystyle">Your Dashboard</div>
            <div class="card-body">
                {{-- Hi {{ auth()->user()->name }} --}}
                
                <table class="table table-striped col-sm-6">
                    <tbody>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{ auth()->user()->name }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td>{{ auth()->user()->email }}</td>
                        </tr>
                        <tr>
                            <td>Role</td>
                            <td>:</td>
                            <td>{{ implode(', ', auth()->user()->getRoleNames()->toArray()); }}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>:</td>
                            <td><small class="badge badge-success"></>Login</small></td>
                        </tr>
                    </tbody>
                </table>
            </div>
    </div>
@endsection