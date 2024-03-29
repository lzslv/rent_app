@extends('layouts.admin')
@section('content')
    <a class="btn btn-primary" href="{{route('admin.post.create')}}" role="button">Добавить объявление</a>

    <div><h4>Весь список объявлений</h4></div>
    @foreach($allPosts as $post)
        <div><a href="{{route('admin.post.show', $post)}}">{{$post->id . ". " . $post->title . " | " . "Тип: " . $post->type . " | " . "Оценка: " . $post->likes }}</a></div>
    @endforeach
@endsection
