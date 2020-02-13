@if($errors->any())
@foreach ($errors->all() as $error)
<div class="alert alert-danger alert-dismissible" role="alert">
    {{ $error }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">

        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endforeach
@endif


@if (session('message'))
<div class="alert alert-success alert-dismissible" role="alert">
    {{ session('message') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if (session('comment_message'))
<div class="alert alert-success alert-dismissible" role="alert">
    {{ session('comment_message') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if (session('delete_user'))
<div class="alert alert-danger alert-dismissible" role="alert">
    {{ session('delete_user') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

{{-- @error('name')
<span class="text-danger">{{ $message }}</span>
@enderror --}}