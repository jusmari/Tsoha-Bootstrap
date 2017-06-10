<?php

  class AnswerController extends BaseController{


    public static function quiz() {
      $questions = Question::all();

      View::make('quiz.html', array('questions' => $questions));
    }

    public static function answerQuiz() {
      $user_id = self::get_user_logged_in();
      $params = $_POST;

      
    }

  }
