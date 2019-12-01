@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('partials.nav')
        <div class="col-md-9">
            @if($user_post_count == 0)
            @endif
            <new-giph avatar-giphy-id="{{ auth()->user()->avatar_giphy_id }}" :user-post-count="{{$user_post_count}}"></new-giph>
            <giph-timeline :logged-in-user-id="{{auth()->user()->id}}"></giph-timeline>
        </div>
    </div>
</div>
@endsection
