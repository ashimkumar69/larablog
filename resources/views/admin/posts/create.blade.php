@extends('layouts.admin')

@section('content')

@include('include.message')

<div class="panel panel-default">

    <div class="panel-heading text-center">
        Create User
    </div>
    <div class="panel-body">
        <form action="{{ route('posts.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="">Title</label>
                <input type="text" class="form-control" name="title" id="" aria-describedby="helpId" placeholder="">
            </div>
            <div class="form-group">
                <label for="">Category</label>
                <select class="form-control" name="category_id" id="">
                    <option selected>Select one</option>
                    <option value="1">PHP</option>
                    <option value="2">LARAVEL</option>

                </select>
            </div>
            <div class="form-group">
                <label for="">Image</label>
                <input type="file" class="form-control" name="photo_id" id="" placeholder=""
                    aria-describedby="fileHelpId">

            </div>
            <div class="form-group">
                <label for="">Description</label>
                <textarea class="form-control" name="body" id="" rows="4"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>


    </div>
</div>


@endsection
