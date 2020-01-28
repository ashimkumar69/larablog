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
                @foreach ($posts as $index => $posts)

                <tr>
                    <th>{{ $index+1 }}</th>
                    <td>{{ $posts->user->name }}</td>
                    <td>{{ $posts->category_id }}</td>
                    <td><img width="60px" height="60px" src="{{ $posts->photo ? $posts->photo->file : "No Image" }}"
                            class="img-responsive img-rounded img-thumbnail" alt="Photo"></td>
                    <td>{{ $posts->title }}</td>
                    <td>{{ $posts->body }}</td>
                    <td>{{ $posts->created_at->diffForHumans() }}</td>
                    <td>{{ $posts->updated_at->diffForHumans() }}</td>
                    <td>
                        <form action="" method="POST">
                            <div class="btn-group" role="group" aria-label="">
                                <a href="" type="button" class="btn btn-info">Edit</a>

                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </form>
                    </td>
                </tr>
                @endforeach

                @endif
            </tbody>
        </table>
    </div>
</div>


@endsection
