@extends('layouts.app')

@section('content')
    <div class="container">

        @if (session("info"))
            <div class="alert alert-info">
                {{session("info")}}
            </div>
        @endif
        {{$articles->links()}}
        @foreach ($articles  as $article)
            <div class="card mb-3">
                <div class="card-body">
                    <h3 class="card-title">{{$article->title}}</h3>
                    <b class="text-success">{{$article->user->name}}</b>
                    <small class="text-muted">{{$article->created_at->diffForHumans()}}</small>
                    <span class="text-info">Category : <b>{{$article->category->name}}</b></span>
                    {{count($article->comments)}} comments
                    <div class="">{{$article->body}}</div>
                </div>
                <div class="card-footer">
                    <a href="{{url("/articles/detail/$article->id")}}" class="card-link">View Details...</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
