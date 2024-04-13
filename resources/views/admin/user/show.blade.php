@extends('layouts.admin')
@section('content')
    <div class="ml-3 mr-3">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{$user->name}}</h5>
                        <p class="card-text">Email: {{$user->email}}</p>
                        <p class="card-text">Роль: {{$roles[$user->role]}}</p>
                        <div class="inline-buttons">
                            <div>
                                <a class="btn btn-primary" href="{{route('admin.user.edit', $user)}}">
                                    Редактировать
                                </a>
                            </div>
                            <form action="{{route('admin.user.destroy', $user)}}" method="post">
                                @csrf
                                @method('delete')
                                <input type="submit" value="Удалить" class="btn btn-danger">
                            </form>

                            <a class="btn btn-dark" href="{{route('admin.user')}}" role="button">Назад</a>
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
