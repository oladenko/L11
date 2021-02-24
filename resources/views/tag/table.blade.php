@extends('layout')

@section('content')

    <a href="/tag/create" type="button" class="btn btn-primary">Add Tag</a>
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
            <th scope="col">Created at</th>
            <th scope="col">Updated at</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($tags as $tag)
            <tr>
                <th scope="row">{{$tag->id}}</th>
                <td>{{$tag->title}}</td>
                <td>{{$tag->slug}}</td>
                <td>{{$tag->created_at}}</td>
                <td>{{$tag->updated_at}}</td>
                <td><a href="/tag/{{$tag->id}}/edit" type="button" class="btn btn-primary">Edit</a>
                </td> <td><a href="/tag/{{$tag->id}}/destroy" type="button" class="btn btn-primary">Delete</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">No Tags</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            @if($tags->currentPage()>=4)
                <li class="page-item"><a class="page-link" href="/post/list/{{$tags->onFirstPage()}}">1</a></li>
            @endif

            @if($tags->currentPage()!=1)
                <li class="page-item"><a class="page-link" href="/post/list/{{$tags->previousPageUrl()}}">Previous</a></li>
            @endif
            {{--            @if($tags->currentPage() == 1 )--}}

            @foreach($tags->getUrlRange($tags->currentPage()-1, $tags->currentPage()+1) as $num=>$link)
                <li class="page-item"><a class="page-link" href="/post/list/{{$link}}">{{$num}}</a></li>

            @endforeach

            @if($tags->currentPage() != $tags->lastPage())
                <li class="page-item"><a class="page-link" href="/post/list/{{$tags->nextPageUrl()}}">Next</a></li>
            @endif
            @if($tags->currentPage() == $tags->lastPage() -3)
                {{--                @foreach($tags->lastPage() as $tags->lastPage() =>$link)--}}
                <li class="page-item"><a class="page-link" href="/post/list/{{$tags->lastPage()}}">Last</a></li>
                {{--                    @endforeach--}}
            @endif
        </ul>
    </nav>
@endSection