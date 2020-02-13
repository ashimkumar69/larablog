@extends('layouts.admin')

@section('content')
@include('include.message')
<div class="panel panel-default">
    <div class="panel-heading text-center">
        All Posts
    </div>
    <div class="panel-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Category</th>
                    <th>Photo</th>
                    <th>Title</th>
                    <th>Body</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                @if ($posts)
                @foreach ($posts as $index => $post)

                <tr>
                    <th>{{ $index+1 }}</th>
                    <td>{{ $post->user->name }}</td>
                    <td>{{ $post->category->name }}</td>
                    <td><img width="60px" height="60px" src="{{ $post->photo ? $post->photo->file : "No Image" }}"
                            class="img-responsive img-rounded img-thumbnail" alt="Photo"></td>
                    <td>{{ $post->title }}</td>
                    <td>{{ Str::limit($post->body,7) }}</td>
                    <td>{{ $post->created_at->diffForHumans() }}</td>
                    <td>{{ $post->updated_at->diffForHumans() }}</td>
                    <td>
                        <form action="{{ route('posts.destroy',$post->id)}} " method="POST">
                            <div class="btn-group" role="group" aria-label="">
                                <a href="{{ route('posts.edit',$post->id)}}" type="button" class="btn btn-info">Edit</a>

                                @csrf
                                <button type="submit" class="btn btn-danger">Delete</button>
                                @method('DELETE')
                            </div>
                            <a class="btn btn-primary" href="{{ route('home.post',$post->slug) }}">View Post</a>
                            <a class="btn btn-primary" href="{{ route('comments.show',$post->id) }}">View
                                Comments</a>
                        </form>
                    </td>
                </tr>
                @endforeach

                @endif
            </tbody>
        </table>
        <div class="row">
            <div class="col-lg-6 col-lg-offset-5">
                {{ $posts->render() }}
            </div>
        </div>
    </div>
</div>


@endsection