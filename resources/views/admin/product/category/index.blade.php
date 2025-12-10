@extends('layouts.admin.base')
@section('header')
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6"><h3 class="mb-0">Категории</h3></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Панель администратора</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">Товары</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Категории</li>
                </ol>
            </div>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <show-product-category-component></show-product-category-component>
        </div>
        <div class="card-footer">

        </div>
    </div>
@endsection
