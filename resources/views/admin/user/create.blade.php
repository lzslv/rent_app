@extends('layouts.admin')
@section('content')
    <h3>Добавить пользователя</h3>

    <form action="{{route('admin.user.store')}}" method="post">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Имя</label>
            <input type="text" name="name" class="form-control" id="name">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" name="password" class="form-control" id="password">
        </div>

        <button type="submit" class="btn btn-primary">Добавить</button>

    </form>

@endsection
