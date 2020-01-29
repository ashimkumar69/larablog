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
                    <th>Image</th>
                    <th>Created_at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                @if ($photos)
                @foreach ($photos as $index => $photo)

                <tr>
                    <th>{{ $index+1 }}</th>
                    <td><img width="60px" height="60px" src="{{ $photo->file ? $photo->file : "No Image" }}"
                            class="img-responsive img-rounded img-thumbnail" alt="Photo"></td>
                    <td>{{ $photo->created_at->diffForHumans() }}</td>

                    <td>
                        <form action="{{ route('media.destroy',$photo->id) }}" method="POST">
                            <div class="btn-group" role="group" aria-label="">

                                @csrf
                                <button type="submit" class="btn btn-danger">Delete</button>
                                @method('DELETE')
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
