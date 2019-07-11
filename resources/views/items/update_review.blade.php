@extends('layouts.master')

{{-- Form for updating a review. The user can't change the username. --}}

@section('title')
    Update review
@endsection

@section('content')  
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h2>Update review by {{$review->username}} for {{$item->name}}</h1>
            <h4>Change your mind? Or just spell something wrong?</h4>
            <form method="post" action="/update_review_action">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$item->id}}">
                <input type="hidden" name="username" value="{{$review->username}}">
                <br><label for="Username">Username</label>
                <input class="form-control" id="disabledInput" type="text" placeholder="{{$review->username}}" disabled>
                <br><label>Rating</label>
                <select class="form-control" placeholder="Rating" name="rating">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
                <br><label>Review</label>
                <textarea class="form-control" rows="3" placeholder="Write away!" name="description">{{$review->description}}</textarea><br>
                <button type="submit" class="btn btn-success">Update</button>
            </form>
        </div>
    </div>
@endsection