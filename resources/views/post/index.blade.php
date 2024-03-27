@extends('layouts.main')
@section('content')

    <a class="btn btn-primary" href="{{route('post.create')}}" role="button">Сдать квартиру!</a>

    <div><h4>Весь список (?ваших) объявлений</h4></div>
    @foreach($allPosts as $post)
        <div><a href="{{route('post.show', $post)}}">{{$post->id . ". " . $post->title . " | " . "Тип: " . $post->type . " | " . "Оценка: " . $post->likes }}</a></div>
    @endforeach
@endsection
