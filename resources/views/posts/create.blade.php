@extends('layouts.app')

@section('title', 'Create the post')

@section('content')
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        @include('posts.partials.form')
        <div class="mt-3"><input type="submit" value="Create Post" class="btn btn-primary form-control" /></div>
    </form>
@endsection
