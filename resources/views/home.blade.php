@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('partials.nav')
        <div class="col-md-9">
            <new-giph></new-giph>
            <giph-timeline></giph-timeline>
        </div>
    </div>
</div>
@endsection
