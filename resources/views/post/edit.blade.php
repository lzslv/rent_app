@extends('layouts.main')
@section('content')
    <div class="mt-5">
        <h3 style="text-align: center">Редактировать</h3>

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-7">
                <form action="{{route('post.update', $post)}}" method="post" enctype="multipart/form-data">
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
                        <input type="number" name="rooms" class="form-control" id="rooms"
                               min="1" value="{{$post->rooms}}">
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
                        <label for="picture1" class="form-label">Фото 1</label>
                        <input type="file" name="picture1" class="form-control" id="file">
                    </div>

                    <div class="mb-3">
                        <label for="picture2" class="form-label">Фото 2</label>
                        <input type="file" name="picture2" class="form-control" id="file">
                    </div>

                    <div class="mb-3">
                        <label for="picture3" class="form-label">Фото 3</label>
                        <input type="file" name="picture3" class="form-control" id="file">
                    </div>

                    <div class="mb-3">
                        <label for="file" class="form-label">PDF-документ</label>
                        <input type="file" name="file" class="form-control" id="file">
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
            </div>
    </div>
@endsection
