@extends('layouts.master')
@section('title')
    Cool quotes
@endsection
@section('styles')
    <link rel="stylesheet" href="https://maxcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
@endsection

@section('content')
    @if(!empty(Request::segment(1)))
        <section class="filter-bar">
            Filter is set. <a href="{{route('index')}}">Show all quotes</a>
        </section>
    @endif
    @if(count($errors)>0)
        <section class="info-box fail">
                @foreach($errors->all() as $error)
                    {{$error}}
                @endforeach
        </section>
    @endif
    @if(Session::has('success'))
        <section class="info-box success">
            {{Session::get('success')}}
        </section>
    @endif
    <section class="quotes">
        <h1>Latest Quotes</h1>
        @for($i=0; $i<count($quotes); $i++)
            <div class="quote{{($i % 3) === 0 ? ' first-in-line' : (($i+1) % 3 === 0 ? ' last-in-line' : '')}}">
                <div class="delete">
                    <a href="{{route('delete', ['quote_id'=> $quotes[$i]->id])}}">x</a>
                </div>
                {{$quotes[$i]->quote}}
                <div class="info">
                    Created by <a href="{{route('index', ['author'=>$quotes[$i]->author->name])}}">{{$quotes[$i]->author->name}}</a> on {{$quotes[$i]->created_at}}
                </div>
            </div>        
        @endfor
          <div class="pagination">
            @if($quotes->currentPage() !== 1)
                <a href="{{$quotes->previousPageUrl()}}">Prev <<</a>
            @endif
            @if($quotes->currentPage() !== $quotes->lastPage() && $quotes->hasPages())
                <a href="{{$quotes->nextPageUrl()}}">Next >></a>
            @endif
          </div>
    </section>
    <section class="edit-quote">
        <h1>Add a Quote</h1>
        <form method="post" action="{{route('create')}}">
            <div class="input-group">
                <label for="author">Name</label>
                <input type="text" name="author" id="author">
                <label for="email">E-mail</label>
                <input type="text" name="email" id="email">
                <label for="quote">Quote</label>
                <input type="textarea" name="quote" id="quote" rows="5"></textarea>
            </div>
            <input type="submit" value="Submit" class="btn">
            <input type="hidden" name="_token" value="{{ Session::token() }}">
        </form>
    </section>
@endsection