@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('partials.nav')
        <div class="col-md-9">
            <form method="POST" action="{{ route('profile.update', $user) }}">
                @csrf
{{--                <div class="form-group row">--}}
{{--                    <label for="avatar_giphy_id" class="col-md-3 col-form-label text-md-right">{{ __('Your avatar') }}</label>--}}

{{--                    <div class="col-md-7">--}}
{{--                        <input id="avatar_giphy_id" type="text" class="form-control @error('name') is-invalid @enderror" name="avatar_giphy_id" value="{{ $user->avatar_giphy_id }}" required>--}}

{{--                        @error('avatar_giphy_id')--}}
{{--                            <span class="invalid-feedback" role="alert">--}}
{{--                                <strong>{{ $message }}</strong>--}}
{{--                            </span>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                </div>--}}

                <div class="form-group row">
                    <label for="avatar_giphy_id" class="col-md-3 col-form-label text-md-right">{{ __('Your avatar') }}</label>

                    <div class="col-md-7 pull-left">
                        <profile-settings-avatar giphy_id="{{$user->avatar_giphy_id}}"></profile-settings-avatar>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="avatar_giphy_id" class="col-md-3 col-form-label text-md-right">{{ __('Your handle') }}</label>

                    <div class="col-md-7">
                        <input disabled id="handle" type="text" class="form-control" name="handle" value="{{ $user->handle }}" required>

                        @error('handle')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="avatar_giphy_id" class="col-md-3 col-form-label text-md-right">{{ __('Your name') }}</label>

                    <div class="col-md-7">
                        <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
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
