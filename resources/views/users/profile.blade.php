@extends('layouts.index')

@section('style')
    <style>
                
        /******** profile edit******/

        header {
            background: url('../img/header.jpg') no-repeat center center;
            background-size: cover;
            height: 30rem;
            margin-top: -1.2rem;
            align-items: center;
        }

        header>div.img {
            text-align: center;
        }

        header>div.img img {
            width: 15rem;
            height: 15rem;
            border-radius: 100%;
            border: .15rem solid #dfe6eb;
            background: #FFF;
            padding: .1rem;
        }

        .mix {
            display: none;
        }

        .mix .card p.card-subtitle {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .card-img-top{
            min-height: 13rem !important;
        }
        .list-unstyled li:nth-child(even){
            background: #eaf1f7;
        }
        .list-unstyled li>span{
            width: 30%;
            display: inline-block;
            color: #0835f5;
            font-weight: bold;
            font-size: 1.2em;
        }
    </style>
@endsection
@section('content')


<header class="mb-3 d-flex justify-content-center">
    <div class="img">
        <img src="/upload/{{$user->img}}" alt="user image"/>
    <h1 class="text-white">{{$user->fullname == ""?$user->name:$user->fullname}}</h1>
    </div>
</header>


<div class="container">
   
    <!-- Start Main Information -->
    <div class="card-group mb-4">
        
        <div class="card order-sm-1">
            <div class="card-header card-toggle bg-primary text-white">Personal Information <i class="fa fa-chevron-left float-right"></i></div>
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="text-center">Main Information</h3>
                        <ul class="list-unstyled m-2">
                            <li class="p-2"><span>Name</span>{{$user->fullname}}</li>
                            <li class="p-2"><span>E-mail</span>{{$user->email}}</li>
                            <li class="p-2"><span>role</span>{{$user->groupid == 1?'Admin':'User'}}</li>
                            <li class="p-2"><span>Status</span>{{$user->regstatus==1?'Registered':'Not-Registered'}}</li>                           
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <h3 class="text-center">Items Information</h3>
                        <ul class="list-unstyled m-2">
                            <li class="p-2"><span># of Items </span>{{count($items)}} Items</li>
                            <li class="p-2"><span>Total price </span>${{$price}}</li>
                        </ul>
                    </div>
                </div>
               
            </div>
        </div> 

    </div> 
     <!--End Card Group --> 

    @if(count($items) > 0)
        <ul class="list-unstyled list-inline nav">
            <li class="filter nav-item btn selected btn-outline-primary mr-1" data-filter="all">All</li>
            @foreach($cats as $cat)
            <li class="filter nav-item btn btn-outline-primary mr-1 text-capitalize" data-filter=".{{str_replace(' ','-',$cat->name)}}">{{$cat->name}}</li>
            @endforeach
        </ul>

        <div class="gallary mt-3">
            <div class="row">
                @foreach($items as $item)
                <div class="mix col-md-6 col-lg-3 mb-3 {{$item->cat_name}}">
                    <div class="card text-center">
                        <div class="card-body">
                            <img src="/items/{{$item->img}}" class="card-img-top" alt="image card"/>
                            <h3 class="card-title p-3"><a href="/view/{{$item->id}}">{{$item->name}}</a></h3>
                            <p class="card-subtitle">{{$item->description}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    @else

    <h2 class="text-center">
        There is No Prodect To Show.
    </h2>

    @endif

</div>

@endsection