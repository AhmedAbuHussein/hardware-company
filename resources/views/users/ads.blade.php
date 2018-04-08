
@extends('layouts.index')

@section('content')

<div class="container">
        <h2 class="text-center m-4">Add new Item</h2>
        <form class="form-horizontal" action="/newads" method="POST" enctype="multipart/form-data">
           <div class="row">
                @csrf
                <input type="hidden" name="user_id" value="{{Auth::id()}}">
                <input type="hidden" name="approve" value="1">
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

@endsection