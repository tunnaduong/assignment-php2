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
            <form action="" method="POST">
                <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">

                <div class="mb-3">
                    <label for="quizName" class="form-label">Quiz Name</label>
                    <input type="text" value="{{ $quiz->title }}" class="form-control" id="quizName" name="title"
                        required>
                </div>
                <div class="mb-3">
                    <label for="quizDesc" class="form-label">Quiz Description</label>
                    <textarea class="form-control" id="quizDesc" name="description" rows="5">{{ $quiz->description }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="duration" class="form-label">Time Limit (minutes):</label>
                    <input type="number" value="{{ $quiz->duration }}" class="form-control" name="duration" id="duration"
                        min="1" required>
                </div>

                @foreach ($quiz->questions as $index => $question)
                    <div class="mb-3">
                        <div class="mb-3">
                            <h4>Question {{ $index + 1 }}</h4>
                            <input type="text" class="form-control" name="questions[]"
                                value="{{ $question->question_text }}">
                        </div>

                        <h4>Answers</h4>
                        <div class="answers-group mt-2" id="answers-container-{{ $index }}">
                            @foreach ($question->answers as $answerIndex => $answer)
                                <div class="d-flex align-items-center mb-2">
                                    <input type="text" class="form-control me-2" name="answers[{{ $index }}][]"
                                        value="{{ $answer->answer_text }}">
                                    <input type="radio" name="correct_answer[{{ $index }}]"
                                        value="{{ $answerIndex }}" {{ $answer->is_correct ? 'checked' : '' }}>
                                    &nbsp;Correct&nbsp;&nbsp;
                                    <button type="button" class="btn btn-danger btn-sm"
                                        onclick="deleteAnswer(this, {{ $index }}, {{ $answerIndex }})">Delete</button>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-primary mb-3" onclick="addAnswer({{ $index }})">Add
                            Another
                            Answer</button>
                        <button type="button" class="btn btn-danger mb-3" onclick="deleteQuestion(this)">Delete
                            Question</button>
                    </div>
                @endforeach

                <div class="mb-3">
                    <div class="mb-3">
                        <h4 for="question_text" class="form-label">Question {{ count($quiz->questions) + 1 }}</h4>
                        <input type="text" class="form-control" id="question_text" name="questions[]">
                    </div>

                    <h4>Answers</h4>
                    <div id="answers-container-{{ count($quiz->questions) }}">
                        <div class="mb-3 d-flex align-items-center">
                            <input type="text" class="form-control me-2" name="answers[{{ count($quiz->questions) }}][]"
                                placeholder="Answer 1">
                            <input type="radio" name="correct_answer[{{ count($quiz->questions) }}]" value="0">
                            &nbsp;Correct&nbsp;&nbsp;
                            <button type="button" class="btn btn-danger btn-sm"
                                onclick="deleteAnswer(this, {{ count($quiz->questions) }}, 0)">Delete</button>
                        </div>
                    </div>

                    <button type="button" class="btn btn-primary mb-3"
                        onclick="addAnswer({{ count($quiz->questions) }})">Add
                        Another Answer</button>
                    <button type="button" class="btn btn-danger mb-3" onclick="deleteQuestion(this)">Delete
                        Question</button>
                </div>
                <div>
                    <button type="button" class="btn btn-primary mb-3" onclick="addQuestion()">Add Another
                        Question</button>

                    <button type="submit" class="btn btn-success mb-3">Save Quiz</button>
                    <a href="/manage/quizzes" class="btn btn-secondary mb-3">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        let answerCount = 1;
        let questionCount = {{ count($quiz->questions) + 1 }};

        function addAnswer(questionIndex) {
            const container = document.getElementById(`answers-container-${questionIndex}`);
            const answers = container.getElementsByClassName('mb-3').length;

            const answerDiv = document.createElement('div');
            answerDiv.classList.add('mb-3', 'd-flex', 'align-items-center');

            answerDiv.innerHTML = `
            <input type="text" class="form-control me-2" name="answers[${questionIndex}][]" placeholder="Answer ${answers + 1}">
            <input type="radio" name="correct_answer[${questionIndex}]" value="${answers}"> &nbsp;Correct&nbsp;&nbsp;
            <button type="button" class="btn btn-danger btn-sm" onclick="deleteAnswer(this, ${questionIndex}, ${answers})">Delete</button>
            `;

            container.appendChild(answerDiv);
        }

        function addQuestion() {
            questionCount++;
            const container = document.querySelector('form');
            const questionDiv = document.createElement('div');
            questionDiv.innerHTML = `
                <div class="mb-3">
                    <h4 for="question_text" class="form-label">Question ${questionCount}</h4>
                    <input type="text" class="form-control" name="questions[]">
                </div>

                <h4>Answers</h4>
                <div id="answers-container-${questionCount - 1}">
                    <div class="mb-3 d-flex align-items-center">
                        <input type="text" class="form-control me-2" name="answers[${questionCount - 1}][]" placeholder="Answer 1">
                        <input type="radio" name="correct_answer[${questionCount - 1}]" value="0"> &nbsp;Correct&nbsp;&nbsp;
                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteAnswer(this, ${questionCount - 1}, 0)">Delete</button>
                    </div>
                </div>

                <button type="button" class="btn btn-primary mb-3" onclick="addAnswer(${questionCount - 1})">Add Another Answer</button>
                <button type="button" class="btn btn-danger mb-3" onclick="deleteQuestion(this)">Delete Question</button>
            `;

            container.insertBefore(questionDiv, container.lastElementChild);
        }

        function deleteAnswer(button, questionIndex, answerIndex) {
            const answerDiv = button.parentNode;
            answerDiv.remove();
        }

        function deleteQuestion(button) {
            const questionDiv = button.parentNode;
            questionDiv.remove();
        }
    </script>
@endsection
