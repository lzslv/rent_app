@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="content-box p-4 d-flex align-items-center">
                    <!-- Изображение слева -->
                    <div class="me-3" style="max-width: 50%;">
                        <img src="{{ $post->picture }}" class="img-fluid mb-3" alt="{{ $post->title }}">
                    </div>

                    <!-- Информация и кнопки справа -->
                    <div>
                        <h2 class="text-center">{{ $post->title }}</h2>
                        <p class="text-center">Тип: {{ $post->type }}</p>
                        <p class="text-center">Комнат: {{ $post->rooms }}. Квадратура: {{ $post->size }}</p>
                        <p>{{ $post->description }}</p>
                        <p>Цена: {{ $post->price }}</p>
                        <p>Адрес: {{ $post->city }}, {{ $post->region }} регион/область, {{ $post->address }}</p>
                        <p>Связь: {{ $post->landlord_email }}, +{{ $post->landlord_phone }}</p>
                        <p>Оценка: {{ $post->likes }}</p>
                        <div class="text-center">

                            @if($post->user_id === auth()->user()->id)
                                <a href="{{ route('post.edit', $post) }}" class="btn btn-primary">Редактировать</a>
                            @endif

                            @if($post->user_id === auth()->user()->id)
                                <form action="{{ route('post.destroy', $post) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Удалить</button>
                                </form>
                            @endif

                            <div style="display: flex; gap: 20px;">
                                <form action="{{ route('post.file.download', $fileName) }}" method="post">
                                    @csrf

                                    <input type="submit" value="Скачать документ" class="btn btn-dark">
                                </form>

                                <a href="{{ route('post.index') }}" class="btn btn-secondary">Назад</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
