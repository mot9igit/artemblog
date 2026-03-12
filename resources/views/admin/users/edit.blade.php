@extends('layouts.admin.base')

@section('title', 'Редактирование поста Artemblog')

@section('header')
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6"><h3 class="mb-0">Пользователи</h3></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Панель администратора</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Пользователи</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Редактирование пользователя</li>
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
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="user_title" class="form-label">Заголовок</label>
            <input type="text" class="form-control" id="user_title" name="name" value="{{ old('name', $user->name) }}"/>
            @error('title') <div class="valid-feedback"> {{ $message }} </div> @enderror
        </div>
        <div class="mb-3">
            <select name="role" id="user_role" class="form-select">
                <option value="user" {{ $user->role->value === 'user' ? 'selected' : '' }}>user</option>
                <option value="admin" {{ $user->role->value === 'admin' ? 'selected' : '' }}>admin</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Редактировать пользователя</button>
    </form>
@endsection
