@extends('layouts.main')
@section('content')
        <div><h4>Ваши объявления:</h4></div>
        @if ($posts->isEmpty())
            <div>
                <h3>Вы не выложили ни одного объявления</h3>
            </div>
        @endif
    @foreach($posts as $post)
        <div><a href="{{route('post.show', $post)}}">{{$post->id . ". " . $post->title . " | " . "Тип: " . $post->type . " | " . "Оценка: " . $post->likes }}</a></div>
    @endforeach
@endsection
