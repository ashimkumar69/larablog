@extends('layouts.blog-post')

@section('content')

<!-- Blog Post Content Column -->
<div class="col-lg-8">

    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{ $post->title }}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">{{ $post->user->name }}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted {{ $post->created_at->diffForHumans() }}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="{{ $post->photo->file }}" alt="">

    <hr>

    <!-- Post Content -->

    <p>
        {{ $post->body }}
    </p>

    <hr>

    <!-- Blog Comments -->

    <!-- Comments Form -->
    <div class="well">
        @include('include.message')
        <h4>Leave a Comment:</h4>

        <form role="form" action="{{ route('comments.store') }}" method="POST">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <div class="form-group">
                <label>Body:</label>
                <textarea name="body" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>

    <hr>

    <!-- Posted Comments -->

    @if ( count($comments) > 0)


    @foreach ($comments as $comment)

    <!-- Comment -->
    <div class="media">
        <a class="pull-left" href="#">
            <img height="64px" class="media-object" src="{{  Auth::user()->gravatar }} " alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading">{{ $comment->author }}
                <small>{{ $comment->created_at->format('d-M-y h:m A') }}</small>
            </h4>
            {{ $comment->body }}



            @if (count($comment->replies) > 0)
            @foreach ($comment->replies as $reply)


            @if ($reply->is_active == 1)
            <!-- Nested Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img height="64px" class="media-object" src="{{ $reply->photo }}" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{ $reply->author }}
                        <small>{{ $reply->created_at->format('d-M-y h:m A') }}</small>
                    </h4>
                    {{ $reply->body }}


                </div>

                <button type="button" class="toggle_replay btn btn-primary pull-right">Replay</button>

                <div class="comment_reply_container col-lg-12">

                    <form action="{{route("createReplie")}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Body</label>
                            <input type="hidden" name="comment_id" value="{{ $reply->id }}">
                            <textarea class="form-control" name="body" id="" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <!-- End Nested Comment -->
            </div>
            @endif

            @endforeach
            @endif


        </div>
    </div>

    @endforeach
    @endif


</div>
@endsection
@section('script')
<script>
    $(".toggle_replay").on("click", function () {
        
        $(".comment_reply_container").slideToggle("slow");
    
});
</script>
@endsection