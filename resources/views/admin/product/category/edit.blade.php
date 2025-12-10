@extends('layouts.admin.base')
@section('header')
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6"><h3 class="mb-0">{{ $category->title }}</h3></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Панель администратора</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">Товары</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.product.category.index') }}">Категории</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Редактирование {{ $category->title }}</li>
                </ol>
            </div>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
@endsection
@section('content')
    <div class="card card-primary card-outline mb-4">
        <form action="{{ route('admin.product.category.update', $category->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <!--begin::Header-->
            <div class="card-header"><div class="card-title">Редактирование категории {{ $category->title }}</div></div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body">
                <div class="mb-3">
                    <label for="title" class="form-label">Наименование</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ $category->title }}">
                    @error('title')
                        <div class="text-danger">Это поле обязательно для заполнения!</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Описание</label>
                    <textarea class="form-control" name="description" id="description" aria-describedby="descriptionHelp">{{ $category->description }}</textarea>
                    <div id="descriptionHelp" class="form-text">
                        Описание категории
                    </div>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Контент</label>
                    <textarea class="form-control" name="content" id="content" aria-describedby="emailHelp">{{ $category->content }}</textarea>
                    <div id="titleHelp" class="form-text">
                        Контент категории
                    </div>
                </div>
            </div>
            <!--end::Body-->
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Редактировать категорию</button>
            </div>
        </form>
    </div>
@endsection
