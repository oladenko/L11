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
@endSection