@extends('layouts.master')

{{-- Displays information and reviews for an item --}}

@section('title')
    UX Review
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>UX Review for {{$item->name}}</h1><br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5 col-md-offset-1">
            <h3>Designed by {{$item->designer}}</h3>
            {{-- Loop through the array, pulling out the average--}}
            @foreach($average as $avg)
                <br><h4>Average rating: {{$avg}} / 5.0</h4>
            @endforeach
            {{-- Get important information from the item variable --}}
            <h4>(From {{$revcount}} reviews)</h4><br>
            <h4>Quick overview: {{$item->summary}}</h4><br>
            <p><a class="btn btn-info btn-lg" role="button" target="_blank" href="{{url("$item->link")}}">Visit UX</a></p>
            <p><a class="btn btn-default btn-lg" role="button" href="{{url("/")}}">Back</a></p><br>
            <br><p><a class="btn btn-warning btn-sm" role="button" href="{{url("update_item/$item->id")}}">Update item</a></p>
            <p><a class="btn btn-danger btn-sm" role="button" href="{{url("remove_item/$item->id")}}">Delete item</a></p>
        </div>
        <div class="col-md-5 col-md-offset-1">
            <div class="row">
                <h2>UX Reviews</h2>
                <table class="table table-striped">
                    <tr><td>Rating</td><td>User Review</td><td>Username</td><td>Karma</td><td></td><td></td><td></td></tr>
                    {{-- Loop through the array of reviews, printing out key info from each review --}}
                    @foreach($reviews as $review)
                    <tr><td align="center">{{$review->rating}} / 5</td><td>{{$review->description}}</td><td>{{$review->username}}</td><td align="center">{{$review->score}}</td>
                    <td><a href="{{url("good_karma/$item->id/$review->username")}}">👍</a></td><td><a href="{{url("bad_karma/$item->id/$review->username")}}">👎</a></td>
                    <td><a role="button" class="btn btn-default btn-xs" href="{{url("update_review/$item->id/$review->username")}}">Edit</a></td></tr>
                    @endforeach
                </table>
            </div>
            <div class="row">
                <div class="col-md-offset-4">
                    <br><a class="btn btn-info btn-lg" role="button" href="{{url("add_review/$item->id")}}">Share your opinion</a>
                </div>
            </div>
        </div>
    </div>
@endsection