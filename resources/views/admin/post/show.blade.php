@extends('layouts.admin')
@section('content')

    <div class="card" style="width: 18rem;">
        <img src="{{$post->picture}}" class="card-img-top" alt="{{$post->picture}}">
        <div class="card-body">
            <h5 class="card-title">{{$post->title}}</h5>
            <p class="card-text">Тип: {{$post->type}}</p>
            <p class="card-text">Комнат: {{$post->rooms}}. Квадратура: {{$post->size}}</p>
            <p class="card-text">{{$post->description}}</p>
            <p class="card-text">Цена: {{$post->price}}</p>
            <p class="card-text">Адрес: {{$post->city}}, {{$post->region}} регион/область, {{$post->address}}</p>
            <p class="card-text">Связь: {{$post->landlord_email}}, +{{$post->landlord_phone}}</p>
            <p class="card-text">Оценка: {{$post->likes}}</p>
            <div><a href="{{route('admin.post.edit', $post)}}">Редактировать</a></div>
            <form action="{{route('admin.post.destroy', $post)}}" method="post">
                @csrf
                @method('delete')
                <input type="submit" value="Удалить" class="btn btn-danger">
            </form>

            <a class="btn btn-primary" href="{{route('admin.post')}}" role="button">Назад</a>
        </div>
    </div>
@endsection
