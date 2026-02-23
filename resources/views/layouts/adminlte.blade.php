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

@section('content_top_nav_right')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('chat.inbox') }}">
            <i class="far fa-comments"></i>
            @if(isset($unread_chats_count) && $unread_chats_count > 0)
                <span class="badge badge-danger navbar-badge">{{ $unread_chats_count }}</span>
            @endif
        </a>
    </li>
@endsection

@section('js')
    <!-- Custom JS can be added here -->
    <!-- Auto-refresh unread count logic -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Optional: You could fetch chat-api/notifications here periodically 
            // if you want real-time updating without a page reload.
        });
    </script>
@endsection