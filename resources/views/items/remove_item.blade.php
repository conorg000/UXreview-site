@extends('layouts.master')

{{-- Form to delete an item. --}}

@section('title')
    Delete item
@endsection

@section('content')  
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h2>Delete item</h1>
            <h4>Deleting an item will remove its information and all associated reviews.</h4>
            <h4>Are you sure you want to delete?</h4>
            <form method="post" action="/remove_item_action">
                {{-- CSRF token --}}
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$item->id}}">
                <br><label for="Product">Product</label>
                <input type="text" class="form-control" id="disabledInput" value="{{$item->name}}" palceholder="{{$item->name}}" disabled>
                <br><label for="Designer">Designer</label>
                <input type="text" class="form-control" id="disabledInput" value="{{$item->designer}}" placeholder="{{$item->designer}}" disabled>
                <br><button type="submit" class="btn btn-danger">Delete</button>
            </form>
            <br><button type="button" class="btn btn-info"><a style="text-decoration : none; color : #FFFFFF;" href="{{url("/")}}">Home</a></button>
        </div>
    </div>
@endsection