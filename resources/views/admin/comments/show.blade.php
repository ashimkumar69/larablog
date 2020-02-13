@extends('layouts.admin')

@section('content')
<h1>Post Comments</h1>



@if ($comments)

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
                    <th>Author</th>
                    <th>Email</th>
                    <th>Body</th>
                    <th>Created_at</th>
                    <th>Go to Post</th>

                </tr>
            </thead>
            <tbody>


                @foreach ($comments as $index => $comment)

                <tr>
                    <th>{{ $index+1 }}</th>
                    <td><img width="60px" height="60px" src="{{ $comment->photo ? $comment->photo : "No Image" }}"
                            class="img-responsive img-rounded img-thumbnail"></td>
                    <td>{{ $comment->author }}</td>
                    <td>{{ $comment->email }}</td>
                    <td>{{ $comment->body }}</td>
                    <td>{{ $comment->created_at->diffForHumans() }}</td>
                    <td>
                        <div class="btn-group text-center" role="group" aria-label="Basic example">
                            <a class="btn btn-primary" href="{{ route('home.post',$comment->post_id) }}">View Post</a>
                            @if ($comment->is_active == 1)
                            <form action="{{route('comments.update',$comment->id) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="is_active" value="0">

                                <button type="submit" class="btn btn-success">Un-Active</a>
                            </form>
                            @else
                            <form action="{{route('comments.update',$comment->id) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="is_active" value="1">

                                <button type="submit" class="btn btn-info">Active</button>
                            </form>

                            @endif
                            <form action="{{route('comments.destroy',$comment->id) }}" method="post">
                                @csrf
                                @method('DELETE')


                                <button type="submit" class="btn btn-danger"
                                    href="{{ route('comments.destroy',$comment->id) }}">Delete</button>
                            </form>

                        </div>

                    </td>

                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>

@else
<h1>No Comments</h1>
@endif




@endsection