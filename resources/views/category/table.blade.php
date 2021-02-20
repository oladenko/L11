@extends('layout')

@section('content')

    <a href="/category/create" type="button" class="btn btn-primary">Add category</a>
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
@endSection