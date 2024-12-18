@extends('layouts.admin')

@section('content')
<div class="wrapper">
    <!-- Main Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">

        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" role="menu">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route ('admin.products.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Product Management</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Content -->
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <h1>Welcome, Admin!</h1>
            </div>
        </section>
    </div>
</div>
@endsection
