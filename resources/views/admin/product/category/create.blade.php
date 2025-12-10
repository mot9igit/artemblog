@extends('layouts.admin.base')
@section('header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6"><h3 class="mb-0">Создание категории</h3></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Панель администратора</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">Товары</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.product.category.index') }}">Категории</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Создание</li>
                </ol>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="card card-primary card-outline mb-4">
        <create-product-category-component></create-product-category-component>
    </div>
@endsection
