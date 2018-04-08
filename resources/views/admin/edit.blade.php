@extends('layouts.app')

@section('content')

<!-- user edit informaion -->

@if($action == 'user')

<div class="container">
    <h2 class="text-center text-muted">Edit User Information</h2>
    
        <form class="form-horizontal" action="/edit" method="POST" enctype="multipart/form-data">

            @csrf
            <div class="row">
                <input type="hidden" value="{{$data->id}}" name="id"/>
                <input type="hidden" value="user" name="action"/>
                <div class="form-group col-12">
                    <label for="name" class="sr-only control-label">Name</label>
                    <input type="text"  required="required" id="name" value="{{$data->name}}" name="name" placeholder="User Name" class="form-control {{$errors->has('name')?'error':''}}" />
                </div>

                <div class="form-group col-12">
                        <label for="email" class="sr-only control-label">Email</label>
                        <input type="email" required="required" id="email" value="{{$data->email}}" name="email" placeholder="Email" class="form-control {{$errors->has('email')?'error':''}}" />
                    </div>

                <div class="form-group col-12">
                    <label for="password" class="sr-only control-label">Password</label>
                    <input type="password" required="required" id="password" name="password" placeholder="User password" class="form-control {{$errors->has('password')?'error':''}}" />
                </div> 
                
                <div class="form-group col-12">
                    <label for="fullname" class="sr-only control-label">Full Name</label>
                    <input type="text" required="required" id="fullname"  value="{{$data->fullname}}" name="fullname" placeholder="Full Name" class="form-control {{$errors->has('fullname')?'error':''}}" />
                </div>

                <div class="form-group col-md-6">
                    <label for="groupid" class="control-label">Group Id</label>
                    <select id="groupid" name="groupid" class="form-control {{$errors->has('groupid')?'error':''}}">
                        <option value="">Choose..</option>
                        <option value="1">Admin</option>
                        <option value="0">User</option>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="regstatus" class="control-label">Registration Status</label>
                    <select id="regstatus" name="regstatus" class="form-control {{$errors->has('regstatus')?'error':''}}">
                        <option value="">Choose..</option>
                        <option value="1">Register</option>
                        <option value="0">Wait To Verify</option>
                    </select>
                </div>

                <div class="form-group col-12">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </div>
        </form>
    
</div>

@elseif($action == "category")
<!-- Cagegory edit informaion -->
<div class="container">
   
    <h2 class="text-center text-muted">Edit Category</h2>
        <form class="form-horizontal" action="/edit" method="POST" enctype="multipart/form-data">
            <div class="row">
                @csrf
                <input type="hidden" value="{{$data->id}}" name="id"/>
                <input type="hidden" value="category" name="action"/>
                <div class="form-group col-md-6">
                    <label for="name" class="control-label">Name</label>
                    <input type="text" required="required"  id="name" value="{{$data->name}}" name="name" placeholder="Category name greater than 3 char" class="form-control {{$errors->has('name')?'error':''}}" />
                </div>

                <div class="form-group col-md-6">
                    <label for="order" class="control-label">order</label>
                    <input type="number" required="required" id="oreder" value="{{$data->ordering}}" name="ordering" placeholder="Category Order Number" class="form-control {{$errors->has('ordering')?'error':''}}" />
                </div>

                <div class="form-group col-12">
                    <label for="desc" class="control-label">description</label>
                    <textarea required="required" id="desc" name="description" placeholder="Category description greater than 10 char" class="form-control {{$errors->has('description')?'error':''}}" rows="3" >{{$data->description}}</textarea>
                </div>

                <div class="form-group col-12">
                    <button type="submit" class="btn btn-success">Edit</button>
                </div>
            </div>
       
        </form>


</div>

@elseif($action == "item")
<!-- Cagegory edit informaion -->

<div class="container">

    <form class="form-horizontal" action="/edit?action=item" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <input type="hidden" value="{{$data->id}}" name="id"/>
            <input type="hidden" value="item" name="action"/>
            <div class="form-group col-12">
                <input type="text" class="form-control {{$errors->has('name')?'error':''}}" value="{{$data->name}}" name="name" placeholder="Item name greate than 3 char" required="required"/>
            </div>
            <div class="form-group col-12">
                <textarea rows="2" class="form-control {{$errors->has('description')?'error':''}}" name="description" placeholder="Item description greate than 10 char" required="required">{{$data->description}}</textarea>
            </div>

            <div class="form-group col-12">
                <input type="text" class="form-control {{$errors->has('price')?'error':''}}" value="{{$data->price}}" name="price" placeholder="Item price" required="required"/>
            </div>

            <div class="form-group col-12">
                <input type="text" class="form-control {{$errors->has('county')?'error':''}}" value="{{$data->country}}" name="country" placeholder="country of made" required="required"/>
            </div>

            <div class="form-group col-md-6">
                <label class="control-label">Item Status</label>
                <select name="status" class="form-control">
                    <option value="">Choose</option>
                    <option value="0" {{$data->status == 0 ?'selected':''}}>New</option>
                    <option value="1" {{$data->status == 1 ?'selected':''}}>Like New</option>
                    <option value="2" {{$data->status == 2 ?'selected':''}}>Used</option>
                    <option value="3" {{$data->status == 3 ?'selected':''}}>Old</option>
                </select>
            </div>
                <div class="form-group col-md-6">
                <label class="control-label">Item Approve</label>
                <select name="approve" class="form-control">
                    <option value="">Choose</option>
                    <option value="1" {{$data->approve == 0 ?'selected':''}}>Register</option>
                    <option value="0" {{$data->approve == 1 ?'selected':''}}>Not Yet</option>
                </select>
            </div>

            <div class="form-group col-md-6">
                <label class="control-label">Item Owner</label>
                <select name="cat_id" class="form-control">
                    <option value="">Choose</option>

                    @foreach($users as $user)
                        @if($data->user_id == $user->id)
                            <option value="{{$user->id}}" selected>{{$user->name}}</option>
                        @else
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endif
                    @endforeach

                </select>
            </div>

            <div class="form-group col-md-6">
                <label class="control-label">Item Category</label>
                <select name="user_id" class="form-control">
                    <option value="">Choose</option>
                        @foreach($cats as $cat)
                            @if($data->cat_id == $cat->id)
                                <option value="{{$cat->id}}" selected>{{$cat->name}}</option>
                            @else
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                            @endif
                        @endforeach
                </select>
            </div>
            <div class="col-12 form-group">
                <button type="submit" class="btn btn-success">Add</button>
            </div>
        </div>

    </form>

    </div>


@endif

@endsection