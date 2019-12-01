@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Stats</h1>
            <table class="table table-striped table-bordered">
                <tr>
                    <th>Users</th>
                    <td>{{ $stats['users'] }}</td>
                </tr>
                <tr>
                    <th>Giphs</th>
                    <td>{{ $stats['giphs'] }}</td>
                </tr>
                <tr>
                    <th>Jay-Z's</th>
                    <td>{{ $stats['jay-zs'] }}</td>
                </tr>
                <tr>
                    <th>Likes</th>
                    <td>{{ $stats['likes'] }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
