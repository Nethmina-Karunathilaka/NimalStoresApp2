@extends('layouts.admin')

@section('content')
<div class="nav">
        <div class="nav-item"><a href="">DashBoard</a></div>
        <div class="nav-item"><a href="">Order Management</a></div>
        <div class="nav-item"><a href="{{route('admin.products.index')}}">Products Management</a></div>
        <div class="nav-item"><a href="">User Details</a></div>
    </div>

    <div class="cards">
        <div class="card-con">
            <h2>Total Users</h2>
            <span>0</span>
        </div>

        <div class="card-con">
            <h2>Total Orders</h2>
            <span>0</span>
        </div>

        <div class="card-con">
            <h2>Total Products</h2>
            <span>0</span>
        </div>
    </div>
@endsection
