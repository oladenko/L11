@extends('layout')

@section('content')

    <a href="/category/create" type="button" class="btn btn-primary">Add category</a>
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
        @forelse($categories as $category)
            <tr>
                <th scope="row">{{$category->id}}</th>
                <td>{{$category->title}}</td>
                <td>{{$category->slug}}</td>
                <td>{{$category->created_at}}</td>
                <td>{{$category->updated_at}}</td>
                <td><a href="/category/{{$category->id}}/edit" type="button" class="btn btn-primary">Edit</a>
                </td> <td><a href="/category/{{$category->id}}/destroy" type="button" class="btn btn-primary">Delete</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">No categories</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            @if($categories->currentPage()>=4)
                <li class="page-item"><a class="page-link" href="/post/list/{{$categories->onFirstPage()}}">1</a></li>
            @endif

            @if($categories->currentPage()!=1)
                <li class="page-item"><a class="page-link" href="/post/list/{{$categories->previousPageUrl()}}">Previous</a></li>
            @endif
            {{--            @if($categories->currentPage() == 1 )--}}
                @if($categories->currentPage() >1)

            @foreach($categories->getUrlRange($categories->currentPage()-1, $categories->currentPage()+1) as $num=>$link)
                <li class="page-item"><a class="page-link" href="/post/list/{{$link}}">{{$num}}</a></li>

            @endforeach
                @endif  @if($categories->currentPage() == 1)

            @foreach($categories->getUrlRange($categories->currentPage(), $categories->currentPage()+2) as $num=>$link)
                <li class="page-item"><a class="page-link" href="/post/list/{{$link}}">{{$num}}</a></li>

            @endforeach
                @endif

            @if($categories->currentPage() != $categories->lastPage())
                <li class="page-item"><a class="page-link" href="/post/list/{{$categories->nextPageUrl()}}">Next</a></li>
            @endif
            @if($categories->currentPage() == $categories->lastPage() -3)
                {{--                @foreach($categories->lastPage() as $categories->lastPage() =>$link)--}}
                <li class="page-item"><a class="page-link" href="/post/list/{{$categories->lastPage()}}">Last</a></li>
                {{--                    @endforeach--}}
            @endif
        </ul>
    </nav>
@endSection