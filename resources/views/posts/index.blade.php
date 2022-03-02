@extends('layouts.app')

@section('title', 'Blog Posts')


@section('content')
<h1>Blog Posts</h1>
@forelse($posts as $key => $post)
        @include('posts.partials.post')    
        @empty
        <div>No posts found!</div>    
    @endforelse
@endsection