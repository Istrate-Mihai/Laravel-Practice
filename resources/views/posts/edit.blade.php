@extends('layouts.app')

@section('title', 'Update the post')

@section('content')
    <form action="{{ route('posts.update', ['post' => $post]) }}" method="POST">
        @csrf
        @method('PUT')
        @include('posts.partials.form')
        <div class="mt-3"><input type="submit" value="Update Post" class="btn btn-primary form-control" /></div>
    </form>
@endsection
