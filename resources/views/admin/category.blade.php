@extends('layouts.app')

@section('content')

<div class="container">

        <h2 class="text-muted text-center">Categories Information</h2>

        @if(count($cats) == 0)

        <div class="d-flex justify-content-center">
            <h4 class="text-center">There Is No Categories To Show <a href="/add?action=category" role="button">Add</a> New Category</h4>
        </div>
        @else
        <table class="table table-striped text-center">
            <tr>
                <th>#ID</th>
                <th>Name</th>
                <th>Desctiption</th>
                <th>Created At</th>
                <th>Control</th>
            </tr>
    
            @foreach($cats as $cat)
            <tr>
                <td>{{$cat->id}}</td>
                <td>{{$cat->name}}</td>
                <td>{{$cat->description}}</td>
                <td>{{$cat->created_at}}</td>
                <td>
                    <a href="/edit?action=category&id={{$cat->id}}" class="btn btn-success btn-sm" role="button"> Edit</a>
                    <a href="/category?catid={{$cat->id}}" class="btn btn-danger btn-sm confirm" role="button"> Del</a>
                </td>
            </tr>
            @endforeach
    
        </table>
        <a href="/add?action=category" class="btn btn-outline-primary" role="button">Add</a>
        @endif
        
    
    </div>

@endsection