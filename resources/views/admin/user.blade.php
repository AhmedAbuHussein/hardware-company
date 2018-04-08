@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="text-muted text-center">Users Information</h2>

    @if(count($users) == 0)

    <div class="text-center">
        <h4>There Is No Users To Show <a href="#" >Add</a> New User</h4>
    </div>

    @else
    <table class="table table-striped text-center">
        <tr>
            <th>#ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Full Name</th>
            <th>Created At</th>
            <th>Last update</th>
            <th>Control</th>
        </tr>

        @foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td><a href="/profile?userid={{sha1($user->id)}}">{{$user->name}}</a></td>
            <td>{{$user->email}}</td>
            <td>{{$user->fullname}}</td>
            <td>{{$user->created_at}}</td>
            <td>{{$user->updated_at}}</td>
            <td>
                <a href="/edit?action=user&id={{$user->id}}" class="btn btn-success btn-sm" role="button"> Edit</a>
                <a href="/users?userid={{$user->id}}" class="btn btn-danger btn-sm confirm" role="button"> Del</a>
            </td>
        </tr>
        @endforeach

    </table>
    <a href="/add?action=user" class="btn btn-outline-primary" role="button">Add</a>
    @endif
</div>

@endsection