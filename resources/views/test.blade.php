@extends('layouts.app')

@section('title', 'Blog Post Test')


@section('content')
<h1>Blog Post Test</h1>
@forelse($posts as $key => $post)
        <h4>{{ $post->title }}</h4>  
        @empty
        <div>No posts found!</div>    
    @endforelse
@endsection