@extends('layouts.admin')

@section('content')
@include('include.message')
<div class="panel panel-default">
    <div class="panel-heading text-center">
        All Users
    </div>
    <div class="panel-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Active</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>
                </tr>
            </thead>
            <tbody>

                @if ($users)
                @foreach ($users as $index => $user)

                <tr>
                    <th>{{ $index+1 }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->name }}</td>
                    <td>{{ $user->is_active == 1 ? "Active" : "Not Active" }}</td>
                    <td>{{ $user->created_at->diffForHumans() }}</td>
                    <td>{{ $user->updated_at->diffForHumans() }}</td>
                </tr>
                @endforeach

                @endif
            </tbody>
        </table>
    </div>
</div>


@endsection
