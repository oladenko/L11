@extends('layout')


@section('content')

    <form action="../../../public/tagformEdit.php" method="post">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$tag->title}}">
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug" value="{{$tag->slug}}">
        </div>
        <input type="hidden" name="id" value="{{$tag->id}}">
        <div class="mb-3">
            <input type="submit" class="btn btn-primary mb-3" value="Save"/>
        </div>
    </form>
@endSection