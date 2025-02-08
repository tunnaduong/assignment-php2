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

            <p>{{ $question->question_text }}</p>

            <form action="{{ route('quiz/' . $quiz->id . '/' . ($questionIndex + 1)) }}" method="POST">
                @csrf
                <input type="hidden" name="question_id" value="{{ $question->id }}">
                <input type="hidden" name="total_questions" value="{{ $totalQuestions }}">
                @foreach ($answers as $answer)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="selected_answer" value="{{ $answer->id }}"
                            required id="answer_{{ $answer->id }}" @if (isset($selectedAnswers[$question->id]) && $selectedAnswers[$question->id] == $answer->id) checked @endif>
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
@endsection
