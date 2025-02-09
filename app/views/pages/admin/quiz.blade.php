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
            <h2>Manage Quizzes</h2>

            <!-- Button to add new quiz -->
            <a href="{{ route('manage/quizzes/create') }}" class="btn btn-success mb-3">Add New Quiz</a>

            <!-- Table displaying quizzes -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Quiz Name</th>
                        <th scope="col">Duration</th>
                        <th scope="col">Number of Questions</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($quizzes as $quiz)
                        <tr>
                            <td>{{ $quiz->id }}</td>
                            <td>{{ $quiz->title }}</td>
                            <td>{{ $quiz->duration }} minute(s)</td>
                            <td>{{ $quiz->total_questions }}</td>
                            <td>
                                <a href="{{ route('manage/quizzes/edit/' . $quiz->id) }}"
                                    class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('manage/quizzes/delete/' . $quiz->id) }}" method="POST"
                                    style="display: inline;">
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this quiz?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
