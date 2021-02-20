@extends('layout')

@section('content')

    <a href="/tag/create" type="button" class="btn btn-primary">Add Tag</a>
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
@endSection