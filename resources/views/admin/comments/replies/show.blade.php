@extends('layouts.admin')

@section('content')
<h1>Post CommentsReplays</h1>



@if (count($replies)>0)

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


                @foreach ($replies as $index => $reply)

                <tr>
                    <th>{{ $index+1 }}</th>
                    <td><img width="60px" height="60px" src="{{ $reply->photo ? $reply->photo : "No Image" }}"
                            class="img-responsive img-rounded img-thumbnail"></td>
                    <td>{{ $reply->author }}</td>
                    <td>{{ $reply->email }}</td>
                    <td>{{ $reply->body }}</td>
                    <td>{{ $reply->created_at->diffForHumans() }}</td>
                    <td>
                        <div class="btn-group text-center" role="group" aria-label="Basic example">
                            <a class="btn btn-primary" href="{{ route('home.post',$reply->comment->post->id) }}">View
                                Post</a>
                            @if ($reply->is_active == 1)
                            <form action="{{route('replies.update',$reply->id) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="is_active" value="0">

                                <button type="submit" class="btn btn-success">Un-Active</a>
                            </form>
                            @else
                            <form action="{{route('replies.update',$reply->id) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="is_active" value="1">

                                <button type="submit" class="btn btn-info">Active</button>
                            </form>

                            @endif
                            <form action="{{route('replies.destroy',$reply->id) }}" method="post">
                                @csrf
                                @method('DELETE')


                                <button type="submit" class="btn btn-danger"
                                    href="{{ route('replies.destroy',$reply->id) }}">Delete</button>
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
<h1>No CommentsReplayes</h1>
@endif




@endsection