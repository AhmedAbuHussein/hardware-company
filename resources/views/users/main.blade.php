@extends('layouts.index')

@section('content')

<nav class="navbar navbar-extends-md bg-primary d-none d-md-block" id="searchNav">
    <div class="container">
        <form id="form"  method="post" action=""  class="form-inline">
            @csrf
            <div class="form-group">
                <input type="search" name="search" id="search" class="form-control" placeholder="Search.." />
            </div>
        </form>
    </div>
</nav>


<div class="container py-3">
   
    <div class="row" id="row">
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
                        <span class="price">${{$item->price}}</span>
                        <img src="items/{{$item->img}}" class="card-img-top" alt="{{$item->name}}" />
                    </div>
                    
                    <h3 class="card-title">{{$item->name}}</h3>
                    <p class="card-subtitle lead">{{$item->description}}</p>
                    <span class="card-subtitle text-muted text-small">{{$item->created_at->toDayDateTimeString()}}</span>
                </div>
            </div>

        </div>
        @endforeach
    </div>

</div>
@endsection
@section('script')
<script>
   
    $('#form').submit(function(e){
        e.preventDefault();
    });
    $("#search").keyup(function(){
        var text = $(this).val();
        $.get('/search',{'text':text,'_token':$("input[name=_token]").val()},function(res){
            res = JSON.parse(res)
            console.log(res.length);

            $('#row').html("");
            for(i=0;i<res.length;i++){

                doc = '<div class="col-lg-3 col-md-4 col-sm-6">'
                        +'<div class="card main-page mb-3">'
                            +'<div class="overlay">'
                                +'<div class="view-btn">'
                doc += '<a href="/view/'+res[i].id+'" class="btn btn-outline-warning btn-lg" role="button">View</a>'
                doc += ' </div> </div> <div class="card-body text-center"> <div class="img-container">'
                        +'<span class="price">$'+res[i].price+'</span>'
                        +'<img src="items/'+res[i].img+'" class="card-img-top" alt="'+res[i].name+'" /></div>'
                        +'<h3 class="card-title">'+res[i].name+'</h3>'
                        +'<p class="card-subtitle lead">'+res[i].description+'</p>'
                        +'<span class="card-subtitle text-muted text-small">'+res[i].created_at+'</span></div></div></div>';
                $('#row').append(doc);
            

            }                
        });
    });
   
</script>
@endsection