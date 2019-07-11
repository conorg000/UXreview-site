@extends('layouts.master')

{{-- Lists users by their cumulative karma rating --}}

@section('title')
  Users sorted by karma
@endsection

@section('content')
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <br><h1>Reviewers sorted by karma</h1><br>
        <h3>Find out whose opinion matters most</h3>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-4 col-xs-offset-2">
      <table class="table table-hover">
        <tr><td align="center"><b>User</b></td></tr>
        {{-- For each element in the associative array, print out the key (the username) --}}
        @foreach($ranked as $user => $score)
          <tr><td align="center">{{$user}}</td></tr>
        @endforeach
      </table>
    </div>
    <div class="col-xs-4">
      <table class="table table-hover">
        <tr><td align="center"><b>Total Karma</b></td></tr>
        {{-- For each array in the associative array, loop through the array and print out the total --}}
        @foreach($ranked as $user)
          @foreach($user as $total)
            <tr><td align="center">{{$total}}</td></tr>
          @endforeach
        @endforeach
      </table>
    </div>
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <br><button type="button" class="btn btn-info btn-lg btn-block"><a style="text-decoration : none; color : #FFFFFF;" href = "{{url("add_item")}}">Add Item</a></button><br><br>
    </div>
  </div>
@endsection