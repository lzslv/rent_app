@extends('layouts.main')
@section('content')
     <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Ваши объявления</h5>
                    @if ($posts->isEmpty())
                        <p>Вы не выложили ни одного объявления<p>
                    @endif
                    @foreach($posts as $post)
                        <div>
                            <a href="{{route('post.show', $post)}}">{{$post->id . ". " . $post->title . " | " . "Тип: " . $post->type . " | " . "Оценка: " . $post->likes }}</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Вы запросили встречи</h5>
                    <div>
                        @if ($appointments->isEmpty())
                            <p>Вы не назначили ни одной встречи<p>
                        @endif

                        @foreach($appointments as $appointment)
                            <div class="card mb-3">
                                @if($appointment->approved === 1)
                                    <div class="bg-success text-white">
                                        {{ "Вам подтвердили встречу " . $appointment->date . " для жилья " }}
                                        <a class="text-light" href="{{ route('post.show', [$post = $allPosts[$appointment->post_id]]) }}"> {{ $allPosts[$appointment->post_id]->title }}</a>
                                        <p class="card-text">Уточнение: {{$appointment->note}}</p>
                                    </div>
                                @else
                                    <div>
                                        {{ "Вы запросили встречу " . $appointment->date . " для жилья " }}
                                        <a href="{{ route('post.show', [$post = $allPosts[$appointment->post_id]]) }}"> {{ $allPosts[$appointment->post_id]->title }}</a>
                                        <p class="card-text">Уточнение: {{$appointment->note}}</p>
                                    </div>
                                @endif
                                <a href="{{ route('home.appointment.edit', $appointment) }}" class="btn-primary">Редактировать</a>
                                <form action="{{ route('home.appointment.destroy', $appointment) }}" method="POST"
                                      class="btn-danger">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Удалить</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">У вас запросили встречу</h5>
                        @foreach($notApprovedAppointments as $appointment)
                            <div class="card mb-3">
                                <div class="card-body">
                                    @if($appointment->approved === 1)
                                        <div class="bg-success text-white">
                                            {{ "Вы подтвердили встречу " . $appointment->date . " c " }}
                                            <a class="text-light" href="{{ route('user.show', $appointment->user->id) }}">{{ $appointment->user->name }}</a>
                                            {{ " для жилья " }}
                                            <a class="text-light" href="{{ route('post.show', $post = $allPosts[$appointment->post_id]) }}">{{ $allPosts[$appointment->post_id]->title }}</a>
                                            <p class="card-text">Уточнение: {{ $appointment->note }}</p>
                                        </div>
                                        <form action="{{ route('home.appointment.destroy', $appointment) }}" method="POST"
                                              class="btn-danger">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Удалить</button>
                                        </form>
                                    @else
                                        <div>
                                            {{ "У вас запрос на встречу " . $appointment->date . " c " }}
                                            <a  href="{{ route('user.show', $appointment->user->id) }}">{{ $appointment->user->name }}</a>
                                            {{ " для жилья " }}
                                            <a href="{{ route('post.show', $post = $allPosts[$appointment->post_id]) }}">{{ $allPosts[$appointment->post_id]->title }}</a>
                                            <p class="card-text">Уточнение: {{ $appointment->note }}</p>
                                        </div>
                                    @endif

                                    @if($appointment->approved === 0)
                                        <form action="{{ route('home.appointment.update', $appointment) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="date" value='{{$appointment->date}}'>
                                            <input type="hidden" name="note" value='{{$appointment->note}}'>
                                            <input type="hidden" name="approved" value='1'>
                                            <button type="submit" class="btn btn-success">Подтвердить</button>
                                        </form>

                                        <!-- Форма отклонения встречи -->
                                        <form action="{{ route('home.appointment.destroy', $appointment) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Отклонить</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>


@endsection


