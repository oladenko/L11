@extends('layout')

@section('content')

    <a href="/post/create" type="button" class="btn btn-primary">Add Post</a>
    @if(isset($_SESSION['message']))
        <div class="alert alert-{{$_SESSION['message']['status']}}" role="alert">
            {{$_SESSION['message']['text']}}
        </div>
        @unset($_SESSION['message'])
    @endif
    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Title</th>
            <th scope="col">Slug</th>
            <th scope="col">Body</th>
            <th scope="col">Tags</th>
            <th scope="col">Category</th>
            <th scope="col">Created at</th>
            <th scope="col">Updated at</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($posts as $post)
            <tr>
                <th scope="row">{{$post->id}}</th>
                <td>{{$post->title}}</td>
                <td>{{$post->slug}}</td>
                <td>{{$post->body}}</td>
                <td>{{$post->tags->pluck('title')->join(',')}}</td>
                <td>{{$post->category->title}}</td>
                <td>{{$post->created_at}}</td>
                <td>{{$post->updated_at}}</td>
                <td><a href="/post/{{$post->id}}/edit" type="button" class="btn btn-primary">Edit</a>
                </td> <td><a href="/post/{{$post->id}}/destroy" type="button" class="btn btn-primary">Delete</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9">No Posts</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            @if($posts->currentPage()>=4)
                <li class="page-item"><a class="page-link" href="/post/list/{{$posts->onFirstPage()}}">1</a></li>
                @endif

            @if($posts->currentPage()!=1)
            <li class="page-item"><a class="page-link" href="/post/list/{{$posts->previousPageUrl()}}"> Previous</a></li>
            @endif

            @foreach($posts->getUrlRange($posts->currentPage()-1,$posts->currentPage()+1 ) as $num=>$link)
            <li class="page-item"><a class="page-link" href="/post/list/{{$link}}">{{$num}}</a></li>
                @endforeach


                @if($posts->currentPage() != $posts->lastPage())
            <li class="page-item"><a class="page-link" href="/post/list/{{$posts->nextPageUrl()}}">Next</a></li>
                    @endif
            @if($posts->currentPage() < $posts->lastPage()-2)

                    <li class="page-item"><a class="page-link" href="/post/list/?page={{$posts->lastPage()}}">Last</a></li>

                @endif
        </ul>
    </nav>
@endSection