@extends('layouts.master')

{{-- Lists items in descending order of average rating --}}

@section('title')
  Sorted by Average Rating
@endsection

@section('content')
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <br><h1>UX by Average Rating</h1><br>
      <h3>The best UX, as voted by you</h3>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-4 col-xs-offset-2">
      <table class="table table-hover">
        <tr><td align="center"><b>UX</b></td></tr>
        {{-- Loop through the array of items and use the important information--}}
        @foreach($byrating as $item)
          <tr><td align="center"><a href="{{url("ux_reviews/$item->id")}}">{{$item->name}}</a></td></tr>
        @endforeach
      </table>
    </div>
    <div class="col-xs-4">
      <table class="table table-hover">
        <tr><td align="center"><b>Average rating</b></td></tr>
        {{-- Loop through array of arrays, then use value in the associative array (the average rating) --}}
        @foreach($averages as $sort)
          @foreach($sort as $key => $value)
            <tr><td align="center">{{$value}} / 5.0</td></tr>
          @endforeach
        @endforeach
      </table>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <br><button type="button" class="btn btn-info btn-lg btn-block"><a style="text-decoration : none; color : #FFFFFF;" href = "{{url("add_item")}}">Add Item</a></button><br><br>
    </div>
  </div>
@endsection