@extends('layout')


@section('content')

    <form method="post">
        <div class="mb-3">
            @if(isset($_SESSION['errors']['title']))
                @foreach($_SESSION['errors']['title'] as $error)
                    <div class="alert alert-danger" role="alert">
                        <p>{{$error}}</p>
                    </div>
                @endforeach
            @endif
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title"
                   value=" {{$_SESSION['data']['title'] ?? $post->title }}">
        </div>
        <div class="mb-3">
            @if(isset($_SESSION['errors']['slug']))
                @foreach($_SESSION['errors']['slug'] as $error)
                    <div class="alert alert-danger" role="alert">
                        <p>{{$error}}</p>
                    </div>
                @endforeach
            @endif
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug"
                   value=" {{$_SESSION['data']['slug'] ?? $post->slug}}">
        </div>
        <div class="mb-3">
            @if(isset($_SESSION['errors']['body']))
                @foreach($_SESSION['errors']['body'] as $error)
                    <div class="alert alert-danger" role="alert">
                        <p>{{$error}}</p>
                    </div>
                @endforeach
            @endif

            <label for="body" class="form-label">Body</label>
            <input type="text" class="form-control" id="body" name="body"
                   value=" {{$_SESSION['data']['body'] ?? $post->body}}">
        </div>
        <div class="mb-3">
            @if(isset($_SESSION['errors']['tags']))
                @foreach($_SESSION['errors']['tags'] as $error)
                    <div class="alert alert-danger" role="alert">
                        <p>{{$error}}</p>
                    </div>
        </div>
        @endforeach
        @endif
        @foreach($tags as $tag)
            <div class="form-check">
                <input class="form-check-input" @if(isset($_SESSION['data']) && in_array($tag->id, $_SESSION['data']['tags'])) checked @endif type="checkbox" value="{{$tag->id}}" id="tags"
                       name="tags[]">
                <label class="form-check-label" for="tags">
                    {{$tag->title}}
                    <br>
                </label>
            </div>
        @endforeach

{{--                     <label for="tag" class="form-label">Tag</label>--}}
{{--                    <input type="text" class="form-control" id="tags" name="tag"--}}
{{--                           value=" {{$_SESSION['data']['tag'] ?? $post->tag}}">--}}
{{--                </div>--}}
        <div class="mb-3">
            @if(isset($_SESSION['errors']['category']))
                @foreach($_SESSION['errors']['category'] as $error)
                    <div class="alert alert-danger" role="alert">
                        <p>{{$error}}</p>
                    </div>
                @endforeach
            @endif
        </div>



        {{--            <label for="category" class="form-label">Category</label>--}}
        {{--            <input type="text" class="form-control" id="category" name="category" value=" {{$_SESSION['data']['slug'] ?? $post->category}}">--}}
        {{--        </div>--}}

        <label for="category" class="form-label">Category</label>
        <select id="category" name="category_id" class="form-select" aria-label="Default select example">
            <option selected>Choose category</option>

            @foreach($categories as $category)
                <option @if(isset($_SESSION['data']) && $_SESSION['data']['category_id'] == $category->id) selected @endif value="{{$category->id}}">{{$category->title}}</option>
            @endforeach

        </select>
        <div class="mb-3">
            <input type="submit" class="btn btn-primary mb-3" value="Save"/>
        </div>
    </form>
    @php
        unset($_SESSION['errors']);
        unset($_SESSION['data']);
    @endphp
@endSection