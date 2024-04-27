@extends('layouts.main')
@section('content')
    <h3>Редактировать отзыв</h3>

    <form action="{{route('post.review.update', [$post, $review])}}" method="post">
        @csrf
        @method('patch')
        <div class="mb-3">
            <label for="text" class="form-label">Текст</label>
            <input type="text" name="text" class="form-control" id="text" value="{{$review->text}}">
        </div>

        <div class="mb-3">
            <label for="rating" class="form-label">Оценка (от 1 до 5)</label>
            <input type="number" class="form-control" id="rating" name="rating" min="1" max="5" required value="{{$review->rating}}">
        </div>
        <button type="submit" class="btn btn-primary">Обновить отзыв</button>
    </form>

@endsection
