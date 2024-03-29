@extends('layouts.admin')
@section('content')

    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">{{$user->name}}</h5>
            <p class="card-text">Email: {{$user->email}}</p>
            <p class="card-text">Роль: </p>
            <div><a href="{{route('admin.user.edit', $user)}}">Редактировать</a></div>
            <form action="{{route('admin.user.destroy', $user)}}" method="post">
                @csrf
                @method('delete')
                <input type="submit" value="Удалить" class="btn btn-danger">
            </form>

            <a class="btn btn-primary" href="{{route('admin.user')}}" role="button">Назад</a>
        </div>
    </div>
@endsection
