@extends('layouts.master')

{{-- Form for adding a new review. --}}

@section('title')
    Add Review
@endsection

@section('content')  
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h2>Share your UX Review for {{$item->name}}</h1>
            <h4>Tell us your user experience - good, bad or ugly.</h4>
            <form method="post" action="/add_review_action">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$item->id}}">
                <br><label for="Username">Username</label>
                <input type="username" class="form-control" id="exampleInputEmail1" placeholder="Username" name="username">
                <br><label>Rating</label>
                <select class="form-control" placeholder="Rating" name="rating">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
                <br><label>Review</label>
                <textarea class="form-control" rows="3" placeholder="Write away!" name="description"></textarea><br>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
            <br><button type="button" class="btn btn-info"><a style="text-decoration : none; color : #FFFFFF;" href="{{url("/")}}">Home</a></button>
        </div>
    </div>
@endsection