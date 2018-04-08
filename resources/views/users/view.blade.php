@extends('layouts.index')
@section('style')
<style>
    .list-group-item small{
        position: absolute;
        right: 20px;
        bottom: 2px;
        font-size: 12px;
    }
    .list-group-item{
        padding: 1.25rem;
    }
</style>

@endsection
@section('content')

<div class="container py-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card main-page">
                <div class="card-body">
                    <div class="img-container view">
                        <img src="/items/{{$item->img}}" class="card-img" style="max-height:100%;" alt="{{$item->name}}" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">

                    <ul class="list-unstyled">
                        <li class="py-3"><span class="text-danger text-capitalize text-bold"> Name : </span>{{$item->name}}</li>
                        <li class="py-3">{{$item->description}}</li>
                        <li class="py-3"><span class="text-danger text-capitalize text-bold">Owner : </span> <a href="/profile/{{$user->id}}" > {{$user->name}}</a></li>
                        <li class="py-3"><span class="text-danger text-capitalize text-bold">Category : </span> <a href="/category/{{$cat->id}}" > {{$cat->name}}</a></li>
                        <li class="py-3"><span class="text-danger text-capitalize text-bold">Create At : </span>{{$item->created_at->toDayDateTimeString()}}</li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
    <div class="form mt-4 d-flex  justify-content-end row">
        <form id="comment" action="/message" method="post" class="col-md-8">
            @csrf
            <input type="hidden" name="id" value="{{$item->id}}">
            <div class="form-group">
                <textarea id="msg" required="required" class="form-control" rows="8" placeholder="Your Comment" name="message"></textarea>
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-outline-primary">Send</button>
            </div>
            <div class="error">

            </div>
        </form>
    </div>
   
    <ul class="list-unstyled list-group mt-4" id="list">
        @foreach ($comments as $comment)
            <li class="list-group-item mb-2">
                <?php echo nl2br($comment->comment)?>
                <small><a href="/profile/{{$comment->user_id}}"><strong>{{\App\User::find($comment->user_id)->name}}</strong> -{{$comment->created_at->toDayDateTimeString()}}</a></small>
            </li>
        @endforeach
    </ul>

</div>
@endsection
@section('script')
<script>

    $('#comment').submit(function(e){
        e.preventDefault();
        @guest
            message = '<div class="alert alert-danger text-center text-bold">'
                +'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'
                +'You must Login First!'
                +'</div>'
            $('.error').html(message);
            return;
        @else
            $('.error').html("");
        
         message = $("#msg").val();
         userid = {{Auth::id()}}
         itemid = {{$item->id}}
        $.get('/message',
        {
            'message':message,
            'userid':userid,
            'itemid':itemid,
            '_token':$('input[name=_token]').val()

        },function(res){
            
            $('#list').load(location.href + " #list")
            $("#msg").val("");
        });
        @endguest
    });


</script>

@endsection