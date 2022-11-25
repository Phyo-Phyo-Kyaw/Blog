@extends("layouts.app")

@section('content')
    <div class="container">
        <div class="card mb-3 border-1 border-primary">
            <div class="card-body">
                <h3>{{$article->title}}</h3>
                <small class="text-muted">{{$article->created_at->diffForHumans()}}</small>
                <span class="text-info">Category : <b>{{$article->category->name}}</b></span>
                <div class="">{{$article->body}}</div>
            </div>
            <div class="card-footer">
                @auth
                    @can('article-delete' , $article)
                        <a href="{{url("/articles/edit/$article->id")}}" class="btn btn-secondary">Edit</a>
                        <a href="{{url("/articles/delete/$article->id")}}" class="btn btn-warning">Delete</a>
                    @endcan
                @endauth
            </div>
        </div>
        @if(session("info"))
            <div class="alert alert-danger">
                {{session("info")}}
            </div>
        @endif
        <h4 class="ms-1 h3 mt-4">Comments({{count($article->comments)}})</h4>
        <ul class="list-group">
            @foreach ($article->comments as $comment)
                <li class="list-group-item mb-2">
                    @auth
                        @can('comment-delete' , $comment)
                            <a href="{{url("/comments/delete/$comment->id")}}" class="btn-close float-end"></a>
                        @endcan
                    @endauth
                    <div class="">
                        <small>
                            <b class="text-success">{{$comment->user->name}}</b>
                            {{$comment->created_at->diffForHumans()}}
                        </small>
                    </div>
                    {{$comment->content}}
                </li>
            @endforeach
        </ul>
        @if($errors->any())
            <div class="alert alert-warning">
                @foreach ($errors->all() as $error)
                    {{$error}}
                @endforeach
            </div>
        @endif
        @auth
            <form action="{{url("/comments/add")}}" method="POST">
                @csrf
                <input type="hidden" value="{{$article->id}}" name="article_id">
                <input type="hidden" value="{{$article->user->id}}" name="user_id">
                <textarea name="content" id="" class="form-control my-2" placeholder="New Comment"></textarea>
                <button class="btn btn-secondary">Add Comment</button>
            </form>
        @endauth
    </div>
@endsection
