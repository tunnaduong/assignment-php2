@extends('layouts.default')

@section('content')
    <!-- Sidebar -->
    <div class="d-flex">
        <div class="bg-dark text-white p-3 vh-100" style="width: 250px;">
            <h4>Admin Panel</h4>
            <ul class="nav flex-column">
                <li class="nav-item"><a href="#" class="nav-link text-white">Dashboard</a></li>
                <li class="nav-item"><a href="#" class="nav-link text-white">Users</a></li>
                <li class="nav-item"><a href="#" class="nav-link text-white">Settings</a></li>
                <li class="nav-item"><a href="/logout" class="nav-link text-white">Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="container-fluid p-4">
            <h2>Welcome to Admin Dashboard</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-header">Users</div>
                        <div class="card-body">
                            <h5 class="card-title">150</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-header">Orders</div>
                        <div class="card-body">
                            <h5 class="card-title">80</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-danger mb-3">
                        <div class="card-header">Revenue</div>
                        <div class="card-body">
                            <h5 class="card-title">$12,500</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
