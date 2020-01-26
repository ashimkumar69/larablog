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
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Active</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                @if ($users)
                @foreach ($users as $index => $user)

                <tr>
                    <th>{{ $index+1 }}</th>
                    <td><img width="60px" height="60px" src="{{ $user->photo ? $user->photo->file : "No Image" }}"
                            class="img-responsive img-rounded img-thumbnail"></td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->name }}</td>
                    <td>{{ $user->is_active == 1 ? "Active" : "Not Active" }}</td>
                    <td>{{ $user->created_at->diffForHumans() }}</td>
                    <td>{{ $user->updated_at->diffForHumans() }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="">
                            <a href="{{ route('users.edit',$user->id)}}" type="button"
                                class="btn btn-info">Edit</a>
                            <button type="button" class="btn btn-danger">Delete</button>
                        </div>
                    </td>
                </tr>
                @endforeach

                @endif
            </tbody>
        </table>
    </div>
</div>


@endsection
