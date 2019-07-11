@extends('layouts.master')

{{-- Lets user know if there has been an error --}}

@section('title')
    Error
@endsection

@section('content')  
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            {{-- Display the error --}}
            <h3 class="alert">{{$error}}</h3>
            <br><button type="button" class="btn btn-info"><a style="text-decoration : none; color : #FFFFFF;" href="{{url("/")}}">Home</a></button>
        </div>
    </div>
@endsection