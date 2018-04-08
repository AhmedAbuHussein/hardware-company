@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="text-muted text-center">Items Information</h2>

    @if(count($items) == 0)

    <div class="text-center">
        <h4>There Is No Items To Show <a href="/add?action=item" >Add</a> New Item</h4>
    </div>

    @else
    <table class="table table-striped text-center">
        <tr>
            <th>#ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Created At</th>
            <th>Control</th>
        </tr>

        @foreach($items as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->description}}</td>
            <td>{{$item->price}}</td>
            <td>{{$item->created_at}}</td>
            <td>
                <a href="/edit?action=item&id={{$item->id}}" class="btn btn-success btn-sm" role="button"> Edit</a>
                <a href="/item?itemid={{$item->id}}" class="btn btn-danger btn-sm confirm" role="button"> Del</a>
            </td>
        </tr>
        @endforeach

    </table>
    <a href="/add?action=item" class="btn btn-outline-primary" role="button">Add</a>
    @endif
</div>

@endsection