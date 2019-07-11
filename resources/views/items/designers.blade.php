@extends('layouts.master')

{{-- Lists all designers, linking to their individual page. --}}

@section('title')
    Designers
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <br><h1>UX Designers</h1><br>
            <h3>A brief list of creators</h3>
            <h3>Click a name to see their work</h3>
            <table class="table table-hover">
            {{-- Loop through array of designers, then loop through each designer's array of work --}}
            @foreach($designers as $designer)
                @foreach($designer as $name)
                    <tr><td align="center"><a href="{{url("designer/$name")}}">{{$name}}</a></td></tr>
                @endforeach
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