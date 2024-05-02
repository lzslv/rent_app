@extends('layouts.admin')
@section('content')
    <div class="ml-3 mr-3">
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-tools">
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>Фото</th>
                                <th>Ссылка</th>
                                <th>Цена в BYN</th>
                                <th>Цена в USD</th>
                                <th>Кол-во комнат</th>
                                <th>Размер (м²)</th>
                                <th>Этаж</th>
                                <th>Описание</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($kufarPosts as $kufarPost)
                                    <tr>
                                        <td>
                                            <img style="width: 300px; height: 150px"
                                                 src="{{ $kufarPost['image_src'] }}">
                                        </td>
                                        <td>
                                            <a href="{{ $kufarPost['link'] }}">Подробнее</a>
                                        </td>
                                        <td>{{ str_replace(' р.', '', $kufarPost['price_byn']) }}</td>
                                        <td>{{ str_replace(' $', '', $kufarPost['price_usd']) }}</td>
                                        <td>{{ $kufarPost['rooms_num'] }}</td>
                                        <td>{{ $kufarPost['size'] }}</td>
                                        <td>{{ $kufarPost['floor'] }}</td>
                                        <td>
                                            {{ $kufarPost['description'] }}
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
