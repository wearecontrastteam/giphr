@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('partials.nav')
        <div class="col-md-9">
            <giphy-search></giphy-search>
            <new-giph avatar-giphy-id="{{ auth()->user()->avatar_giphy_id }}"></new-giph>
            <giph-timeline></giph-timeline>
        </div>
    </div>
</div>
@endsection
