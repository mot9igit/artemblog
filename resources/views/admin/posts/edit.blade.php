@extends('layouts.admin.base')

@section('title', 'Редактирование поста Artemblog')

@section('header')
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6"><h3 class="mb-0">Посты</h3></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Панель администратора</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.posts.index') }}">Посты</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Редактирование поста</li>
                </ol>
            </div>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="post_image" class="form-label">Изображение</label>
            <input type="file" class="form-control" id="post_image" name="image" accept="image/*"/>
            @error('image') <div class="valid-feedback"> {{ $message }} </div> @enderror
        </div>
        @if(isset($post) && $post->image)
            <div class="mt-3">
                <span>Текущее изображение:</span>
                <div class="image">
                    <img src="{{ $post->image_url }}" class="mt-2" alt=""/>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="1" name="remove_image" id="remove_image"/>
                    <label class="form-check-label" for="form_remove_image">
                        Удалить изображение
                    </label>
                </div>
            </div>
        @endif
        <div class="mb-3">
            <label for="post_title" class="form-label">Заголовок</label>
            <input type="text" class="form-control" id="post_title" name="title" value="{{ old('title', $post->title) }}"/>
            @error('title') <div class="valid-feedback"> {{ $message }} </div> @enderror
        </div>
        <div class="mb-3">
            <label for="post_title" class="form-label">Ссылка</label>
            <input type="text" class="form-control" id="post_slug" name="slug" value="{{ old('slug', $post->slug) }}"/>
            @error('slug') <div class="valid-feedback"> {{ $message }} </div> @enderror
        </div>
        <div class="mb-3">
            <label for="form_introtext" class="form-label">Аннотация</label>
            <textarea class="form-control" id="form_introtext" name="introtext" rows="3">{{ old('introtext', $post->introtext) }}</textarea>
            @error('introtext')
            <div class="valid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="form_content" class="form-label">Контент</label>
            <textarea class="form-control" id="form_content" name="content" rows="3">{{ old('content', $post->content) }}</textarea>
            @error('content')
            <div class="valid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" value="1" name="published" id="form_published"  {{ old('published', $post->published) ? 'checked' : '' }}>
            <label class="form-check-label" for="form_published">
                Опубликован
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Редактировать пост</button>
    </form>
@endsection
