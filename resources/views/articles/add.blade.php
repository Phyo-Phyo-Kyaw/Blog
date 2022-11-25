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
                <input type="text" name="title" class="form-control">
            </div>

            <div class="mb-3">
                <label for="body">Body</label>
                <textarea type="text" name="body" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label>Category</label>
                <select class="form-select" name="category_id">
                   @foreach ($categorys as $category )
                        <option value="{{$category->id}}">{{$category->name}}</option>
                   @endforeach

                </select>
            </div>
            <div class="">
                <button class="btn btn-primary">
                    Add Article
                </button>
            </div>
        </form>
    </div>
@endsection
