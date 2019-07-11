@extends('layouts.master')

{{-- Form to update an item --}}

@section('title')
    Update item
@endsection

@section('content')  
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h2>Update item</h1>
            <h4>Something not right? Make some changes.</h4>
            <form method="post" action="/update_item_action">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$item->id}}">
                <br><label for="name">Product Name</label>
                <input type="name" class="form-control" id="exampleInputEmail1" value="{{$item->name}}" name="name">
                <br><label for="designer">Designer</label>
                <input type="designer" class="form-control" id="exampleInputEmail1" value="{{$item->designer}}" name="designer">
                <br><label for="link">Link to UX</label>
                <input type="link" class="form-control" id="exampleInputEmail1" value="{{$item->link}}" name="link">
                <br><label>Summary of site/app</label>
                <textarea class="form-control" rows="3" name="summary">{{$item->summary}}</textarea><br>
                <button type="submit" class="btn btn-warning">Update</button>
            </form>
            <br><button type="button" class="btn btn-info"><a style="text-decoration : none; color : #FFFFFF;" href="{{url("/")}}">Home</a></button>
        </div>
    </div>
@endsection