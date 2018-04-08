@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="text-muted text-center">Comments Information</h2>

    @if(count($comments) == 0)

    <div class="text-center">
        <h4>There Is No Comments To Show</h4>
    </div>

    @else
    <table class="table table-striped text-center">
        <tr>
            <th>#ID</th>
            <th>Comment</th>
            <th>Control</th>
        </tr>

        @foreach($comments as $comment)
        <tr>
            <td>{{$comment->id}}</td>
            <td>{{$comment->comment}}</td>
            <td>
                <a href="/edit?action=comment&id={{$comment->id}}" class="mb-1 btn btn-success btn-sm" role="button"> Edit</a>
                <a href="/comment?commentid={{$comment->id}}" class="btn btn-danger btn-sm confirm" role="button"> Del</a>
            </td>
        </tr>
        @endforeach

    </table>
    @endif
</div>

@endsection