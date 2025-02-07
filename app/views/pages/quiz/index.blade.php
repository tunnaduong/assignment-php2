@extends('layouts.default')

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

            <p>{{ $question->question_text }}</p>

            <form action="{{ route('quiz/' . $quiz->id . '/' . ($questionIndex + 1)) }}" method="POST">
                @csrf
                @foreach ($answers as $answer)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="selected_answer" value="{{ $answer->id }}"
                            required id="answer_{{ $answer->id }}">
                        <label class="form-check-label" for="answer_{{ $answer->id }}">{{ $answer->answer_text }}</label>
                    </div>
                @endforeach

                <div class="mt-3">
                    @if ($questionIndex > 0)
                        <a href="{{ route('quiz/' . $quiz->id . '/' . ($questionIndex - 1)) }}"
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
@endsection
