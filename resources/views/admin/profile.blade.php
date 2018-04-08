@extends('layouts.app')

@section('content')


<header class="mb-3 d-flex justify-content-center">
    <div class="img">
        <img src="upload/{{$user->img}}" alt="user image"/>
    <h1 class="text-white">{{$user->fullname == ""?$user->name:$user->fullname}}</h1>
    </div>
</header>


<div class="container">
   
    <!-- Start Main Information
    <div class="card-group">
        <div class="card">
            <div class="card-header bg-primary text-white">Main Information <i class="fa fa-chevron-left float-right"></i></div>
            <div class="card-body p-0">
                <ul class="list-unstyled">
                    <li class="p-2">Test</li>
                    <li class="p-2">Test</li>
                    <li class="p-2">Test</li>
                    <li class="p-2">Test</li>
                    <li class="p-2">Test</li>
                    
                </ul>
            </div>
        </div> 

        <div class="card">
                <div class="card-header bg-primary text-white">Latest Comments <i class="fa fa-chevron-left float-right"></i></div>
                <div class="card-body p-0">
                    <ul class="list-unstyled">
                        <li class="p-2">Test</li>
                        <li class="p-2">Test</li>
                        <li class="p-2">Test</li>
                        <li class="p-2">Test</li>
                        <li class="p-2">Test</li>
                        
                    </ul>
                </div>
            </div> 
    </div> <!-- End Card Group --> 

    @if(count($items) > 0)
    <ul class="list-unstyled list-inline nav">
        <li class="filter nav-item btn selected btn-outline-primary mr-1" data-filter="all">All</li>
        @foreach($cats as $cat)
        <li class="filter nav-item btn btn-outline-primary mr-1 text-capitalize" data-filter=".{{$cat->name}}">{{$cat->name}}</li>
        @endforeach
    </ul>

    <div class="gallary mt-3">
        <div class="row">
            @foreach($items as $item)
            <div class="mix col-md-6 col-lg-3 mb-3 {{$item->cat_name}}">
                <div class="card text-center">
                    <div class="card-body">
                        <img src="items/{{$item->img}}" class="card-img-top" alt="image card"/>
                        <h3 class="card-title p-3">{{$item->name}}</h3>
                        <p class="card-subtitle">{{$item->description}}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @else

    <h2 class="text-center">
        There's No Prodect To Show <a href="/add?action=item" >Add</a> New Prodect.
    </h2>

    @endif

</div>

@endsection