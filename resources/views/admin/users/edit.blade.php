@extends('layouts.admin')

@section('content')

@include('include.message')

<div class="panel panel-default">

    <div class="panel-heading text-center">
        Edit User
    </div>
    <div class="panel-body">
        <form action="{{ route('users.update',$users->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" value="{{ $users->name }}">
            </div>
            <div class="form-group">
                <label for="">E-Mail Address</label>
                <input type="email" class="form-control" name="email" value="{{ $users->email }}">
            </div>
            <div class="form-group">
                <label for="">Image</label>
                <input type="file" class="form-control" name="photo_id" id="" placeholder=""
                    aria-describedby="fileHelpId">
                <img width="60px" height="60px" src="{{ $users->photo ? $users->photo->file : "No Image" }}"
                    class="img-responsive img-rounded img-thumbnail">

            </div>
            <div class="form-group">
                <label for="">Role</label>
                <select class="form-control" name="role_id" id="">

                    @foreach ($roles as $role)
                    @if ($role->id == $users->role_id )
                    <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                    @else
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Status</label>
                <select class="form-control" name="is_active" id="">

                    <option value="0" @if ($users->is_active == 0)
                        selected
                        @endif>Not Active</option>
                    <option value="1" @if ($users->is_active == 1)
                        selected
                        @endif>Active</option>

                </select>
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" class="form-control" name="password" id="" placeholder="">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>


    </div>
</div>


@endsection
