@extends('layouts.admin.base')

@section('title', 'Список постов Artemblog')

@section('header')
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6"><h3 class="mb-0">Посты</h3></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Панель администратора</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Посты</li>
                </ol>
            </div>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-end">
                <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Новый пост</a>
            </div>
            <form action="{{ route('admin.posts.index') }}" method="get" class="d-flex align-items-center justify-content-between">
                <div class="">
                    <label for="search" class="form-label">Поиск</label>
                    <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}">
                </div>
                <div class="">
                    <button type="submit" class="btn btn-primary">Найти</button>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="table table-responsive">
                <table class="table table-stripped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Наименование</th>
                            <th>Статус</th>
                            <th>Дата</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td><a href="{{ route('admin.posts.edit', $post->id) }}">{{ $post->title }}</a></td>
                            <td>{{ $post->published ? "Опубликован" : "Не опубликован"}}</td>
                            <td>{{ $post->published_at?->format('d.m.Y H:i') }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="#" class="btn btn-outline-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination">
                {{ $posts->onEachSide(1)->links() }}
            </div>
        </div>
        <div class="card-footer">

        </div>
    </div>
@endsection
