<?php

  class AnswerController extends BaseController{


    public static function quiz() {
      $questions = Question::all();
      $user_id = self::get_user_logged_in();

      View::make('quiz.html', array('questions' => $questions, 'user_logged_in' => $user_id));
    }

    public static function answerQuiz() {
      $params = $_POST;

      
    }

  }
