@extends('layouts.master')
@section('title')
    Cool quotes
@endsection
@section('styles')
    <link rel="stylesheet" href="https://maxcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
@endsection
@section('content')
    <section class="quotes">
        <h1>Latest Quotes</h1>
        <div class="quote">
            <div class="delete">
                <a href="#">x</a>
            </div>
            This is the quote
            <div class="info">
                Created by <a href="#">jpruf</a> on TIMESTAMP
            </div>
        </div>
        Pagination
    </section>
    <section class="edit-quote">
        <h1>Add a Quote</h1>
        <form method="post" action="{{route('create')}}">
            <div class="input-group">
                <label for="author">Name</label>
                <input type="text" name="author" id="author">
                <label for="quote">Quote</label>
                <input type="textarea" name="quote" id="quote" rows="5"></textarea>
            </div>
            <input type="submit" value="Submit" class="btn">
            <input type="hidden" name="_token" value="{{ Session::token() }}">
        </form>
    </section>
@endsection