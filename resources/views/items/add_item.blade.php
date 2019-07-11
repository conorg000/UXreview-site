@extends('layouts.master')

@section('title')
    Add new item
@endsection

{{-- Form for adding a new item. 
    Asks for name, designer, link (URL) and a summary.
    Nothing can be blank/null. --}}

@section('content')  
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h2>Add a new item</h1>
            <h4>Share a new UX with the world.</h4>
            <form method="post" action="/add_item_action">
                {{-- CSRF token. --}}
                {{csrf_field()}}
                <br><label for="name">Product Name</label>
                <input type="name" class="form-control" id="exampleInputEmail1" placeholder="Name" name="name">
                <br><label for="designer">Designer</label>
                <input type="designer" class="form-control" id="exampleInputEmail1" placeholder="Designer" name="designer">
                <br><label for="link">Link to UX</label>
                <input type="link" class="form-control" id="exampleInputEmail1" placeholder="URL" name="link">
                <br><label>Summary of site/app</label>
                <textarea class="form-control" rows="3" placeholder="Write away!" name="summary"></textarea><br>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
@endsection