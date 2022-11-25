@extends("layouts.app");
@section("content")
    <div class="container">
        @if($errors->any())
            <div class="alert alert-warning">
                @foreach ($errors->all() as $error)
                    {{$error}}
                @endforeach
            </div>
        @endif
        <form method="post">
            @csrf
            <div class="mb-3">
                <label for="title">title</label>
                <input type="text" name="title" class="form-control" value="{{$article->title}}">
            </div>

            <div class="mb-3">
                <label for="body">Body</label>
                <textarea type="text" name="body" class="form-control">{{$article->body}}</textarea>
            </div>

            <div class="mb-3">
                <label>Category</label>
                <select class="form-select" name="category_id">
                   @foreach ($categories as $category )
                        <option value="{{$category->id}}"
                            @if($category->id === $article->category_id)
                                selected
                            @endif>
                            {{$category->name}}
                        </option>
                   @endforeach

                </select>
            </div>
            <div class="">
                <button class="btn btn-primary">
                    Update Article
                </button>
            </div>
        </form>
    </div>
@endsection
