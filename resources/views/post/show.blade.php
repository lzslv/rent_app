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
                        <div class="text-center">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $averageRating)
                                    ★
                                @else
                                    ☆
                                @endif
                            @endfor
                        </div>
                        <p class="text-center">Тип: {{ $post->type }}</p>
                        <p class="text-center">Комнат: {{ $post->rooms }}. Квадратура: {{ $post->size }}</p>
                        <p>{{ $post->description }}</p>
                        <p>Цена: {{ $post->price }}</p>
                        <p>Адрес: {{ $post->city }}, {{ $post->region }} регион/область, {{ $post->address }}</p>
                        <p>Связь: {{ $post->landlord_email }}, +{{ $post->landlord_phone }}</p>
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

                @if(auth()->check() && $post->user_id !== auth()->id())
                    <div class="container-fluid">
                        <div class="row justify-content-center mt-5">
                            <!-- Кнопка для отображения формы -->
                            <button id="showFormBtn" class="btn btn-primary">Записаться на просмотр</button>

                            <!-- Форма записи на просмотр -->
                            <form id="appointmentForm" style="display: none;" method="POST" action="{{route('post.appointment.store',  ['post' => $post->id])}}">
                                @csrf
                                <div class="form-group">
                                    <label for="date">Дата и время:</label>
                                    <input type="datetime-local" id="date" name="date" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="note">Примечание:</label>
                                    <textarea id="note" name="note" class="form-control"></textarea>
                                </div>

                                <button type="submit" class="btn btn-success">Отправить</button>
                            </form>
                        </div>
                    </div>

                    <!-- Скрипт для отображения/скрытия формы и отправки данных на сервер -->
                    <script>
                        document.getElementById('showFormBtn').addEventListener('click', function () {
                            document.getElementById('appointmentForm').style.display = 'block';
                        });
                    </script>
                @endif

                <div class="container mt-5 p-3 card">
                    <h3>Отзывы</h3>
                    @if(auth()->check() && $post->user_id !== auth()->id())
                        <h5>Напишите отзыв:</h5>
                        <form action="{{ route('post.review.store', ['post' => $post->id]) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="text" class="form-label">Текст отзыва</label>
                                <textarea class="form-control" id="text" name="text" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="rating" class="form-label">Оценка (от 1 до 5)</label>
                                <input type="number" class="form-control" id="rating" name="rating" min="1" max="5"
                                       required>
                            </div>
                            <button type="submit" class="btn btn-primary">Добавить отзыв</button>
                        </form>
                    @endif
                    @foreach($reviews as $review)
                        <div class="card mb-3">
                            <div class="card-body d-flex justify-content-between align-items-start">
                                <div>
                                    <a class="mb-0" href="{{ route('user.show', $review->user) }}"
                                       class="btn btn-primary mr-2">{{ $review->user->name }}</a>
                                    <div class="stars">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $review->rating)
                                                ★ <!-- Символ звезды -->
                                            @else
                                                ☆ <!-- Символ пустой звезды -->
                                            @endif
                                        @endfor
                                    </div>
                                    <blockquote class="blockquote mt-3">
                                        <p class="mb-0">{{ $review->text }}</p>
                                    </blockquote>
                                </div>
                                @if(auth()->check() && $review->user_id === auth()->id())
                                    <div class="d-flex">
                                        <a href="{{ route('post.review.edit', [$post, $review]) }}"
                                           class="btn btn-primary mr-2">Редактировать</a>
                                        <form action="{{ route('post.review.destroy', [$post, $review]) }}"
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Удалить</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
    <script>
        let now = new Date();
        let year = now.getFullYear();
        let month = now.getMonth() + 1 < 10 ? '0' + (now.getMonth() + 1) : now.getMonth() + 1;
        let day = now.getDate() < 10 ? '0' + now.getDate() : now.getDate();
        let hours = now.getHours() < 10 ? '0' + now.getHours() : now.getHours();
        let minutes = now.getMinutes() < 10 ? '0' + now.getMinutes() : now.getMinutes();

        let minDateTime = year + '-' + month + '-' + day + 'T' + hours + ':' + minutes;

        document.getElementById('date').min = minDateTime;
    </script>
@endsection
