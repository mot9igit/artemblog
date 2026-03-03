@extends('layouts.admin.base')

@section('title', 'Создание поста Artemblog')

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
                    <li class="breadcrumb-item active" aria-current="page">Создание поста</li>
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
    <form action="{{ route('admin.posts.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="post_title" class="form-label">Заголовок</label>
            <input type="text" class="form-control" id="post_title" name="title"/>
            @error('title') <div class="valid-feedback"> {{ $message }} </div> @enderror
        </div>
        <div class="mb-3">
            <label for="form_introtext" class="form-label">Аннотация</label>
            <textarea class="form-control" id="form_introtext" name="introtext" rows="3"></textarea>
            @error('introtext')
            <div class="valid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="form_content" class="form-label">Контент</label>
            <textarea class="form-control" id="form_content" name="content" rows="3"></textarea>
            @error('content')
            <div class="valid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" value="1" name="published" id="form_published">
            <label class="form-check-label" for="form_published">
                Опубликован
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Создать пост</button>
    </form>
@endsection
