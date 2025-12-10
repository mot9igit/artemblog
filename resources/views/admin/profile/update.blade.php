@extends('layouts.admin.base')

@section('content')
    <profile-form-component user_id="{{ auth()->id() }}"></profile-form-component>
@endsection
