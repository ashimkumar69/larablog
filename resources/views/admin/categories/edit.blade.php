@extends('layouts.admin')

@section('content')

@include('include.message')

<div class="panel panel-default">

    <div class="panel-heading text-center">
        Edit Post
    </div>
    <div class="panel-body">
        <form action="{{ route('category.update',$categories->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="">Title</label>
                <input type="text" class="form-control" name="name" value="{{ $categories->name }}">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>


    </div>
</div>


@endsection
