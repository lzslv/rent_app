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
                                <th>ID сотрудника</th>
                                <th>Имя</th>
                                <th>Контактный номер</th>
                                @if ($jobFlag)
                                    <th>
                                        Должность
                                    </th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($workers as $worker)
                                    <tr>
                                        <td>{{ $worker->id }}</td>
                                        <td>{{ $worker->name }}</td>
                                        <td>{{ $worker->phone }}</td>
                                        @if ($jobFlag)
                                            <td>{{ $worker->job->title }}</td>
                                        @endif
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
