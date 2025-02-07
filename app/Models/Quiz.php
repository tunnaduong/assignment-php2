<?php

namespace App\Models;

class Quiz extends BaseModel
{
    public function getQuiz($quizId)
    {
        $this->setQuery("SELECT * FROM quizzes WHERE id = ?");
        return $this->loadRow([$quizId]);
    }

    public function getQuizQuestions($quizId)
    {
        $this->setQuery('SELECT * FROM questions WHERE quiz_id = ?');
        return $this->loadAllRows([$quizId]);
    }

    public function getQuizAnswers($questionId)
    {
        $this->setQuery('SELECT * FROM answers WHERE question_id = ?');
        return $this->loadAllRows([$questionId]);
    }
}
