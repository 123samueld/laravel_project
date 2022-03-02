@extends('layouts.app')
@section('title', 'Update the post')
@section ('content')
<H1>Edit the post</h1>
<form action="{{ route('posts.update', ['post'=>$post->id]) }}" method="POST">
    @csrf 
    @method('PUT')
    @include('posts.partials.form')
    <div>
        <input class="btn btn-primary btn-block" type="submit" value="Update">
    </div>
</form>
@endsection