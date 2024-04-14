@extends('layouts.main')
@section('content')
        <div><h4>Весь список объявлений</h4></div>
    @foreach($allPosts as $post)
        <div><a href="{{route('post.show', $post)}}">{{$post->id . ". " . $post->title . " | " . "Тип: " . $post->type . " | " . "Оценка: " . $post->likes }}</a></div>
    @endforeach
@endsection
