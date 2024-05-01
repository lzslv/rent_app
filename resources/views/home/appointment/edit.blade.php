@extends('layouts.main')
@section('content')
    <h3>Редактировать отзыв</h3>

    <form action="{{route('home.appointment.update', [$appointment])}}" method="post">
        @csrf
        @method('patch')
        <div class="form-group">
            <label for="date">Дата и время:</label>
            <input type="datetime-local" id="date" name="date" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="note">Примечание:</label>
            <textarea id="note" name="note" class="form-control"></textarea>
        </div>
        <input type="hidden" name="approved" value='0'>

        <button type="submit" class="btn btn-primary">Обновить запись</button>
    </form>

@endsection
