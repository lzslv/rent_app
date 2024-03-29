@extends('layouts.admin')
@section('content')
    <h3>Редактировать</h3>

    <form action="{{route('admin.post.update', $user )}}" method="post">
        @csrf
        @method('patch')



        <div class="mb-3">
            <label for="title" class="form-label">Заголовок объявления</label>
            <input type="text" name="title" class="form-control" id="title" value="{{$post->title}}">
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Тип жилья (квартира, дом)</label>
            <input type="text" name="type" class="form-control" id="type" value="{{$post->type}}">
        </div>

        <div class="mb-3">
            <label for="rooms" class="form-label">Количество комнат</label>
            <input type="number" name="rooms" class="form-control" id="rooms" value="{{$post->rooms}}">
        </div>

        <div class="mb-3">
            <label for="size" class="form-label">Квадратура</label>
            <input type="number" name="size" class="form-control" id="size" value="{{$post->size}}">
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Стоимость аренды в месяц</label>
            <input type="number" name="price" class="form-control" id="price" value="{{$post->price}}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Описание</label>
            <textarea type="text" name="description" class="form-control" id="description" >{{$post->description}}</textarea>
        </div>

        <div class="mb-3">
            <label for="picture" class="form-label">Ссылка на изображение</label>
            <input type="text" name="picture" class="form-control" id="picture" value="{{$post->picture}}">
        </div>

        <div class="mb-3">
            <label for="file" class="form-label">Ссылка на PDF-файл</label>
            <input type="text" name="file" class="form-control" id="file" value="{{$post->file}}">
        </div>

        <div class="mb-3">
            <label for="region" class="form-label">Регион</label>
            <input type="text" name="region" class="form-control" id="region" value="{{$post->region}}">
        </div>

        <div class="mb-3">
            <label for="city" class="form-label">Город</label>
            <input type="text" name="city" class="form-control" id="city" value="{{$post->city}}">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Адрес</label>
            <input type="text" name="address" class="form-control" id="address" value="{{$post->address}}">
        </div>

        <div class="mb-3">
            <label for="landlord_email" class="form-label">Электронная почта</label>
            <input type="email" name="landlord_email" class="form-control" id="landlord_email" required value="{{$post->landlord_email}}">
        </div>

        <div class="mb-3">
            <label for="landlord_phone" class="form-label">Телефон</label>
            <input type="tel" name="landlord_phone" class="form-control" id="landlord_phone" required value="{{$post->landlord_phone}}">
        </div>

        <button type="submit" class="btn btn-primary">Обновить</button>
    </form>

@endsection
