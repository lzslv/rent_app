@extends('layouts.main')
@section('content')
    <div class="mt-5">
        <h3 style="text-align: center">Выложить объявление</h3>

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-7">
                <form action="{{route('post.store')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Заголовок объявления</label>
                        <input type="text" name="title" class="form-control" id="title">
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Тип жилья (квартира, дом)</label>
                        <input type="text" name="type" class="form-control" id="type">
                    </div>

                    <div class="mb-3">
                        <label for="rooms" class="form-label">Количество комнат</label>
                        <input type="number" name="rooms" class="form-control" id="rooms" min="1">
                    </div>

                    <div class="mb-3">
                        <label for="size" class="form-label">Квадратура</label>
                        <input type="number" name="size" class="form-control" id="size">
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Стоимость аренды в месяц</label>
                        <input type="number" name="price" class="form-control" id="price">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Описание</label>
                        <textarea type="text" name="description" class="form-control" id="description"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="picture" class="form-label">Ссылка на изображение</label>
                        <input type="text" name="picture" class="form-control" id="picture">
                    </div>

                    <div class="mb-3">
                        <label for="file" class="form-label">Ссылка на PDF-файл</label>
                        <input type="text" name="file" class="form-control" id="file">
                    </div>

                    <div class="mb-3">
                        <label for="region" class="form-label">Регион</label>
                        <input type="text" name="region" class="form-control" id="region">
                    </div>

                    <div class="mb-3">
                        <label for="city" class="form-label">Город</label>
                        <input type="text" name="city" class="form-control" id="city">
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Адрес</label>
                        <input type="text" name="address" class="form-control" id="address">
                    </div>

                    <div class="mb-3">
                        <label for="landlord_email" class="form-label">Электронная почта</label>
                        <input type="text" name="landlord_email" class="form-control" id="landlord_email" required>
                    </div>

                    <div class="mb-3">
                        <label for="landlord_phone" class="form-label">Телефон</label>
                        <input type="text" name="landlord_phone" class="form-control" id="landlord_phone" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Выложить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
