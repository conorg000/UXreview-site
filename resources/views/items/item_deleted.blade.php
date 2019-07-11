@extends('layouts.master')

{{-- Lets user know if their deletion has succeeded or not --}}

@section('title')
    Item deleted
@endsection

@section('content')  
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            {{-- If the error function returns nothing, then there are no errors --}}
            @if (!empty($error))
                <p class="alert">{{$err}}</p>
            @else
                <h2>Item deleted</h1>
            @endif
            <br><button type="button" class="btn btn-info"><a style="text-decoration : none; color : #FFFFFF;" href="{{url("/")}}">Home</a></button>
        </div>
    </div>
@endsection