@extends('layout')

@section('title', 'Homepage')

@section('content')
    <h1>Homepage</h1>

    @forelse($categories as $category)
        @if ($loop->first)
            <hr>
        @endif

        <p>{{ $category->title }}</p>

        @if ($loop->last)
            <hr>
        @endif
    @empty
        <p>no categories</p>
    @endforelse

    @push('scripts')
        <script src="/example.js"></script>
    @endpush
@endsection