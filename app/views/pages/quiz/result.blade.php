@extends('layouts.default')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">QuizMaster</a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="quiz-card">
            <h2 class="text-center">Quiz Result</h2>
            <hr>

            <h2>{{ $quiz->title }}</h2>
            <p><strong>Total Questions:</strong> {{ $totalQuestions }}</p>
            <p><strong>Correct Answers:</strong> {{ $correctAnswers }}</p>
            <p><strong>Score:</strong> {{ $scorePercentage }}%</p>

            <a href="/" class="btn btn-primary">Back to Home</a>
        </div>
    </div>
@endsection
