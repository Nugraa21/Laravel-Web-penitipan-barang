<!-- resources/views/layouts/adminlte.blade.php -->
@extends('adminlte::page')

@section('title', 'Super Admin')

@section('content_header')
    <h1 class="m-0 text-dark">Super Admin Panel</h1>
@endsection

@section('content')
    @yield('admin_content')
@endsection

@section('css')
    <!-- Custom CSS can be added here -->
@endsection

@section('js')
    <!-- Custom JS can be added here -->
@endsection