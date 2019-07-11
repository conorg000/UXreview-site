@extends('layouts.master')

{{-- Home page, listing all items, their average rating and their number of reviews --}}

@section('title')
  UX Review
@endsection

@section('content')
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <img src="https://s5.postimg.cc/mmd3m76uf/uxui.png" style="display: block; margin-left: auto; margin-right: auto;" height=450>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-4 col-xs-offset-1">
      <h2>UX Case Studies</h2>
      {{-- If items contains something, loop through and list the items --}}
      @if($items)
        <table class="table table-hover">
        @foreach($items as $item)
          <tr><td align="left"><a href = "{{url("ux_reviews/$item->id")}}">{{$item->name}}</a></td></tr>
        @endforeach
        </table>
      {{-- Otherwise, tell user that there are no items --}}
      @else
        <p>No items found</p>
      @endif
    </div>
    <div class="col-xs-3">
      <h2>Average rating</h2>
      <table class="table table-hover">
      {{-- Loop through array of averages, printing out the result --}}
      @foreach($averages as $average)
        @foreach($average as $result)
          <tr><td align="center">{{$result}}</td></tr>
        @endforeach
      @endforeach
      </table>
    </div>
    <div class="col-xs-3">
      <h2>Number of reviews</h2>
      <table class="table table-hover">
      {{-- Loop through array of review counts, printing out result --}}
        @foreach($revcount as $rev)
          <tr><td align="center">{{$rev}}</td></tr>
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