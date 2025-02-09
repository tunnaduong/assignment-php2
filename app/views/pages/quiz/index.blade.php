@extends('layouts.default')

@php
    shuffle($answers);
@endphp

@section('content')
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">QuizMaster</a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="quiz-card">
            <h2 class="text-center">Take the Quiz</h2>
            <hr>
            <h2>{{ $quiz->title }}</h2>
            <h4>Question {{ $questionIndex + 1 }} of {{ $totalQuestions }}</h4>

            <!-- Countdown Timer -->
            <div id="timer" class="text-danger font-weight-bold"></div>

            <p>{{ $question->question_text }}</p>

            <form id="quizForm" action="{{ route('quiz/' . $quiz->id . '/' . ($questionIndex + 1)) }}" method="POST">
                @csrf
                <input type="hidden" name="question_id" value="{{ $question->id }}">
                <input type="hidden" name="total_questions" value="{{ $totalQuestions }}">
                <input type="hidden" id="time_left" name="time_left" value="">
                @foreach ($answers as $answer)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="selected_answer" value="{{ $answer->id }}"
                            id="answer_{{ $answer->id }}" @if (isset($selectedAnswers[$question->id]) && $selectedAnswers[$question->id] == $answer->id) checked @endif>
                        <label class="form-check-label" for="answer_{{ $answer->id }}">{{ $answer->answer_text }}</label>
                    </div>
                @endforeach

                @foreach ($selectedAnswers as $qId => $aId)
                    <input type="hidden" name="selected_answers[{{ $qId }}]" value="{{ $aId }}">
                @endforeach

                <div class="mt-3">
                    @if ($questionIndex > 0)
                        <a href="{{ route('quiz/' . $quiz->id . '/' . ($questionIndex - 1)) }}?{{ http_build_query(['selected_answers' => $selectedAnswers]) }}"
                            class="btn btn-secondary">Previous</a>
                    @endif

                    @if ($questionIndex + 1 < $totalQuestions)
                        <button type="submit" class="btn btn-primary">Next</button>
                    @else
                        <button type="submit" class="btn btn-success">Submit Quiz</button>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <script>
        // Timer logic
        let quizStartTime = {{ $_SESSION['quiz_start_time'] }} * 1000; // Convert to milliseconds
        let quizDuration = {{ $_SESSION['quiz_duration'] }} * 1000; // Convert to milliseconds
        let endTime = quizStartTime + quizDuration;

        function updateTimer() {
            let now = new Date().getTime();
            let timeLeft = Math.max(0, endTime - now); // Ensure non-negative values
            let minutes = Math.floor(timeLeft / (1000 * 60));
            let seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

            document.getElementById("timer").innerHTML = `Time Left: ${minutes}m ${seconds}s`;
            document.getElementById("time_left").value = timeLeft / 1000; // Store remaining time in hidden input

            if (timeLeft <= 0) {
                document.getElementById("quizForm").submit(); // Auto-submit when time runs out
            }
        }

        setInterval(updateTimer, 1000); // Update every second
        updateTimer(); // Initial call
    </script>
@endsection
