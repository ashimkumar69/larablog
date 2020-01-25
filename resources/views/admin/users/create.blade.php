@extends('layouts.admin')

@section('content')

@include('include.message')

<div class="panel panel-default">

    <div class="panel-heading text-center">
        Create User
    </div>
    <div class="panel-body">
        <form action="{{ route('users.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" id="" aria-describedby="helpId" placeholder="">
            </div>
            <div class="form-group">
                <label for="">E-Mail Address</label>
                <input type="email" class="form-control" name="email" id="" aria-describedby="helpId" placeholder="">
            </div>
            <div class="form-group">
                <label for="">Image</label>
                <input type="file" class="form-control" name="photo_id" id="" placeholder="" aria-describedby="fileHelpId">

            </div>
            <div class="form-group">
                <label for="">Role</label>
                <select class="form-control" name="role_id" id="">
                    <option selected>Select one</option>
                    @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Status</label>
                <select class="form-control" name="is_active" id="">
                    <option value="0" selected>Not Active</option>
                    <option value="1">Active</option>

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
