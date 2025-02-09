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
            <h2>Create New Quiz</h2>

            <form action="/manage/quizzes/create" method="POST">
                <div class="mb-3">
                    <label for="quizName" class="form-label">Quiz Name</label>
                    <input type="text" class="form-control" id="quizName" name="title" required>
                </div>
                <div class="mb-3">
                    <label for="quizDesc" class="form-label">Quiz Description</label>
                    <textarea class="form-control" id="quizDesc" name="description" rows="5"></textarea>
                </div>
                <div class="mb-3">
                    <label for="duration" class="form-label">Time Limit (minutes):</label>
                    <input type="number" class="form-control" name="duration" id="duration" min="1" value="10"
                        required>
                </div>
                <button type="submit" class="btn btn-success">Create Quiz</button>
                <a href="{{ route('manage/quizzes') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
