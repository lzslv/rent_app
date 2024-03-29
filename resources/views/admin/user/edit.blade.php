@extends('layouts.admin')
@section('content')
    <h3>Редактировать</h3>

    <form action="{{route('admin.user.update', $user)}}" method="post">
        @csrf
        @method('patch')
        <div class="mb-3">
            <label for="name" class="form-label">Имя</label>
            <input type="text" name="name" class="form-control" id="name" value="{{$user->name}}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="{{$user->email}}">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" name="password" class="form-control" id="password" value="{{$user->password}}">
        </div>

        <button type="submit" class="btn btn-primary">Обновить</button>
    </form>

@endsection
