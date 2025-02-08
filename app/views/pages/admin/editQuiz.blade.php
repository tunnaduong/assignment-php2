@extends('layouts.default')

@section('content')
    <div class="d-flex">
        <div class="bg-dark text-white p-3" style="width: 250px; min-height: 100vh;">
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
            <h2>Edit quiz: {{ $quiz->title }}</h2>

            <!-- Form to Add Question -->
            <form action="/manage/questions/store" method="POST">
                <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">

                @foreach ($quiz->questions as $index => $question)
                    <div class="mb-3">
                        <div class="mb-3">
                            <h4>Question {{ $index + 1 }}</h4>
                            <input type="text" class="form-control" name="questions[]"
                                value="{{ $question->question_text }}">
                        </div>

                        <h4>Answers</h4>
                        <div class="answers-group mt-2">
                            @foreach ($question->answers as $answerIndex => $answer)
                                <div class="d-flex align-items-center mb-2">
                                    <input type="text" class="form-control me-2" name="answers[{{ $index }}][]"
                                        value="{{ $answer->answer_text }}">
                                    <input type="radio" name="correct_answer[{{ $index }}]"
                                        value="{{ $answerIndex }}" {{ $answer->is_correct ? 'checked' : '' }}> Correct
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <div class="mb-3">
                    <h4 for="question_text" class="form-label">Question {{ count($quiz->questions) + 1 }}</h4>
                    <input type="text" class="form-control" id="question_text" name="question_text" required>
                </div>

                <h4>Answers</h4>
                <div id="answers-container">
                    <div class="mb-3 d-flex align-items-center">
                        <input type="text" class="form-control me-2" name="answers[]" placeholder="Answer 1" required>
                        <input type="radio" name="correct_answer[]" value="0"> Correct
                    </div>
                </div>

                <button type="button" class="btn btn-primary" onclick="addAnswer()">Add Another Answer</button>

                <button type="button" class="btn btn-primary" onclick="addQuestion()">Add Another Question</button>

                <button type="submit" class="btn btn-success">Save Question</button>
                <a href="/manage/quizzes" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>

    <script>
        let answerCount = 1;
        let questionCount = {{ count($quiz->questions) + 1 }};

        function addAnswer() {
            const container = document.getElementById('answers-container');
            const index = answerCount++;

            const answerDiv = document.createElement('div');
            answerDiv.classList.add('mb-3', 'd-flex', 'align-items-center');

            answerDiv.innerHTML = `
                <input type="text" class="form-control me-2" name="answers[]" placeholder="Answer ${index + 1}" required>
                <input type="radio" name="correct_answer[]" value="${index}"> Correct
            `;

            container.appendChild(answerDiv);
        }

        function addQuestion() {
            questionCount++;
            const container = document.querySelector('form');
            const submitButton = container.querySelector('button[type="submit"]');

            const questionDiv = document.createElement('div');
            questionDiv.innerHTML = `
                <div class="mb-3">
                    <h4 for="question_text" class="form-label">Question ${questionCount}</h4>
                    <input type="text" class="form-control" name="question_text" required>
                </div>

                <h4>Answers</h4>
                <div class="answers-container">
                    <div class="mb-3 d-flex align-items-center">
                        <input type="text" class="form-control me-2" name="answers[]" placeholder="Answer 1" required>
                        <input type="radio" name="correct_answer[]" value="0"> Correct
                    </div>
                </div>

                <button type="button" class="btn btn-primary mb-3" onclick="addAnswer()">Add Another Answer</button>
            `;

            container.insertBefore(questionDiv, submitButton);
        }
    </script>
@endsection
