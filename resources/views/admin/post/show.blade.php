@extends('layouts.admin')
@section('content')
    <div class="ml-3 mr-3">
        <div class="row">
            <div class="col-md-11">
                <div class="card">
                    <div style="display: flex; gap: 30px">
                        @foreach ($pictures as $picture)
                            <img src="{{ $picture->data }}" style="width: 300px; height: 250px">
                        @endforeach
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">Тип: {{ $post->type }}</p>
                        <p class="card-text">Комнат: {{ $post->rooms }}. Квадратура: {{ $post->size }}</p>
                        <p class="card-text">{{ $post->description }}</p>
                        <p class="card-text">Цена: {{ $post->price }}</p>
                        <p class="card-text">
                            Адрес: {{ $post->city }}, {{ $post->region }} регион/область, {{ $post->address }}
                        </p>
                        <p class="card-text">Связь: {{ $post->landlord_email }}, +{{ $post->landlord_phone }}</p>
                        <p class="card-text">Оценка: {{ $post->likes }}</p>
                        <div class="inline-buttons">
                            <div>
                                <a class="btn btn-primary" href="{{ route('admin.post.edit', $post) }}">
                                    Редактировать
                                </a>
                            </div>
                            <form action="{{ route('admin.post.destroy', $post) }}" method="post">
                                @csrf
                                @method('delete')
                                <input type="submit" value="Удалить" class="btn btn-danger">
                            </form>

                            <a class="btn btn-dark" href="{{ route('admin.post') }}" role="button">Назад</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .inline-buttons {
            display: flex;
            justify-content: flex-start;
            gap: 30px;
        }
    </style>
@endsection
