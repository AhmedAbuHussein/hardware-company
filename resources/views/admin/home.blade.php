@extends('layouts.app')

@section('content')
<div class="container">
    <!-- start box data -->
   <div class="row">
       <div class="col-md-6 col-lg-3 mb-4">
           <div class="card text-white bg-dark pt-0 pb-0">
               <div class="card-body text-center">
                   <h4>Users</h4>
               <h3 class="display-3">{{$userNum}}</h3>
                   <div class="card-footer bg-dark py-0">
                       <a class="text-white" href="/users">more</a>
                   </div>

               </div>
           </div>
       </div>

       <div class="col-md-6 col-lg-3 mb-4">
        <div class="card text-white bg-primary pt-0 pb-0">
            <div class="card-body text-center">
                <h4>Categories</h4>
                <h3 class="display-3">{{$catNum}}</h3>
                <div class="card-footer bg-primary py-0">
                    <a class="text-white" href="/category">more</a>
                </div>

            </div>
        </div>
    </div>


    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card text-white bg-warning pt-0 pb-0">
            <div class="card-body text-center">
                <h4>Items</h4>
                <h3 class="display-3">{{$itemNum}}</h3>
                <div class="card-footer bg-warning py-0">
                    <a class="text-white" href="/item">more</a>
                </div>

            </div>
        </div>
    </div>


    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card text-white bg-success pt-0 pb-0">
            <div class="card-body text-center">
                <h4>Comments</h4>
                <h3 class="display-3">{{$commentNum}}</h3>
                <div class="card-footer bg-success py-0">
                    <a class="text-white" href="/comment">more</a>
                </div>

            </div>
        </div>
    </div>
    
   </div>
    <!-- end box data -->

    <!-- start show data -->
    <div class="row">

            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header bg-dark text-white">Latest {{count($latsUser)}} Users <i class="fa fa-chevron-left float-right"></i></div>
                    <div class="card-body p-0">
                        <ul class="list-unstyled">
                            @foreach($latsUser as $user)
                            <li class="p-2">{{$user->name}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
    
            <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header bg-dark text-white">Latest {{count($latsItems)}} Items <i class="fa fa-chevron-left float-right"></i></div>
                        <div class="card-body p-0">
                            <ul class="list-unstyled">
                                @foreach($latsItems as $item)
                                <li class="p-2">{{$item->name}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
    
        </div>
    
    
        <!-- End show data -->




</div>
@endsection
