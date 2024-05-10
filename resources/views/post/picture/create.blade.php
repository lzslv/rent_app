@extends('layouts.main')
@section('content')
    <div class="mt-5">
        <h3 style="text-align: center">Добавьте изображения</h3>

        <div class="row">
            <div class="col-md-3"></div>

            <form action="{{ route('post.picture.store', $post) }}" method="POST" enctype="multipart/form-data"
                  id="imageForm">
                @csrf

                <div class="mb-3">
                    <label for="pictures[]" class="form-label">Ссылка на изображение 1</label>
                    <input type="text" name="pictures[]" class="form-control" id="pictures[]">
                    <input type="radio" name="main_picture" value="0"> Сделать главным
                </div>
                <div class="mb-3">
                    <label for="pictures[]" class="form-label">Ссылка на изображение 2</label>
                    <input type="text" name="pictures[]" class="form-control" id="pictures[]">
                    <input type="radio" name="main_picture" value="1"> Сделать главным
                </div>
                <div class="mb-3">
                    <label for="pictures[]" class="form-label">Ссылка на изображение 3</label>
                    <input type="text" name="pictures[]" class="form-control" id="pictures[]">
                    <input type="radio" name="main_picture" value="2"> Сделать главным
                </div>
                <button type="submit">Добавить изображения</button>
            </form>
        </div>
    </div>
@endsection
