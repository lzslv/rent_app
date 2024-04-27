@extends('layouts.admin')
@section('content')
    <div class="ml-3 mr-3">
        <a class="btn btn-primary" href="{{ route('admin.post.create') }}" role="button">Добавить объявление</a>
        <a class="btn btn-success" href="{{ route('admin.post') }}" role="button">Показать все</a>

        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Список объявлений</h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 180px;">
                                <form action="{{ route('post.search') }}" method="POST" style="display: flex">
                                    @csrf
                                    <div>
                                        <input type="text" name="searched_post_title" class="form-control float-right"
                                               placeholder="Поиск">
                                    </div>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>
                                    <a href="{{ route('admin.post.sort', ['id', $directions['id'] ?? 'desc']) }}">
                                        ID
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('admin.post.sort', ['title', $directions['title'] ?? 'desc']) }}">
                                        Название
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('admin.post.sort', ['type', $directions['type'] ?? 'desc']) }}">
                                        Тип
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('admin.post.sort', ['likes', $directions['likes'] ?? 'desc']) }}">
                                        Оценка
                                    </a>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($allPosts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->type }}</td>
                                    <td>{{ $post->likes }}</td>
                                    <td>
                                        <a class="btn btn-dark" href="{{route('admin.post.show', $post)}}">
                                            Подробнее
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
