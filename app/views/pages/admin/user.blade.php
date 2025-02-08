@extends('layouts.default')

@section('content')
    <!-- Sidebar -->
    <div class="d-flex">
        <div class="bg-dark text-white p-3 vh-100" style="width: 250px;">
            <h4>Admin Panel</h4>
            <ul class="nav flex-column">
                <li class="nav-item"><a href="/" class="nav-link text-white">Dashboard</a></li>
                <li class="nav-item"><a href="/manage/users" class="nav-link text-white">Users</a></li>
                <li class="nav-item"><a href="/manage/quizzes" class="nav-link text-white">Quizzes</a></li>
                <li class="nav-item"><a href="/logout" class="nav-link text-white">Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="container-fluid p-4">
            <h2>Manage Users</h2>

            <!-- Add User Button -->
            <a href="/manage/users/create" class="btn btn-success mb-3">Add New User</a>

            <!-- Users Table -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->full_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                <a href="/manage/users/edit/{{ $user->id }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('manage/users/delete/' . $user->id) }}" method="POST"
                                    style="display: inline;">
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
