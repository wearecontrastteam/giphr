@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>

                <div class="card-body">
                    <h2>Post a giph:</h2>
                    <form method="POST" action="{{ route('post') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Giphy ID') }}</label>

                            <div class="col-md-8">
                                <input id="giphy_id" type="text" class="form-control" name="giphy_id" required>
                            </div>

                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Giph') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body">
                    <h2>All giphs:</h2>
                    @foreach($posts as $post)
                        <div>
                            [{{$post->id}}] Giphy ID: {{$post->giphy_id}}<br>
                            User: (name: {{$post->user->name}})<br>
                            Likes:<br>
                            @foreach($post->likes as $like)
                                by {{$like->user->name}} ({{$like->giphy_id}})<br>
                            @endforeach
                        </div>
                        <form method="POST" action="{{ route('like', ['post' => $post->id]) }}">
                            @csrf
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('👍') }}
                                </button>
                            </div>
                        </form>
                        <br>
                    @endforeach
                </div>

                <div class="card-body">
                    <h2>All users:</h2>
                    @foreach($users as $user)
                        <div>
                            Name: {{$user->name}}<br>
                            Email: {{$user->email}}<br>
                            Avatar: {{$user->avatar_giphy_id}}<br>
                        </div>
                        <br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
