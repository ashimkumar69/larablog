@extends('layouts.admin')




@section('content')
@include('include.message')
<div class="panel panel-default">
    <div class="panel-heading text-center">
        All Posts
    </div>
    <div class="panel-body">


        @if ($photos)


        <form action="{{route('deleteMedia')}}" method="post">
            @csrf
            @method('delete')
            <select name="checkboxArray" id="">

                <option value="delete">Delete</option>
            </select>

            <button type="submit" class="btn btn-primary">Submit</button>


            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="option"></th>
                        <th>#</th>
                        <th>Image</th>
                        <th>Created_at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($photos as $index => $photo)

                    <tr>
                        <th><input type="checkbox" name="checkboxArray[]" class="checkboxes" value="{{ $photo->id}}">
                        </th>
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
        </form>
    </div>
</div>


@endsection
@section('script')
<script>
    $(document).ready(function () {


        
        $("#option").click(function () { 
            if(this.checked){
                $(".checkboxes").each(function () {
                    this.checked =true;
                    
                });
            }else{
                $(".checkboxes").each(function () {
                    this.checked =false;
                    
                });
            }
            
        });












    });
</script>
@endsection