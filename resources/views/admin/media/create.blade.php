@extends('layouts.admin')



@section('dropzoncss')
<link href="{{asset('css/dropzone.min.css')}}" rel="stylesheet">
@endsection


@section('content')

<div class="panel panel-default">
    <div class="panel-heading text-center">
        All Posts
    </div>
    <div class="panel-body">
        <form action="{{ route('media.store')}}" method="POST" class="dropzone" enctype="multipart/form-data">
            @csrf

        </form>
    </div>
</div>

@endsection





@section('dropzonjs')
<script src="{{asset('js/dropzone.min.js')}}"></script>

@endsection
