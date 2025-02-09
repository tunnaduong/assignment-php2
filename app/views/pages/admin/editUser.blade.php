@extends('layouts.default')

@section('content')
    <div class="d-flex">
        <div class="bg-dark text-white p-3 vh-100" style="width: 250px;">
            <h4>Admin Panel</h4>
            <ul class="nav flex-column">
                <li class="nav-item"><a href="{{ route('') }}" class="nav-link text-white">Dashboard</a></li>
                <li class="nav-item"><a href="{{ route('manage/users') }}" class="nav-link text-white">Users</a></li>
                <li class="nav-item"><a href="{{ route('manage/quizzes') }}" class="nav-link text-white">Quizzes</a></li>
                <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link text-white">Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="container-fluid p-4">
            <h2>Edit User</h2>

            <form action="" method="POST">
                <div class="mb-3">
                    <label for="userName" class="form-label">Name</label>
                    <input type="text" class="form-control" id="userName" name="full_name"
                        value="{{ $user->full_name }}" required>
                </div>
                <div class="mb-3">
                    <label for="userEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" id="userEmail" name="email" value="{{ $user->email }}"
                        required>
                </div>
                <div class="mb-3">
                    <label for="userPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" id="userPassword" name="password"
                        value="{{ $user->password }}" required>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" name="role" id="role" aria-label="Role">
                        <option disabled selected>Select a role</option>
                        <option {{ $user->role == 'admin' ? 'selected' : '' }} value="admin">Admin</option>
                        <option {{ $user->role == 'user' ? 'selected' : '' }} value="user">User</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Edit User</button>
                <a href="{{ route('manage/users') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
