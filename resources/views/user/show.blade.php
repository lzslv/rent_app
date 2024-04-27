@extends('layouts.main')
@section('content')
    <h1>{{$user->name}}</h1>
        <div><h4>Объявления пользователя</h4></div>
        @if ($posts->isEmpty())
            <div>
                <h3>Пользователь не выложил ни одного объявления</h3>
            </div>
        @endif
    @foreach($posts as $post)
        <div><a href="{{route('post.show', $post)}}">{{$post->id . ". " . $post->title . " | " . "Тип: " . $post->type . " | " . "Оценка: " . $post->likes }}</a></div>
    @endforeach
@endsection
