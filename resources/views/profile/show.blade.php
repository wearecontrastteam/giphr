@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('partials.nav')
            <div class="col-md-9">
                <div class="row">
                    <div class="col mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-auto">
                                        <img src="{{ $user->getAvatarUrl() }}" class="rounded-circle profile-lg">
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                {{ $user->name }} <span class="text-muted">{{ '@'.$user->handle }}</span>
                                            </div>
                                            @if(auth()->id() === $user->id)
                                                <div class="col-lg-2 col-md-3 right text-right">
                                                    <a href="{{ route('profile.edit', $user) }}" class="btn btn-info">Edit</a>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col">
                                                {{ $user->giphs_count . ' ' . \Illuminate\Support\Str::plural('Giph', $user->giphs_count) }} Posted
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <giph-timeline user-handle="{{ $user->handle }}"></giph-timeline>
            </div>
        </div>
    </div>
@endsection
