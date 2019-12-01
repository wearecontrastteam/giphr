@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('partials.nav')
        <div class="col-md-9">
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                <div class="form-group row">
                    <label for="avatar_giphy_id" class="col-md-3 col-form-label text-md-right">{{ __('Avatar Giphy ID') }}</label>

                    <div class="col-md-7">
                        <input id="avatar_giphy_id" type="text" class="form-control @error('name') is-invalid @enderror" name="avatar_giphy_id" value="{{ $user->avatar_giphy_id }}" required>

                        @error('avatar_giphy_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row" style="margin-bottom:1em">
                    <div class="col-md-7 offset-md-3"><img src="https://i.giphy.com/media/{{ $user->avatar_giphy_id ?? 'null' }}/giphy.webp"></div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-7 offset-md-3">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Save') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
