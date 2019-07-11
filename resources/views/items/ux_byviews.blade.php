@extends('layouts.master')

{{-- Lists items in descending order of number of reviews --}}

@section('title')
  Sorted by Most Reviews
@endsection

@section('content')
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <br><h1>Most Reviewed</h1><br>
        <h3>The most discussed UX</h3>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-4 col-xs-offset-2">
      <table class="table table-hover">
        <tr><td align="center"><b>UX</b></td></tr>
        {{-- Loop through the array of items and use the important information--}}
        @foreach($byviews as $item)
          <tr><td align="center"><a href="{{url("ux_reviews/$item->id")}}">{{$item->name}}</a></td></tr>
        @endforeach
      </table>
    </div>
    <div class="col-xs-4">
      <table class="table table-hover">
        <tr><td align="center"><b>Number of reviews</b></td></tr>
        {{-- Loop through the array of values and print out the number--}}
        @foreach($revcount as $num)
          <tr><td align="center">{{$num}}</td></tr>
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