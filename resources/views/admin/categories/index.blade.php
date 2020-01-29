@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                All Categories
            </div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th>Created_at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if ($categories)
                        @foreach ($categories as $index => $categorie)

                        <tr>
                            <th>{{ $index+1 }}</th>
                            <td>{{ $categorie->name }}</td>
                            <td>{{ $categorie->created_at->diffForHumans() }}</td>
                            <td>
                                <form action="{{ route('category.destroy',$categorie->id) }} " method="POST">
                                    <div class="btn-group" role="group" aria-label="">
                                        <a href="{{ route('category.edit',$categorie->id) }}" type="button"
                                            class="btn btn-info">Edit</a>

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
    </div>
    <div class="col-md-4">
        @include('include.message')
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                All Categories
            </div>
            <div class="panel-body">
                <form action="{{ route('category.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name" id="" aria-describedby="helpId"
                            placeholder="">

                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection
