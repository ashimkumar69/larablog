@extends('layouts.admin')

@section('content')

@include('include.message')

<div class="panel panel-default">

    <div class="panel-heading text-center">
        Edit Post
    </div>
    <div class="panel-body">
        <form action="{{ route('posts.update',$post->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="">Title</label>
                <input type="text" class="form-control" name="title" value="{{ $post->title }}">
            </div>
            <div class="form-group">
                <label for="">Category</label>
                <select class="form-control" name="category_id" id="">

                    @foreach ($categorys as $category)
                    @if ($category->id == $post->category_id)
                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                    @else

                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endif
                    @endforeach


                </select>
            </div>
            <div class="form-group">
                <label for="">Image</label>
                <input type="file" class="form-control" name="photo_id" id="" placeholder=""
                    aria-describedby="fileHelpId">
                <img width="60px" height="60px" src="{{ $post->photo ? $post->photo->file : "No Image" }}"
                    class="img-responsive img-rounded img-thumbnail" alt="Photo">
            </div>
            <div class="form-group">
                <label for="">Description</label>
                <textarea class="form-control" name="body" id="" rows="4">{{ $post->body }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>


    </div>
</div>


@endsection
