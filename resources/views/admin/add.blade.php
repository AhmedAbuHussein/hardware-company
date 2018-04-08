@extends('layouts.app')


@section('content')

    <!-- user add sectio  -->
    @if($action == 'user')
    <div class="container">
        <h2 class="text-center text-muted">Add User</h2>
        
            <form class="form-horizontal" action="/add?action=user" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <input type="hidden" value="user" name="action"/>
                    <div class="form-group col-12">
                        <label for="name" class="sr-only control-label">Name</label>
                    <input type="text" required="required" id="name" value="{{Request::old('name')}}" name="name" placeholder="User Name greater than 3 char" class="form-control {{$errors->has('name')?'error':''}}" />
                    </div>

                    <div class="form-group col-12">
                            <label for="email" class="sr-only control-label">Email</label>
                            <input type="email" required="required" id="email" value="{{Request::old('email')}}" name="email" placeholder="Email" class="form-control {{$errors->has('email')?'error':''}}" />
                        </div>

                    <div class="form-group col-12">
                        <label for="password" class="sr-only control-label">Password</label>
                        <input type="password" required="required" id="password" name="password" placeholder="User password greater than 3 char" class="form-control {{$errors->has('password')?'error':''}}" />
                    </div> 
                    
                    <div class="form-group col-12">
                        <label for="fullname" class="sr-only control-label">Full Name</label>
                        <input type="text" required="required" id="fullname"  value="{{Request::old('fullname')}}" name="fullname" placeholder="Full Name greater than 6 char" class="form-control {{$errors->has('fullname')?'error':''}}" />
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
                    <div class="form-group col-md-6">
                        <label for="upload" class="control-label">User Image</label>
                        <input type="file" name="url" id="upload" />
                        @if($errors->has('url'))
                        <span>{{$errors}}</span>
                        @endif
                    </div>
            
                    <div class="form-group col-12">
                        <button type="submit" class="btn btn-success">Add</button>
                    </div>
                </div>
            </form>
    </div>
    <!-- End user add sectio  -->
    @elseif($action == 'category')
    <div class="container">
       <h2 class="text-center text-muted">Add New Category</h2>
        <form class="form-horizontal" action="/add?action=category" method="POST" enctype="multipart/form-data">
           <div class="row">
                @csrf
                <input type="hidden" value="category" name="action"/>
                <div class="form-group col-12">
                    <label for="name" class="sr-only control-label">Name</label>
                    <input type="text" required="required" id="name" value="{{Request::old('name')}}" name="name" placeholder="Category name greater than 3 char" class="form-control {{$errors->has('name')?'error':''}}" />
                </div>

                <div class="form-group col-12">
                    <label for="desc" class="sr-only control-label">description</label>
                    <textarea required="required" id="desc" name="description" placeholder="Category description greater than 10 char" class="form-control {{$errors->has('description')?'error':''}}" rows="3" >{{Request::old('description')}}</textarea>
                </div>

                <div class="form-group col-12">
                    <label for="order" class="sr-only control-label">order</label>
                    <input type="number" required="required" id="oreder" value="{{Request::old('ordering')}}" name="ordering" placeholder="Category Order Number" class="form-control {{$errors->has('ordering')?'error':''}}" />
                </div>

                <div class="form-group col-12">
                    <button type="submit" class="btn btn-success">Add</button>
                </div>
            </div>
       
        </form>

    </div>

     <!-- End Category add sectio  -->
     @elseif($action == 'item')


    <div class="container">

    <form class="form-horizontal" action="/add?action=item" method="POST" enctype="multipart/form-data">
       <div class="row">
            @csrf
            <div class="form-group col-12">
                <input type="text" class="form-control {{$errors->has('name')?'error':''}}" value="{{Request::old('name')}}" name="name" placeholder="Item name greate than 3 char" required="required"/>
            </div>
            <div class="form-group col-12">
                <textarea rows="2" class="form-control {{$errors->has('description')?'error':''}}" name="description" placeholder="Item description greate than 10 char" required="required">{{Request::old('description')}}</textarea>
            </div>

            <div class="form-group col-12">
                <input type="text" class="form-control {{$errors->has('price')?'error':''}}" value="{{Request::old('price')}}" name="price" placeholder="Item price" required="required"/>
            </div>

            <div class="form-group col-12">
                <input type="text" class="form-control {{$errors->has('county')?'error':''}}" value="{{Request::old('county')}}" name="country" placeholder="country of made" required="required"/>
            </div>

            <div class="form-group col-12">
                <input type="file" max="1" class="form-control {{$errors->has('county')?'error':''}}" value="{{Request::old('url')}}" name="url" />
                @if($errors->has('url'))
                <span>{{$errors->all->url}}</span>
                @endif
            </div>

            <div class="form-group col-md-6">
                <label class="control-label">Item Status</label>
                <select name="status" class="form-control">
                    <option value="">Choose</option>
                    <option value="0">New</option>
                    <option value="1">Like New</option>
                    <option value="2">Used</option>
                    <option value="3">Old</option>
                </select>
            </div>
                <div class="form-group col-md-6">
                <label class="control-label">Item Approve</label>
                <select name="approve" class="form-control">
                    <option value="">Choose</option>
                    <option value="1">Register</option>
                    <option value="0">Not Yet</option>
                </select>
            </div>

            <div class="form-group col-md-6">
                <label class="control-label">Item Owner</label>
                <select name="user_id" class="form-control">
                    <option value="">Choose</option>

                    @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach

                </select>
            </div>

            <div class="form-group col-md-6">
                <label class="control-label">Item Category</label>
                <select name="category_id" class="form-control">
                    <option value="">Choose</option>
                    @foreach($cats as $cat)
                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-12">
                <button type="submit" class="btn btn-success">Add</button>
            </div>
        </div>
    </form>

    </div>


    @endif
    
@endsection

