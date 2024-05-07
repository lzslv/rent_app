@extends('layouts.admin')
@section('content')
    <div class="ml-3 mr-3">

        @foreach($recommendedPosts as $recommendedPost)
            <div class="row mt-3">
                <div class="col-2"></div>
                <div class="col-8">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                     src="{{ url($recommendedPost->picture) }}"
                                     alt="Фото">
                            </div>

                            <h3 class="profile-username text-center">{{ $recommendedPost->title }}</h3>

                            <p class="text-muted text-center">{{ $recommendedPost->description }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Тип</b> <a class="float-right">{{ $recommendedPost->type }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Количество комнат</b> <a class="float-right">{{ $recommendedPost->rooms }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Стоимость (USD)</b> <a class="float-right">{{ $recommendedPost->price }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Квадратура (м²)</b> <a class="float-right">{{ $recommendedPost->size }}</a>
                                </li>
                            </ul>

                            <a href="{{ route('post.show', $recommendedPost->id) }}" class="btn btn-primary btn-block">
                                <b>Подробнее</b>
                            </a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection
