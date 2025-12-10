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
                    <li class="breadcrumb-item active" aria-current="page">{{ $category->title }}</li>
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
            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.product.category.edit', $category->id) }}" class="btn btn-primary">
                    Редактировать категорию
                </a>
            </div>
            <div class="mt-3">
                <table class="table table-bordered">
                    <tbody>
                    <tr class="align-middle">
                        <td>ID</td>
                        <td>{{ $category->id }}</td>
                    </tr>
                    <tr class="align-middle">
                        <td>Заголовок</td>
                        <td>{{ $category->title }}</td>
                    </tr>
                    <tr class="align-middle">
                        <td>Описание</td>
                        <td>{{ $category->description }}</td>
                    </tr>
                    <tr class="align-middle">
                        <td>Контент</td>
                        <td>{{ $category->content }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
<script>
    import ProductCategories from "../../../../js/components/admin/product/category/ShowComponent.vue";
    export default {
        components: {ProductCategories}
    }
</script>
