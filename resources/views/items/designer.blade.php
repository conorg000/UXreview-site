@extends('layouts.master')

{{-- Page for a designer, listing all of their items. --}}

@section('title')
    Designer Portfolio
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <br><h1>Designs by {{$portfolio[0]->designer}}</h1><br>
            <h3>The UX career so far.</h3>
            <table class="table table-hover">
                <tr><td align="center">UX</td><td></td><td align="center">Summary</td><td align="center">Link</td></tr>
                {{-- Loop through portfolio array, displaying elements of of each piece of work. --}}
                @foreach($portfolio as $work)
                <tr><td align="center"><br>{{$work->name}}<br><br></td><td align="center"><br><a href="{{url("ux_reviews/$work->id")}}">See more</a><br><br></td><td align="center"><br>{{$work->summary}}<br><br></td><td align="center"><br><a href="{{url("$work->link")}}">Visit site</a><br><br></td></tr>
                @endforeach
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <br><button type="button" class="btn btn-info btn-lg btn-block"><a style="text-decoration : none; color : #FFFFFF;" href = "{{url("/")}}">Home</a></button><br><br>
        </div>
    </div>
@endsection