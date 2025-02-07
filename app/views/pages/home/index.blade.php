@extends('layouts.default')

@section('content')
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .hero {
            text-align: center;
            padding: 50px;
            background-color: #007bff;
            color: white;
        }

        .quiz-card {
            transition: 0.3s;
        }

        .quiz-card:hover {
            transform: scale(1.05);
        }

        .container-fluid {
            flex: 1;
        }
    </style>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">QuizMaster</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#quizzes">Quizzes</a></li>
                    <li class="nav-item"><a class="nav-link" href="/logout">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="hero">
        <h1>Welcome to QuizMaster</h1>
        <p>Test your knowledge with exciting quizzes!</p>
        <a href="#quizzes" class="btn btn-light">Start Quiz</a>
    </div>

    <div class="container mt-5 flex-grow-1" id="quizzes">
        <h2 class="text-center">Available Quizzes</h2>
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card quiz-card">
                    <div class="card-body">
                        <h5 class="card-title">General Knowledge</h5>
                        <p class="card-text">Test your general knowledge skills.</p>
                        <a href="#" class="btn btn-primary">Start</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card quiz-card">
                    <div class="card-body">
                        <h5 class="card-title">Science Quiz</h5>
                        <p class="card-text">Challenge yourself with science questions.</p>
                        <a href="#" class="btn btn-primary">Start</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card quiz-card">
                    <div class="card-body">
                        <h5 class="card-title">History Quiz</h5>
                        <p class="card-text">How well do you know history?</p>
                        <a href="#" class="btn btn-primary">Start</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white text-center p-3 mt-5">
        &copy; 2025 QuizMaster. All Rights Reserved.
    </footer>
@endsection
