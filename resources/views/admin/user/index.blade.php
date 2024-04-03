@extends('layouts.admin')
@section('content')
    <a class="btn btn-primary" href="{{route('admin.user.create')}}" role="button">Добавить пользователя</a>

    <div><h4>Весь список пользователей</h4></div>

    @foreach($users as $user)
        <div>
            <a href="{{route('admin.user.show', $user)}}">{{$user->id . ". " . $user->name . " | " . "Почта: " . $user->email . " | " . "Роль: " . $roles[$user->role]}}</a>
        </div>
    @endforeach
@endsection
