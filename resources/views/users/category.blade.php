@extends('layouts.index')

@section('content')

<div class="container py-3">
   
        @if(count($items) > 0)
    <div class="row">
       
        @foreach($items as $item)
        <div class="col-lg-3 col-md-4 col-sm-6">
            
            <div class="card main-page mb-3">
                <div class="overlay">
                    <div class="view-btn">
                        <a href="/view/{{$item->id}}" class="btn btn-outline-warning btn-lg" role="button">View</a>
                    </div>
                </div>
                <div class="card-body text-center">
                    <div class="img-container">
                        <span class="price"> ${{$item->price}} </span>
                        <img src="/items/{{$item->img}}" class="card-img-top" alt="{{$item->name}}" />
                    </div>
                    
                    <h3 class="card-title">{{$item->name}}</h3>
                    <p class="card-subtitle lead">{{$item->description}}</p>
                    <span class="card-subtitle text-muted text-small">{{$item->created_at->toDayDateTimeString()}}</span>
                </div>
            </div>

        </div>
        @endforeach
    </div>
    @else

    <div class="alert alert-success text-center text-bold">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        This page is empty!
    </div>

    @endif

</div>

@endsection