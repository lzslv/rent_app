@extends('layouts.main')
@section('content')
    <div class="mt-4 mb-4 text-center"><h4>Весь список объявлений</h4></div>
    <div class="container">
        <div class="row">
            @foreach($allPosts as $post)
                @php
                    $mainPicture = $post->pictures()->where('main_picture', true)->first();
                @endphp
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                @if($mainPicture)
                                    <img class="img-fluid"
                                         src="{{ url($mainPicture->data) }}"
                                         alt="{{ $post->title }}"
                                         style="height: 40vh; object-fit: cover;">
                                @else
                                    <img class="img-fluid"
                                         src="{{ asset('path/to/alternative-image.jpg') }}"
                                         alt="{{ $post->title }}"
                                         style="height: 40vh; object-fit: cover;">
                                @endif
                            </div>

                            <h3 class="profile-username text-center">{{ $post->title }}</h3>
                            <p class="text-muted text-center">{{ $post->description }}</p>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Тип</b> <a class="float-right">{{ $post->type }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Количество комнат</b> <a class="float-right">{{ $post->rooms }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Стоимость (USD)</b> <a class="float-right">{{ $post->price }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Квадратура (м²)</b> <a class="float-right">{{ $post->size }}</a>
                                </li>
                            </ul>
                            <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary btn-block">
                                <b>Подробнее</b>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
